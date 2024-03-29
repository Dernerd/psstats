<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats\Admin;

use Piwik\Plugins\UsersManager\UserPreferences;
use WpPsstats\Bootstrap;
use WpPsstats\Capabilities;
use WpPsstats\Report\Dates;
use WpPsstats\Settings;
use WpPsstats\Site;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class Menu {
	/**
	 * @var Settings
	 */
	private $settings;

	public static $parent_slug = 'psstats';

	const REPORTING_GOTO_ADMIN          = 'psstats-admin';
	const REPORTING_GOTO_GDPR_TOOLS     = 'psstats-gdpr-tools';
	const REPORTING_GOTO_GDPR_OVERVIEW  = 'psstats-gdpr-overview';
	const REPORTING_GOTO_ASK_CONSENT    = 'psstats-gdpr-consent';
	const REPORTING_GOTO_OPTOUT         = 'psstats-privacy-optout';
	const REPORTING_GOTO_ANONYMIZE_DATA = 'psstats-anonymize-date';
	const REPORTING_GOTO_DATA_RETENTION = 'psstats-data-retention';
	const SLUG_SYSTEM_REPORT            = 'psstats-systemreport';
	const SLUG_REPORT_SUMMARY           = 'psstats-summary';
	const SLUG_TAGMANAGER               = 'psstats-tagmanager';
	const SLUG_REPORTING                = 'psstats-reporting';
	const SLUG_SETTINGS                 = 'psstats-settings';
	const SLUG_GET_STARTED              = 'psstats-get-started';
	const SLUG_ABOUT                    = 'psstats-about';
	const SLUG_MARKETPLACE              = 'psstats-marketplace';

	const CAP_NOT_EXISTS = 'unknownfoobar';

	/**
	 * @param Settings $settings
	 */
	public function __construct( $settings ) {
		$this->settings = $settings;
		// Hook for adding admin menus
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'network_admin_menu', array( $this, 'add_menu' ) );
		add_action( 'admin_head', array( $this, 'menu_external_icons' ) );

		// as we are redirecting we need to perform the redirect as soon as possible before WP has eg echoed the header
		add_action( 'load-psstats-analytics_page_' . self::SLUG_REPORTING, array( $this, 'reporting' ) );
		add_action( 'load-' . self::$parent_slug . '_page_' . self::SLUG_REPORTING, array( $this, 'reporting' ) );
		add_action( 'load-psstats-analytics_page_' . self::SLUG_TAGMANAGER, array( $this, 'tagmanager' ) );
		add_action( 'load-' . self::$parent_slug . '_page_' . self::SLUG_TAGMANAGER, array( $this, 'tagmanager' ) );
	}

	public function add_menu() {
		$info          = new Info();
		$get_started   = new GetStarted( $this->settings );
		$marketplace   = new Marketplace( $this->settings );
		$system_report = new SystemReport( $this->settings );
		$summary       = new Summary( $this->settings );

		$admin_settings = new AdminSettings( $this->settings );

		add_menu_page( 'Psstats Analytics', 'Psstats Analytics', self::CAP_NOT_EXISTS, 'psstats', null, 'dashicons-analytics' );

		if ( $this->settings->get_global_option( Settings::SHOW_GET_STARTED_PAGE ) && $get_started->can_user_manage() ) {
		    if (!is_multisite() || !is_network_admin()) {
                add_submenu_page(
                    self::$parent_slug,
                    __( 'Loslegen', 'psstats' ),
                    __( 'Loslegen', 'psstats' ),
                    Capabilities::KEY_SUPERUSER,
                    self::SLUG_GET_STARTED,
                    array(
                        $get_started,
                        'show',
                    )
                );
            }
		}

		if ( is_network_admin() ) {
			add_submenu_page(
				self::$parent_slug,
				__( 'Multisite', 'psstats' ),
				__( 'Multisite', 'psstats' ),
				Capabilities::KEY_SUPERUSER,
				'psstats-multisite',
				array(
					$info,
					'show_multisite',
				)
			);
		} else {
			add_submenu_page(
				self::$parent_slug,
				__( 'Zusammenfassung', 'psstats' ),
				__( 'Zusammenfassung', 'psstats' ),
				Capabilities::KEY_VIEW,
				self::SLUG_REPORT_SUMMARY,
				array(
					$summary,
					'show',
				)
			);

			// the network itself is not a blog
			add_submenu_page(
				self::$parent_slug,
				__( 'Berichte', 'psstats' ),
				__( 'Berichte', 'psstats' ),
				Capabilities::KEY_VIEW,
				self::SLUG_REPORTING,
				array(
					$this,
					'reporting',
				)
			);
			// the network itself is not a blog
            if ( psstats_has_tag_manager() ) {
                add_submenu_page(
                    self::$parent_slug,
                    __( 'Tag Manager', 'psstats' ),
                    __( 'Tag Manager', 'psstats' ),
                    Capabilities::KEY_WRITE,
                    self::SLUG_TAGMANAGER,
                    array(
                        $this,
                        'tagmanager',
                    )
                );
            }

		}

        // we always show settings except when multi site is used, plugin is not network enabled, and we are in network admin
        $can_psstats_be_managed = ( !is_multisite() || $this->settings->is_network_enabled() || !is_network_admin() );

		if ( $can_psstats_be_managed ) {
			add_submenu_page(
				self::$parent_slug,
				__( 'Einstellungen', 'psstats' ),
				__( 'Einstellungen', 'psstats' ),
				Capabilities::KEY_SUPERUSER,
				self::SLUG_SETTINGS,
				array(
					$admin_settings,
					'show',
				)
			);
		}

		/*if ( ! is_plugin_active( PSSTATS_MARKETPLACE_PLUGIN_NAME ) ) {
			add_submenu_page(
				self::$parent_slug,
				__( 'Marktplatz', 'psstats' ),
				__( 'Marktplatz', 'psstats' ),
				Capabilities::KEY_VIEW,
				self::SLUG_MARKETPLACE,
				array(
					$marketplace,
					'show',
				)
			);
		}*/

		if ( $this->settings->is_network_enabled() || ! is_network_admin() ) {
			add_submenu_page(
				self::$parent_slug,
				__( 'Diagnose', 'psstats' ),
				__( 'Diagnose', 'psstats' ),
				Capabilities::KEY_SUPERUSER,
				self::SLUG_SYSTEM_REPORT,
				array(
					$system_report,
					'show',
				)
			);
		}

		/*add_submenu_page(
			self::$parent_slug,
			__( 'Über', 'psstats' ),
			__( 'Über', 'psstats' ),
			Capabilities::KEY_VIEW,
			self::SLUG_ABOUT,
			array(
				$info,
				'show',
			)
		);*/
	}

	public function menu_external_icons() {
		global $submenu;

		if ( isset( $submenu[ self::$parent_slug ] ) ) {
			$reporting  = __( 'Berichte', 'psstats' );
			$tagmanager = __( 'Tag Manager', 'psstats' );
			foreach ( $submenu[ self::$parent_slug ] as $key => $menu_item ) {
				if ( 0 === strpos( $menu_item[0], $reporting ) || 0 === strpos( $menu_item[0], $tagmanager ) ) {
					$submenu[ self::$parent_slug ][ $key ][0] .= ' <span class="dashicons-before dashicons-external"></span>';
				}
			}
		}
	}

	public static function get_psstats_goto_url( $goto ) {
		return add_query_arg( array( 'goto' => $goto ), menu_page_url( self::SLUG_REPORTING, false ) );
	}

	public static function get_reporting_url() {
		return plugins_url( 'app', PSSTATS_ANALYTICS_FILE ) . '/index.php';
	}

	public function tagmanager() {
		if ( psstats_has_tag_manager() ) {
			$this->go_to_psstats_page( 'TagManager', 'manageContainers', Capabilities::KEY_WRITE );
		}
		exit;
	}

	public function reporting() {
		if ( ! empty( $_GET['goto'] ) ) {
			switch ( $_GET['goto'] ) {
				case self::REPORTING_GOTO_ADMIN:
					$this->go_to_psstats_page( 'CoreAdminHome', 'home', Capabilities::KEY_SUPERUSER );
					break;
				case self::REPORTING_GOTO_GDPR_TOOLS:
					$this->go_to_psstats_page( 'PrivacyManager', 'gdprTools', Capabilities::KEY_SUPERUSER );
					break;
				case self::REPORTING_GOTO_GDPR_OVERVIEW:
					$this->go_to_psstats_page( 'PrivacyManager', 'gdprOverview', Capabilities::KEY_SUPERUSER );
					break;
				case self::REPORTING_GOTO_ASK_CONSENT:
					$this->go_to_psstats_page( 'PrivacyManager', 'consent', Capabilities::KEY_SUPERUSER );
					break;
				case self::REPORTING_GOTO_OPTOUT:
					$this->go_to_psstats_page( 'PrivacyManager', 'usersOptOut', Capabilities::KEY_SUPERUSER );
					break;
				case self::REPORTING_GOTO_ANONYMIZE_DATA:
					$this->go_to_psstats_page( 'PrivacyManager', 'privacySettings', Capabilities::KEY_SUPERUSER );
					break;
				case self::REPORTING_GOTO_DATA_RETENTION:
					$this->go_to_psstats_page( 'CoreAdminHome', 'generalSettings', Capabilities::KEY_SUPERUSER );
					break;
			}
		}

		$url = self::get_reporting_url();

		$site   = new Site();
		$idsite = $site->get_current_psstats_site_id();

		if ( $idsite ) {
			$url = add_query_arg( array( 'idSite' => (int) $idsite ), $url );
		}

		if ( ! empty( $_GET['report_date'] ) ) {
			$url = add_query_arg(
				array(
					'module' => 'CoreHome',
					'action' => 'index',
				),
				$url
			);


			$date                  = new Dates();
			list( $period, $date ) = $date->detect_period_and_date( $_GET['report_date'] );
			$url                   = add_query_arg(
				array(
					'period' => $period,
					'date'   => $date,
				),
				$url
			);
		}

		wp_safe_redirect( $url );
		exit;
	}

	/**
	 * @api
	 */
	public static function get_psstats_reporting_url( $category, $subcategory, $params = array() ) {
		$site   = new Site();
		$idsite = $site->get_current_psstats_site_id();

		if ( ! $idsite ) {
			return;
		}

		$idsite                = (int) $idsite;
		$params['category']    = $category;
		$params['subcategory'] = $subcategory;
		$params['idSite']      = $idsite;

		if ( empty( $params['period'] ) ) {
			$params['period'] = 'day';
		}
		if ( empty( $params['date'] ) ) {
			$params['date'] = 'today';
		}

		$url  = self::make_psstats_app_base_url();
		$url .= '?module=CoreHome&action=index&idSite=' . (int) $idsite . '&period=' . rawurlencode( $params['period'] ) . '&date=' . rawurlencode( $params['date'] ) . '#?&' . http_build_query( $params );

		return $url;
	}

	private static function make_psstats_app_base_url() {
		$url = plugins_url( 'app', PSSTATS_ANALYTICS_FILE );

		return $url . '/index.php';
	}

	/**
	 * @api
	 */
	public static function get_psstats_action_url( $module, $action, $params = array() ) {
		$site   = new Site();
		$idsite = $site->get_current_psstats_site_id();

		if ( ! $idsite ) {
			return;
		}

		$idsite           = (int) $idsite;
		$params['module'] = $module;
		$params['action'] = $action;
		$params['idSite'] = $idsite;

		if ( empty( $params['period'] ) ) {
			$params['period'] = 'day';
		}
		if ( empty( $params['date'] ) ) {
			$params['date'] = 'today';
		}

		$url = self::make_psstats_app_base_url() . '?' . http_build_query( $params );

		return $url;
	}

	public function go_to_psstats_page( $module, $action, $cap ) {
		if ( ! current_user_can( $cap ) ) {
			return;
		}
		Bootstrap::do_bootstrap();

		$user_preferences = new UserPreferences();
		$website_id       = $user_preferences->getDefaultWebsiteId();
		$default_date     = $user_preferences->getDefaultDate();
		$default_period   = $user_preferences->getDefaultPeriod( false );

		$url  = self::make_psstats_app_base_url();
		$url .= '?idSite=' . (int) $website_id . '&period=' . rawurlencode( $default_period ) . '&date=' . rawurlencode( $default_date );
		$url .= '&module=' . rawurlencode( $module ) . '&action=' . rawurlencode( $action );
		wp_safe_redirect( $url );
		exit;
	}

}
