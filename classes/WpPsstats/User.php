<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class User {

	const USER_MAPPING_PREFIX = 'psstats-user-login-';

	/**
	 * @api
	 */
	public function get_current_psstats_user_login() {
		if ( get_current_user_id() ) {
			return self::get_psstats_user_login( get_current_user_id() );
		}
	}

	public static function get_psstats_user_login( $wp_user_id ) {
		return get_option( self::USER_MAPPING_PREFIX . $wp_user_id );
	}

	public static function map_psstats_user_login( $wp_user_id, $psstats_user_login ) {
		if ( empty( $psstats_user_login ) ) {
			delete_option( self::USER_MAPPING_PREFIX . $wp_user_id );
		} else {
			update_option( self::USER_MAPPING_PREFIX . $wp_user_id, $psstats_user_login );
		}
	}

	public function uninstall() {
		Uninstaller::uninstall_options( self::USER_MAPPING_PREFIX );
	}


}
