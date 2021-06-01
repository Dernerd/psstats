<?php

$GLOBALS['CONFIG_INI_PATH_RESOLVER'] = function () {
	if ( defined( 'ABSPATH' )
	     && defined( 'PSSTATS_CONFIG_PATH' ) ) {
		$paths = new \WpPsstats\Paths();

		return $paths->get_config_ini_path();
	}
};

$psstats_is_archive_request = !empty($_SERVER['argv'])
                             && is_array($_SERVER['argv'])
                             && in_array('climulti:request', $_SERVER['argv'], true);

if ( ! defined( 'PIWIK_ENABLE_ERROR_HANDLER' ) ) {
	// we prefer using WP error handler... unless we are archiving where we want to prevent any warnings being printed
	// as otherwise the archiving would be marked as failed because the cli archive output would contain a warning and
	// the output would not be possible to do an unserialize anymore
	if (!$psstats_is_archive_request) {
		define( 'PIWIK_ENABLE_ERROR_HANDLER', false );
	}
}

$GLOBALS['PSSTATS_LOADED_DIRECTLY'] = ! defined( 'ABSPATH' );

if (!function_exists('psstats_ch_dir')) {
	function psstats_ch_dir($file) {
		if (function_exists('chdir') && is_dir(dirname($file))) {
			@chdir(dirname($file));
		}
	}
}

if (!function_exists('psstats_log_message_no_display')) {
	function psstats_log_message_no_display($message)
	{
		$message = 'Psstats ' . $message;

		if ( defined( 'WP_DEBUG' ) && WP_DEBUG === true ) {
			if (function_exists('ini_set') && function_exists('ini_get')) {
				$value_orig = @ini_get('display_errors');
				$value = @ini_set('display_errors', 'Off');
				if (false !== $value) {
					error_log( $message );
				}
				@ini_set('display_errors', $value_orig);
			}
		}

		if (function_exists('update_option')
		    && class_exists('\WpPsstats\Logger')) {
			// only if WordPress was bootstrapped by now... otherwise it will fail
			try {
				$logger = new \WpPsstats\Logger();
				$logger->log_exception('archive_boot', new Exception($message));
			} catch (Exception $e) {

			}
		}
	}
}

if ( $GLOBALS['PSSTATS_LOADED_DIRECTLY'] ) {

	// prevent from loading twice
	$psstats_wpload_base = '../../../../wp-load.php';
	$psstats_wpload_full = dirname( __FILE__ ) . '/' . $psstats_wpload_base;

	if ($psstats_is_archive_request) {
		ob_start();
		// the psstats error handler will be only loaded after WordPress has been loaded... here we want to prevent
		// any warning/notice from being shown while bootstrapping WordPress or otherwise the unserialize of the response
		// later in climulti will fail
		set_error_handler(function ($errno, $errstr, $errfile, $errline) {
			// if the error has been suppressed by the @ we don't handle the error
			if (error_reporting() == 0) {
				return;
			}

			if (in_array($errno, array(E_ERROR, E_PARSE, E_CORE_ERROR, E_CORE_WARNING, E_COMPILE_ERROR, E_COMPILE_WARNING, E_USER_ERROR))) {
				return false; //force standard behaviour
			}

			psstats_log_message_no_display( sprintf('error: %s: %s in %s:%s', $errno, $errstr, $errfile, $errline ) );
		});
	}

	if (!empty($_SERVER['PSSTATS_WP_ROOT_PATH']) && file_exists( rtrim($_SERVER['PSSTATS_WP_ROOT_PATH'], '/') . '/wp-load.php')) {
		$psstats_wp_root_file = rtrim($_SERVER['PSSTATS_WP_ROOT_PATH'], '/') . '/wp-load.php';
		psstats_ch_dir($psstats_wp_root_file);
		require_once $psstats_wp_root_file;
	} elseif (file_exists($psstats_wpload_full ) ) {
		psstats_ch_dir($psstats_wpload_full);
		require_once $psstats_wpload_full;
	} elseif (realpath( $psstats_wpload_full ) && file_exists(realpath( $psstats_wpload_full ))) {
		psstats_ch_dir(realpath( $psstats_wpload_full ));

		require_once realpath( $psstats_wpload_full );
	} elseif (!empty($_SERVER['SCRIPT_FILENAME']) && file_exists($_SERVER['SCRIPT_FILENAME'])) {
		// seems symlinked... eg the wp-content dir or wp-content/plugins dir is symlinked from some very much other place...
		$psstats_wpload_full = dirname($_SERVER['SCRIPT_FILENAME']) . '/' . $psstats_wpload_base;
		if ( file_exists($psstats_wpload_full ) ) {
			psstats_ch_dir($psstats_wpload_full);

			require_once $psstats_wpload_full;
		} elseif (realpath( $psstats_wpload_full ) && file_exists(realpath( $psstats_wpload_full ))) {
			psstats_ch_dir(realpath( $psstats_wpload_full ));
			require_once realpath( $psstats_wpload_full );
		} elseif (file_exists(dirname(dirname(dirname(dirname(dirname( $_SERVER['SCRIPT_FILENAME'] ))))) . '/wp-load.php')) {
			$psstats_relative_path = dirname(dirname(dirname(dirname(dirname( $_SERVER['SCRIPT_FILENAME'] ))))) . '/wp-load.php';

			psstats_ch_dir($psstats_relative_path);
			require_once $psstats_relative_path;
		}
	}

	if (!defined( 'ABSPATH')) {
		// still not loaded... look in plugins directory if there is a config file for us.
		$psstats_wpload_config = dirname(__FILE__) . '/../../psstats.wpload_dir.php';
		if (file_exists( $psstats_wpload_config) && is_readable($psstats_wpload_config)) {
			$psstats_wpload_content = @file_get_contents($psstats_wpload_config); // we do not include that file for security reasons
			if (!empty($psstats_wpload_content)) {
				$psstats_wpload_content = str_replace(array('<?php', 'exit;', 'wp-load.php'), '', $psstats_wpload_content);
				$psstats_wpload_content = preg_replace('/\s/', '', $psstats_wpload_content);
				$psstats_wpload_content = trim(ltrim(trim($psstats_wpload_content), '#')); // the path may be commented out # /abs/path
				if (strpos($psstats_wpload_content, DIRECTORY_SEPARATOR) === 0) {
					$psstats_wpload_file = rtrim($psstats_wpload_content, DIRECTORY_SEPARATOR) . '/wp-load.php';
					if (file_exists($psstats_wpload_file) && is_readable($psstats_wpload_file)) {
						psstats_ch_dir($psstats_wpload_file);
						require_once $psstats_wpload_file;
					}
				}
			}
		}
	}

	if ($psstats_is_archive_request) {
		restore_error_handler();
		if (ob_get_level()) {
			$psstats_ob_end_clean_msg = @ob_get_clean();
			if (!empty($psstats_ob_end_clean_msg)) {
				psstats_log_message_no_display( $psstats_ob_end_clean_msg );
			}
		}
	}
}

if ( ! defined( 'ABSPATH' ) ) {
	echo 'Could not find wp-load. If your server uses symlinks or a custom content directory, Psstats may not work for you as we cannot detect the paths correctly. For more information see https://psstats.org/faq/wordpress/how-do-i-make-psstats-for-wordpress-work-when-i-have-a-custom-content-directory/';
	if (!empty($_SERVER['PSSTATS_WP_ROOT_PATH'])) {
		echo ' Note: A custom WP root path was set.';
	}
	exit; // if accessed directly
}

if ( !is_plugin_active('psstats/psstats.php')
     && (!defined( 'PSSTATS_PHPUNIT_TEST' ) || !PSSTATS_PHPUNIT_TEST) ) { // during tests the plugin may temporarily not be active
    exit;
}

if ( $GLOBALS['PSSTATS_LOADED_DIRECTLY'] ) {
	// see https://github.com/psstats-org/wp-psstats/issues/190
	// wp-external-links plugin would register an ob_start(function () {...}) and manipulate any of our API output
	// and in some cases the output would get completely lost causing blank pages.
	add_filter('wpel_apply_settings', '__return_false', 99999);

	// do not strip slashes if we bootstrap psstats within a regular wordpress request
	if (!empty($_GET)) {
		$_GET     = stripslashes_deep( $_GET );
	}
	if (!empty($_POST)) {
		$_POST    = stripslashes_deep( $_POST );
	}
	if (!empty($_COOKIE)) {
		$_COOKIE  = stripslashes_deep( $_COOKIE );
	}
	if (!empty($_SERVER)) {
		$_SERVER  = stripslashes_deep( $_SERVER );
	}
	if (!empty($_REQUEST)) {
		$_REQUEST = stripslashes_deep( $_REQUEST );
	}
}


if ( psstats_is_app_request() ) {
	// pretend we are in the admin... potentially avoiding caching etc
	$GLOBALS['hook_suffix'] = '';
	include_once ABSPATH . '/wp-admin/includes/class-wp-screen.php';
	$GLOBALS['current_screen'] = WP_Screen::get();

	// we disable jsonp
	unset($_GET['jsoncallback']);
	unset($_GET['callback']);
	unset($_POST['jsoncallback']);
	unset($_POST['callback']);
}

if ( ! defined( 'PIWIK_USER_PATH' ) ) {
	define( 'PIWIK_USER_PATH', dirname( PSSTATS_ANALYTICS_FILE ) );
}

if (function_exists('wp_raise_memory_limit') && function_exists('wp_convert_hr_to_bytes')) {
	$current_limit     = ini_get( 'memory_limit' );
	$current_limit_int = wp_convert_hr_to_bytes( $current_limit );
	$memory128MbInt = 134217728;
	if ($current_limit_int && $current_limit_int > 0 && $current_limit_int < $memory128MbInt) {
		// we try increase memory if memory is less than 128mb
		wp_raise_memory_limit('admin');
	}
}

$GLOBALS['PSSTATS_MODIFY_CONFIG_SETTINGS'] = function ($settings) {
	$plugins = $settings['Plugins'];
	if (is_array($settings['Plugins'])) {
		$pluginsToRemove = array('Marketplace', 'MultiSites', 'TwoFactorAuth', 'Widgetize', 'Monolog', 'Feedback', 'ExamplePlugin', 'ExampleAPI', 'ProfessionalServices', 'MobileAppMeasurable', 'CustomPiwikJs');
		foreach ($pluginsToRemove as $pluginToRemove) {
			// Marketplace => this is instead done in wordpress
			// MultiSites => doesn't really make sense since we have only one website per installation
			// TwoFactorAuth => not needed as login is being handled by WordPress
			// widgetize for now we don't want to allow widgetizing as it is based on the token_auth authentication
			// Monolog => we use our own logger
			// ProfessionalServices => we advertise in the WP plugin itself instead
			// feedback => we want to hide things like Need help in the admin etc
			// MobileAppMeasurable => for WP mobile apps are not a thing
			// custom variables we don't want to enable as we will deprecate them in Psstats 4 anyway => used to be disabled but we need to make sure the columns get installed otherwise psstats has issues... need to wait to psstats 4 to remove it
			$pos = array_search($pluginToRemove, $plugins['Plugins']);
			if ($pos !== false) {
				array_splice($plugins['Plugins'], $pos, 1);
			}
		}
		if (psstats_has_tag_manager()) {
			$plugins['Plugins'][] = 'TagManager';
		}
		$mustEnable = ['BulkTracking', 'CustomJsTracker'];
		foreach ($mustEnable as $enable) {
			if (!in_array($enable, $plugins['Plugins'])) {
				$plugins['Plugins'][] = $enable;
			}
		}
	}
	if (!empty($GLOBALS['PSSTATS_PLUGINS_ENABLED'])) {
		foreach ($GLOBALS['PSSTATS_PLUGINS_ENABLED'] as $plugin) {
			if (!in_array($plugin, $plugins['Plugins'])) {
				$plugins['Plugins'][] = $plugin;
			}
		}
	}
	$settings['Plugins'] = $plugins;
	return $settings;
};
