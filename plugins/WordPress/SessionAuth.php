<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\WordPress;

use Piwik\AuthResult;
use Piwik\Common;
use Piwik\FrontController;
use Piwik\Plugins\UsersManager\Model;
use Piwik\Session;
use Piwik\SettingsPiwik;
use WpPsstats\Capabilities;
use WpPsstats\Settings;
use WpPsstats\Site;
use WpPsstats\User;

if (!defined( 'ABSPATH')) {
    exit; // if accessed directly
}

class SessionAuth extends \Piwik\Session\SessionAuth
{
    public function authenticate()
    {
        if (function_exists('is_user_logged_in') && is_user_logged_in()) {

            $user = wp_get_current_user();

            $permission = null;
            if ($user && current_user_can(Capabilities::KEY_SUPERUSER)) {
                $permission = AuthResult::SUCCESS_SUPERUSER_AUTH_CODE;
            } else if ($user && current_user_can(Capabilities::KEY_VIEW)) {
                $permission = AuthResult::SUCCESS;
            }

            if (!empty($permission)) {
                $psstats_user = $this->findPsstatsUser($user->ID);
                $token = $this->makeTemporaryToken($psstats_user['login'], $user->user_registered . '' . $user->ID);

                if ($this->getTokenAuth() !== false
                    && $this->getTokenAuth() !== null
                    && !Common::hashEquals((string) $token, (string) $this->getTokenAuth()) // note both may be converted to empty string in worst case so still the one below needed
                    && $token !== $this->getTokenAuth()) {
                    return new AuthResult(AuthResult::FAILURE, $psstats_user['login'], null);
                }

                return new AuthResult($permission, $psstats_user['login'], $token);
            }
        }

        $login = 'anonymous';
        return new AuthResult(AuthResult::FAILURE, $login, $login);
    }

    private function makeTemporaryToken($login, $register_date)
    {
        $transientKey = md5($login . SettingsPiwik::getSalt() . $register_date);

        $token = get_transient( $transientKey);

        if (!$token) {
            $token = Common::generateUniqId();
        }

        set_transient( $transientKey, $token, 3600 ); // extend for one hour each time

        return $token;
    }

    private function findPsstatsUser($userId, $syncIfNotFound = true)
    {
	    $login = User::get_psstats_user_login($userId);

	    if ($login) {
			// user is already synced
		    $userModel = new Model();
		    $user      = $userModel->getUser($login);
	    }

        if (empty($user['login'])) {
            if ($syncIfNotFound) {
            	$site = new Site\Sync(new Settings());
            	$site->sync_current_site();

                // user should be synced...
                $sync = new User\Sync();
                $sync->sync_current_users();

                return $this->findPsstatsUser($userId, $syncIfNotFound = false);
            }
            throw new \Exception('Der Benutzer ist noch nicht synchronisiert, bitte versuche es später erneut');
        }
        return $user;
    }
}
