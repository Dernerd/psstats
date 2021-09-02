<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats\Admin;

use WpPsstats\Settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class Admin {
	/**
	 * @param Settings $settings
	 */
	public function __construct( $settings, $init_menu = true ) {
		if ($init_menu) {
			new Menu( $settings );
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'load_scripts' ) );
	}

	public function load_scripts() {
		wp_enqueue_style( 'psstats_admin_css', plugins_url( 'assets/css/admin-style.css', PSSTATS_ANALYTICS_FILE ), false, '1.0.0' );
		wp_enqueue_script( 'psstats_admin_js', plugins_url( 'assets/js/admin.js', PSSTATS_ANALYTICS_FILE ), array( 'jquery' ), '1.0', true  );
	}

}
