<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats\User;

use Piwik\Access;
use Piwik\Access\Role\Admin;
use Piwik\Access\Role\View;
use Piwik\Access\Role\Write;
use Piwik\Auth\Password;
use Piwik\Common;
use Piwik\Date;
use Piwik\Plugin;
use Piwik\Plugins\LanguagesManager\API;
use Piwik\Plugins\UsersManager\Model;
use Piwik\Plugins\UsersManager;
use WpPsstats\Bootstrap;
use WpPsstats\Capabilities;
use WpPsstats\Logger;
use WpPsstats\ScheduledTasks;
use WpPsstats\Site;
use WpPsstats\User;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class Sync {
	/**
	 * actually allowed is 100 characters...
	 * but we do -5 to have some room to append `wp_`.$login.XYZ if needed
	 */
	const MAX_USER_NAME_LENGTH = 95;

	/**
	 * @var Logger
	 */
	private $logger;

	public function __construct() {
		$this->logger = new Logger();
	}

	public function register_hooks() {
		add_action( 'add_user_role', array( $this, 'sync_current_users' ), $prio = 10, $args = 0 );
		add_action( 'remove_user_role', array( $this, 'sync_current_users' ), $prio = 10, $args = 0 );
		add_action( 'add_user_to_blog', array( $this, 'sync_current_users' ), $prio = 10, $args = 0 );
		add_action( 'remove_user_from_blog', array( $this, 'sync_current_users' ), $prio = 10, $args = 0 );
		add_action( 'user_register', array( $this, 'sync_current_users' ), $prio = 10, $args = 0 );
		add_action( 'profile_update', array( $this, 'sync_maybe_background' ), $prio = 10, $args = 0 );
	}

	public function sync_maybe_background()
	{
		global $pagenow;
		if ( is_admin() && $pagenow == 'users.php' ) {
			// eg for profile update we don't want to sync directly see #365 as it could cause issues with other plugins
			// if they eg alter `get_users` option
			wp_schedule_single_event(time() + 5, ScheduledTasks::EVENT_SYNC);
		} else {
			$this->sync_current_users();
		}
	}

	public function sync_all() {
		if ( function_exists( 'is_multisite' ) && is_multisite() ) {
			foreach ( get_sites() as $site ) {
				switch_to_blog( $site->blog_id );

				$idsite = Site::get_psstats_site_id( $site->blog_id );

				try {
					if ( $idsite ) {
						$users = $this->get_users( array('blog_id' => $site->blog_id ) );
						$this->sync_users( $users, $idsite );
					}
				} catch ( \Exception $e ) {
					// we don't want to rethrow exception otherwise some other blogs might never sync
					$this->logger->log_exception( 'user_sync ', $e );
				}

				restore_current_blog();
			}
		} else {
			$this->sync_current_users();
		}
	}

	private function get_users($options = array())
    {
        /** @var \WP_User[] $users */
        $users = get_users( $options );

	    $current_user = wp_get_current_user();
	    if (!empty($current_user) && !empty($current_user->user_login)) {
		    // refs https://github.com/psstats-org/wp-psstats/issues/365
		    // some other plugins may under circumstances overwrite the get_users query and not return all users
		    // as a result we would delete some users in the psstats users table. this way we make sure at least the current
		    // user will be added and not deleted even if the list of users is not complete
		    $found = false;
		    foreach ($users as $user) {
			    if ($user->user_login === $current_user->user_login) {
				    $found = true;
				    break;
			    }
		    }
		    if (!$found) {
			    $users[] = $current_user;
		    }
	    }

        if (is_multisite()) {
            $super_admins = get_super_admins();
            if (!empty($super_admins)) {
                foreach ($super_admins as $super_admin) {
                    $found = false;
                    foreach ($users as $user) {
                        if ($user->user_login === $super_admin) {
                            $found = true;
                            break;
                        }
                    }
                    if (!$found) {
                        $user = get_user_by('login', $super_admin);
                        if (!empty($user)) {
                            $users[] = $user;
                        }
                    }
                }
            }
        }
        return $users;
    }

	public function sync_current_users() {
		$idsite = Site::get_psstats_site_id( get_current_blog_id() );
		if ( $idsite ) {
			$users = $this->get_users();
			$this->sync_users( $users, $idsite );
		}
	}

	/**
	 * Sync all users. Make sure to always pass all sites that exist within a given site... you cannot just sync an individual
	 * user... we would delete all other users
	 *
	 * @param \WP_User[] $users
	 * @param $idsite
	 */
	protected function sync_users( $users, $idsite ) {
		Bootstrap::do_bootstrap();

		$this->logger->log( 'Psstats synchronisiert jetzt ' . count( $users ) . ' Benutzer' );

		$super_users                  = array();
		$logins_with_some_view_access = array( 'nonmyous' ); // may or may not exist... we don't want to delete this user though
		$user_model                   = new Model();

		// need to make sure we recreate new instance later with latest dependencies in case they changed
		API::unsetInstance();

		foreach ( $users as $user ) {
			$user_id = $user->ID;

			// todo if we used transactions we could commit it after a possibly new access has been added
			// to prevent UI preventing randomly saying no access between deleting and adding access

			$mapped_psstats_login = User::get_psstats_user_login( $user_id );

			$psstats_login = null;

			if ( user_can( $user, Capabilities::KEY_SUPERUSER ) ) {
				$psstats_login                   = $this->ensure_user_exists( $user );
				$super_users[ $psstats_login ]   = $user;
				$logins_with_some_view_access[] = $psstats_login;
			} elseif ( user_can( $user, Capabilities::KEY_ADMIN ) ) {
				$psstats_login = $this->ensure_user_exists( $user );
				$user_model->deleteUserAccess( $mapped_psstats_login, array( $idsite ) );
				$user_model->addUserAccess( $psstats_login, Admin::ID, array( $idsite ) );
				$user_model->setSuperUserAccess( $psstats_login, false );
				$logins_with_some_view_access[] = $psstats_login;
			} elseif ( user_can( $user, Capabilities::KEY_WRITE ) ) {
				$psstats_login = $this->ensure_user_exists( $user );
				$user_model->deleteUserAccess( $mapped_psstats_login, array( $idsite ) );
				$user_model->addUserAccess( $psstats_login, Write::ID, array( $idsite ) );
				$user_model->setSuperUserAccess( $psstats_login, false );
				$logins_with_some_view_access[] = $psstats_login;
			} elseif ( user_can( $user, Capabilities::KEY_VIEW ) ) {
				$psstats_login = $this->ensure_user_exists( $user );
				$user_model->deleteUserAccess( $mapped_psstats_login, array( $idsite ) );
				$user_model->addUserAccess( $psstats_login, View::ID, array( $idsite ) );
				$user_model->setSuperUserAccess( $psstats_login, false );
				$logins_with_some_view_access[] = $psstats_login;
			} elseif ($mapped_psstats_login) {
				$user_model->deleteUserAccess( $mapped_psstats_login, array( $idsite ) );
			}

			if ( $psstats_login ) {
				$locale = get_user_locale( $user->ID );
				$locale_dash = Common::mb_strtolower(str_replace('_', '-', $locale));
				$parts = [];
				if ($locale && in_array($locale_dash, ['zh-cn', 'zh-tw', 'pt-br', 'es-ar'], true)) {
					$parts = [$locale_dash];
				} elseif (!empty($locale) && is_string($locale)) {
					$parts  = explode( '_', $locale );
				}

				if ( ! empty( $parts[0] ) ) {
					$lang = $parts[0];
					if ( Plugin\Manager::getInstance()->isPluginActivated( 'LanguagesManager' )
						 && Plugin\Manager::getInstance()->isPluginInstalled( 'LanguagesManager' )
						 && API::getInstance()->isLanguageAvailable( $lang ) ) {
						$user_lang_model = new \Piwik\Plugins\LanguagesManager\Model();
						$user_lang_model->setLanguageForUser( $psstats_login, $lang );
					}
				}
			}

			if ($idsite != 1) {
				// only needed if the actual site is not the default site... makes sure when they click in Psstats
				// UI on "Dashboard" that the correct site is being opened by default
				// eg if the linked site is actually idSite=2.
				Access::doAsSuperUser(
					function () use ( $psstats_login, &$idsite ) {
						try {
							UsersManager\API::unsetInstance();
							// we need to unset the instance to make sure it fetches the
							// up to date dependencies eg current plugin manager etc

							UsersManager\API::getInstance()->setUserPreference(
								$psstats_login,
								UsersManager\API::PREFERENCE_DEFAULT_REPORT,
								$idsite
							);
						} catch (\Exception $e) {
							// ignore any error for now
						}

					}
				);
			}
		}

		foreach ( $super_users as $psstats_login => $user ) {
			$user_model->setSuperUserAccess( $psstats_login, true );
		}

		$logins_with_some_view_access = array_unique( $logins_with_some_view_access );
		$all_users                    = $user_model->getUsers( array() );
		foreach ( $all_users as $all_user ) {
			if ( ! in_array( $all_user['login'], $logins_with_some_view_access, true )
				 && ! empty( $all_user['login'] ) ) {

				Access::doAsSuperUser(
					function () use ( $user_model, $all_user ) {
						$user_model->deleteUserOnly( $all_user['login'] );
						$user_model->deleteUserOptions( $all_user['login'] );
						$user_model->deleteUserAccess( $all_user['login'] );
					}
				);
			}
		}
	}

	/**
	 * @param \WP_User $wp_user
	 */
	protected function ensure_user_exists( $wp_user ) {
		$user_model = new Model();
		$user_id    = $wp_user->ID;
		$login      = $wp_user->user_login;

		$psstats_user_login = User::get_psstats_user_login( $user_id );
		$user_in_psstats    = null;

		if ( $psstats_user_login ) {
			$user_in_psstats = $user_model->getUser( $psstats_user_login );
		} else {
			// wp usernames may include whitespace etc
			$login = preg_replace('/[^A-Za-zÄäÖöÜüß0-9_.@+-]+/D', '_', $login);
			$login = substr( $login, 0, self::MAX_USER_NAME_LENGTH );

			if ( ! $user_model->getUser( $login ) ) {
				// username is available...
				$psstats_user_login = $login;
			} else {
				// this username seems taken... lets create another one

				$index = 0;
				do {
					if ( ! $index ) {
						$psstats_user_login = 'wp_' . $login;
					} else {
						$psstats_user_login = 'wp_' . $login . $index;
					}

					$index ++;
				} while ( $user_model->getUser( $psstats_user_login ) );
			}
		}

		if ( ! $psstats_user_login || empty( $user_in_psstats ) ) {
			$this->logger->log( 'Psstats erstellt jetzt einen Benutzer für UserId ' . $user_id . ' mit Psstats-Login ' . $psstats_user_login );

			$now      = Date::now()->getDatetime();
			$password = new Password();
			// we generate some random password since log in using psstats won't be happening anyway
			$password = $password->hash( $login . $now . Common::getRandomString( 200 ) . microtime( true ) . Common::generateUniqId() );

			$user_model->addUser( $psstats_user_login, $password, $wp_user->user_email, $now );

			User::map_psstats_user_login( $user_id, $psstats_user_login );
		} elseif ( $user_in_psstats['email'] !== $wp_user->user_email ) {
			$this->logger->log( 'Psstats aktualisiert jetzt die E-Mail für wpUserID ' . $user_id . ' Psstats-Login ' . $psstats_user_login );
			$user_model->updateUserFields( $psstats_user_login, array( 'email' => $wp_user->user_email ) );
		}

		return $psstats_user_login;
	}
}
