<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats\Admin;

use WpPsstats\Capabilities;
use WpPsstats\Logger;
use WpPsstats\Report\Dates;
use WpPsstats\Report\Metadata;
use WpPsstats\Report\Renderer;
use WpPsstats\Uninstaller;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class Dashboard {

	const DASHBOARD_USER_OPTION = 'psstats_dashboard_widgets';

	public function register_hooks() {
		add_action( 'wp_dashboard_setup', array( $this, 'add_dashboard_widgets' ) );
	}

	public function add_dashboard_widgets()
	{
		$widgets = $this->get_widgets();
		if (!empty($widgets) && is_array($widgets) && current_user_can(Capabilities::KEY_VIEW)) {
			foreach ($widgets as $widget) {

			    try {

                    $widget_meta = $this->is_valid_widget($widget['unique_id'], $widget['date']);
                    if (!empty($widget_meta['report']['name'])) {
                        $id = 'psstats_dashboard_widget_' . $widget['unique_id'] .  '_' . $widget['date'];

                        $title = $widget_meta['report']['name'] . ' - ' . $widget_meta['date'] . ' - Psstats';
                        wp_add_dashboard_widget( $id, esc_html($title), function () use ($widget) {
                            $renderer = new Renderer();
                            echo $renderer->show_report(array(
                                'unique_id'   => $widget['unique_id'],
                                'report_date' => $widget['date'],
                                'limit'       => 10,
                            ));
                        });
                    }
                } catch (\Exception $e) {
			        // dont want to break dashboard if there is any issue with psstats ... eg in case bootstrap fails
                    // or is reinstalled but psstats not yet fully installed etc
			        $logger = new Logger();
			        $logger->log(sprintf('Failed to add Psstats widget %s to dashboard: %s', wp_json_encode($widget), $e->getMessage()));
                }
			}
		}
	}

	public function is_valid_widget( $unique_id, $date )
	{
		if (empty($unique_id) || empty($date)) {
			return false;
		}

		$metadata = new Metadata();
		$report = $metadata->find_report_by_unique_id( $unique_id );

		if (empty($report)) {
			return false;
		}

		$report_dates_obj = new Dates();
		$report_dates     = $report_dates_obj->get_supported_dates();

		if (empty($report_dates[$date])) {
			return false;
		}

		return array('report' => $report, 'date' => $report_dates[$date]);
	}

	public function has_widget($report_unique_id, $report_date)
	{
		$widgets = $this->get_widgets();
		foreach ($widgets as $index => $widget) {
			if ($widget['unique_id'] === $report_unique_id && $widget['date'] === $report_date) {
				return true;
			}
		}
		return false;
	}

	public function toggle_widget($report_unique_id, $report_date)
	{
		$widgets = $this->get_widgets();
		foreach ($widgets as $index => $widget) {
			if ($widget['unique_id'] === $report_unique_id && $widget['date'] === $report_date) {
				unset($widgets[$index]);
				$this->set_widgets(array_values($widgets));
				return;
			}
		}
		$widgets[] = array('unique_id' => $report_unique_id, 'date' => $report_date);

		$this->set_widgets($widgets);
	}

	public function get_widgets()
	{
		$meta = get_user_meta(get_current_user_id(), self::DASHBOARD_USER_OPTION, true);
		if (empty($meta)) {
			$meta = array();
		}
		return $meta;
	}

	private function set_widgets($widgets)
	{
		update_user_meta(get_current_user_id(),self::DASHBOARD_USER_OPTION, $widgets);
	}

	public function uninstall() {
	    Uninstaller::uninstall_user_meta(self::DASHBOARD_USER_OPTION);
	}
}
