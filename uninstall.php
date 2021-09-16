<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

// if uninstall.php is not called by WordPress, die.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	die;
}

require 'shared.php';

$psstats_is_using_multi_site    = function_exists( 'is_multisite' ) && is_multisite();
$psstats_settings               = new \WpPsstats\Settings();
$psstats_should_remove_all_data = $psstats_settings->should_delete_all_data_on_uninstall();

$psstats_uninstaller = new \WpPsstats\Uninstaller();
$psstats_uninstaller->uninstall( $psstats_should_remove_all_data );
