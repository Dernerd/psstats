<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

if ( ! defined( 'ABSPATH' ) && ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit; // if accessed directly
}

if ( ! defined( 'PSSTATS_UPLOAD_DIR' ) ) {
	define( 'PSSTATS_UPLOAD_DIR', 'psstats' );
}
if ( ! defined( 'PSSTATS_CONFIG_PATH' ) ) {
	define( 'PSSTATS_CONFIG_PATH', 'config/config.ini.php' );
}
if ( ! defined( 'PSSTATS_JS_NAME' ) ) {
	define( 'PSSTATS_JS_NAME', 'psstats.js' );
}
if ( ! defined( 'PSSTATS_DATABASE_PREFIX' ) ) {
	define( 'PSSTATS_DATABASE_PREFIX', 'psstats_' );
}
/**
 * @param string $class_name
 */
function psstats_plugin_autoloader( $class_name ) {
	$root_namespace      = 'WpPsstats';
	$root_len            = strlen( $root_namespace ) + 1; // +1 for namespace separator
	$namespace_separator = '\\';

	if ( substr( $class_name, 0, $root_len ) === $root_namespace . $namespace_separator ) {
		$class_name = str_replace( '.', '', str_replace( $namespace_separator, DIRECTORY_SEPARATOR, substr( $class_name, $root_len ) ) );
		require_once 'classes' . DIRECTORY_SEPARATOR . $root_namespace . DIRECTORY_SEPARATOR . $class_name . '.php';
	}
}

spl_autoload_register( 'psstats_plugin_autoloader' );
