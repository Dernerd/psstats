<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

use WpPsstats\Admin\Menu;
use WpPsstats\Admin\Dashboard;
use WpPsstats\Commands\PsstatsCommands;
use WpPsstats\Ecommerce\EasyDigitalDownloads;
use WpPsstats\Ecommerce\MemberPress;
use WpPsstats\OptOut;
use WpPsstats\Paths;
use WpPsstats\ScheduledTasks;
use \WpPsstats\Site\Sync as SiteSync;
use WpPsstats\AjaxTracker;
use \WpPsstats\User\Sync as UserSync;
use \WpPsstats\Installer;
use \WpPsstats\Updater;
use \WpPsstats\Roles;
use \WpPsstats\Annotations;
use \WpPsstats\TrackingCode;
use \WpPsstats\Settings;
use \WpPsstats\Capabilities;
use \WpPsstats\Ecommerce\Woocommerce;
use \WpPsstats\Report\Renderer;
use WpPsstats\API;
use \WpPsstats\Admin\Admin;

class WpPsstats {

	/**
	 * @var Settings
	 */
	public static $settings;

	public function __construct() {
		if ( ! $this->check_compatibility() ) {
			return;
		}

		self::$settings = new Settings();

		if ( self::is_safe_mode() ) {
			if ( is_admin() ) {
				new Admin( self::$settings, false );
				new \WpPsstats\Admin\SafeModeMenu( self::$settings );
			}

			return;
		}

		add_action( 'init', array( $this, 'init_plugin' ) );

		$capabilities = new Capabilities( self::$settings );
		$capabilities->register_hooks();

		$roles = new Roles( self::$settings );
		$roles->register_hooks();

		$compatibility = new \WpPsstats\Compatibility();
		$compatibility->register_hooks();

		$scheduled_tasks = new ScheduledTasks( self::$settings );
		$scheduled_tasks->schedule();

		$privacy_badge = new OptOut();
		$privacy_badge->register_hooks();

		$renderer = new Renderer();
		$renderer->register_hooks();

		$api = new API();
		$api->register_hooks();

		if ( is_admin() ) {
			new Admin( self::$settings );

			$dashboard = new Dashboard();
			$dashboard->register_hooks();

			$site_sync = new SiteSync( self::$settings );
			$site_sync->register_hooks();
			$user_sync = new UserSync();
			$user_sync->register_hooks();

			$referral = new \WpPsstats\Referral();
			if ($referral->should_show()) {
				$referral->register_hooks();
			}
		}

		$tracking_code = new TrackingCode( self::$settings );
		$tracking_code->register_hooks();
		$annotations = new Annotations( self::$settings );
		$annotations->register_hooks();

		if ( defined( 'WP_CLI' ) && WP_CLI ) {
			new PsstatsCommands();
		}

		add_filter(
			'plugin_action_links_' . plugin_basename( PSSTATS_ANALYTICS_FILE ),
			array(
				$this,
				'add_settings_link',
			)
		);
	}

	private function check_compatibility() {
		if ( ! is_admin() ) {
			return true;
		}
		if ( psstats_is_app_request() ) {
			return true;
		}

		$paths       = new Paths();
		$upload_path = $paths->get_upload_base_dir();

		if ( $upload_path
			 && ! is_writable( dirname( $upload_path ) ) ) {
			add_action(
				'init',
				function () use ( $upload_path ) {
					if ( self::is_admin_user() ) {
						add_action(
							'admin_notices',
							function () use ( $upload_path ) {
								echo '<div class="error"><p>' . sprintf(__( 'Psstats Analytics erfordert, dass das Upload-Verzeichnis %s beschreibbar ist. Bitte mache das Verzeichnis beschreibbar, damit es funktioniert.', 'psstats' ), '(' . esc_html( dirname( $upload_path ) ) . ')') . '</p></div>';
							}
						);
					}
				}
			);

			return false;
		}

		return true;
	}

	public static function is_admin_user() {
		if ( ! function_exists( 'is_multisite' )
			 || ! is_multisite() ) {
			return current_user_can( 'administrator' );
		}

		return is_super_admin();
	}

	private static function get_active_plugins()
	{
		$plugins = [];
		if (function_exists('is_multisite') && is_multisite()) {
			$muplugins = get_site_option( 'active_sitewide_plugins' );
			$plugins = array_keys($muplugins);
		}
		$plugins = array_merge((array) get_option( 'active_plugins', array() ), $plugins);

		return $plugins;
	}

	public static function is_safe_mode() {
		if ( defined( 'PSSTATS_SAFE_MODE' ) ) {
			return PSSTATS_SAFE_MODE;
		}

		// we are not using is_plugin_active() for performance reasons
		$active_plugins = self::get_active_plugins();

		if (in_array('wp-rss-aggregator/wp-rss-aggregator.php', $active_plugins)
			|| in_array('wp-defender/wp-defender.php', $active_plugins)) {
			return true;
		}

		return false;
	}

	public function add_settings_link( $links ) {
		$get_started = new \WpPsstats\Admin\GetStarted( self::$settings );

		if ( self::$settings->get_global_option( Settings::SHOW_GET_STARTED_PAGE ) && $get_started->can_user_manage() ) {
			$links[] = '<a href="' . menu_page_url( Menu::SLUG_GET_STARTED, false ) . '">' . __( 'Loslegen', 'psstats' ) . '</a>';
		} elseif ( current_user_can( Capabilities::KEY_SUPERUSER ) ) {
			$links[] = '<a href="' . menu_page_url( Menu::SLUG_SETTINGS, false ) . '">' . __( 'Einstellungen', 'psstats' ) . '</a>';
		}

		return $links;
	}

	public function init_plugin() {
		if ( ( is_admin() || psstats_is_app_request() )
			 && ( ! defined( 'DOING_AJAX' ) || ! DOING_AJAX ) ) {
			$installer = new Installer( self::$settings );
			$installer->register_hooks();
			if ( $installer->looks_like_it_is_installed() ) {
				if ( is_admin()
					 && ( ! defined( 'PSSTATS_ENABLE_AUTO_UPGRADE' ) || PSSTATS_ENABLE_AUTO_UPGRADE ) ) {
					$updater = new Updater( self::$settings );
					$updater->update_if_needed();
				}
			} else {
				if ( psstats_is_app_request() ) {
					// we can't install if psstats is requested... there's some circular reference
					wp_safe_redirect( admin_url() );
					exit;
				} else {
					if ( $installer->can_be_installed() ) {
						$installer->install();
					}
				}
			}
		}
		$tracking_code = new TrackingCode( self::$settings );
		if ( self::$settings->is_tracking_enabled()
			 && self::$settings->get_global_option( 'track_ecommerce' )
			 && ! $tracking_code->is_hidden_user() ) {
			$tracker = new AjaxTracker( self::$settings );

			$woocommerce = new Woocommerce( $tracker );
			$woocommerce->register_hooks();

			$easy_digital_downloads = new EasyDigitalDownloads( $tracker );
			$easy_digital_downloads->register_hooks();

			$member_press = new MemberPress( $tracker );
			$member_press->register_hooks();

			do_action( 'psstats_ecommerce_init', $tracker );
		}
	}

	public static function should_disable_addhandler()
	{
		return defined('PSSTATS_DISABLE_ADDHANDLER') && PSSTATS_DISABLE_ADDHANDLER;
	}
}
