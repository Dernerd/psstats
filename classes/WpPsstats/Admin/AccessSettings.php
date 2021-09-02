<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats\Admin;

use WpPsstats\Access;
use WpPsstats\Capabilities;
use WpPsstats\Settings;
use WpPsstats\Roles;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class AccessSettings implements AdminSettingsInterface {
	const NONCE_NAME = 'psstats_tracking';
	const FORM_NAME  = 'psstats_role';

	/**
	 * @var Access
	 */
	private $access;

	/**
	 * @var Settings
	 */
	private $settings;

	public function __construct( Access $access, Settings $settings ) {
		$this->access   = $access;
		$this->settings = $settings;
	}

	public function get_title() {
		return esc_html__( 'Zugriff', 'psstats' );
	}

	private function update_if_submitted() {
		if ( isset( $_POST )
			 && ! empty( $_POST[ self::FORM_NAME ] )
			 && is_admin()
			 && check_admin_referer( self::NONCE_NAME )
			 && current_user_can( Capabilities::KEY_SUPERUSER ) ) {
			$this->access->save( $_POST[ self::FORM_NAME ] );

			return true;
		}

		return false;
	}

	public function show_settings() {
		$this->update_if_submitted();

		$access      = $this->access;
		$roles       = new Roles( $this->settings );
		$capabilites = new Capabilities( $this->settings );
		include dirname( __FILE__ ) . '/views/access.php';
	}

}
