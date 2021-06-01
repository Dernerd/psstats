<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats\Admin;

use WpPsstats\Capabilities;
use WpPsstats\Report\Dates;
use WpPsstats\Report\Metadata;
use WpPsstats\Report\Renderer;
use WpPsstats\Settings;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class Summary {

	const NONCE_DASHBOARD = 'psstats_pin_dashboard';

	/**
	 * @var Settings
	 */
	private $settings;

	/**
	 * @param Settings $settings
	 */
	public function __construct( $settings ) {
		$this->settings = $settings;
	}

	private function pin_if_submitted() {
		if ( ! empty( $_GET[ 'pin' ] )
			 && ! empty( $_GET[ 'report_uniqueid' ] )
			 && ! empty( $_GET[ 'report_date' ] )
		     && is_admin()
		     && check_admin_referer( self::NONCE_DASHBOARD )
             && is_user_logged_in()
		     && current_user_can( Capabilities::KEY_VIEW ) ) {
			$unique_id = $_GET[ 'report_uniqueid' ];
			$date      = $_GET[ 'report_date' ];

			$dashobard = new Dashboard();
			if ($dashobard->is_valid_widget($unique_id, $date)) {
				$dashobard->toggle_widget( $unique_id, $date );
                return true;
			}
		}

		return false;
	}

	public function show() {
		$psstats_pinned = $this->pin_if_submitted();

		$settings = $this->settings;

		$reports_to_show = $this->get_reports_to_show();
		$filter_limit    = apply_filters( 'psstats_report_summary_filter_limit', 10 );

		$report_dates_obj = new Dates();
		$report_dates     = $report_dates_obj->get_supported_dates();

		$report_date = Dates::YESTERDAY;
		if ( isset( $_GET['report_date'] ) && isset( $report_dates[ $_GET['report_date'] ] ) ) {
			$report_date = $_GET['report_date'];
		}

		list( $report_period_selected, $report_date_selected ) = $report_dates_obj->detect_period_and_date( $report_date );

		$is_tracking = $this->settings->is_tracking_enabled();

		$psstats_dashboard = new Dashboard();

		$wp_version =  get_bloginfo( 'version' );
		$psstats_is_version_pre55 = empty($wp_version) || version_compare($wp_version, '5.5.0') === -1;

		include dirname( __FILE__ ) . '/views/summary.php';
	}

	private function get_reports_to_show() {
		$reports_to_show = array(
			'VisitsSummary_get',
			'UserCountry_getCountry',
			'DevicesDetection_getType',
			'Resolution_getResolution',
			'DevicesDetection_getOsFamilies',
			'DevicesDetection_getBrowsers',
			'VisitTime_getVisitInformationPerServerTime',
			'Actions_get',
			'Actions_getPageTitles',
			'Actions_getEntryPageTitles',
			'Actions_getExitPageTitles',
			'Actions_getDownloads',
			'Actions_getOutlinks',
			'Referrers_getAll',
			'Referrers_getSocials',
			'Referrers_getCampaigns',
			'Goals_get',
		);

		if ( $this->settings->get_global_option( 'track_ecommerce' ) ) {
			$reports_to_show[] = 'Goals_get_idGoal--ecommerceOrder';
			$reports_to_show[] = 'Goals_getItemsName';
		}

		$reports_to_show[] = Renderer::CUSTOM_UNIQUE_ID_VISITS_OVER_TIME;
		$reports_to_show = apply_filters( 'psstats_report_summary_report_ids', $reports_to_show );

		$report_metadata = array();
		$metadata        = new Metadata();
		foreach ( $reports_to_show as $report_unique_id ) {
			$report = $metadata->find_report_by_unique_id( $report_unique_id );
			if ( $report ) {
				$report_page = $metadata->find_report_page_params_by_report_metadata( $report );
				if ( $report_page ) {
					$report['page'] = $report_page;
				}
				$report_metadata[] = $report;
			}
		}

		return $report_metadata;
	}

}
