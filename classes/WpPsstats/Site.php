<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class Site {

	const SITE_MAPPING_PREFIX = 'psstats-site-id-';

	/**
	 * @api
	 */
	public function get_current_psstats_site_id() {
		return self::get_psstats_site_id( get_current_blog_id() );
	}

	public static function get_psstats_site_id( $blog_id ) {
		return get_site_option( self::SITE_MAPPING_PREFIX . $blog_id );
	}

	public static function map_psstats_site_id( $blog_id, $psstats_id_site ) {
		$key = self::SITE_MAPPING_PREFIX . $blog_id;

		if ( null === $psstats_id_site || false === $psstats_id_site ) {
			delete_site_option( $key );
		} else {
			update_site_option( $key, $psstats_id_site );
		}
	}

	public function uninstall() {
		Uninstaller::uninstall_site_meta( self::SITE_MAPPING_PREFIX );
	}
}
