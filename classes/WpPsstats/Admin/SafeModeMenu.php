<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
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

class SafeModeMenu {
	/**
	 * @var Settings
	 */
	private $settings;

	private $parent_slug = 'psstats';

	/**
	 * @param Settings $settings
	 */
	public function __construct( $settings ) {
		$this->settings = $settings;
		add_action( 'admin_menu', array( $this, 'add_menu' ) );
		add_action( 'network_admin_menu', array( $this, 'add_menu' ) );
	}

	public function add_menu() {
		if ( ! \WpPsstats::is_admin_user() ) {
			return;
		}

		$system_report = new SystemReport( $this->settings );

		add_menu_page( 'Psstats Analytics', 'Psstats Analytics', Menu::CAP_NOT_EXISTS, 'psstats', null, 'dashicons-analytics' );

		add_submenu_page(
			$this->parent_slug,
			__( 'System Report', 'psstats' ),
			__( 'System Report', 'psstats' ),
			'administrator',
			Menu::SLUG_SYSTEM_REPORT,
			array(
				$system_report,
				'show',
			)
		);
	}

}
