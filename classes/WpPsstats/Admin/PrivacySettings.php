<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats\Admin;

use WpPsstats\Settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class PrivacySettings implements AdminSettingsInterface {
	const EXAMPLE_MINIMAL = '[psstats_opt_out]';
	const EXAMPLE_FULL    = '[psstats_opt_out language=de]';

    /**
     * @var Settings
     */
    private $settings;

    public function __construct( Settings $settings ) {
        $this->settings = $settings;
    }

	public function get_title() {
		return esc_html__( 'Privacy & GDPR', 'psstats' );
	}

	public function show_settings() {
        $psstats_settings = $this->settings;

		include dirname( __FILE__ ) . '/views/privacy_gdpr.php';
	}
}
