<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats\Report;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class Dates {
	const TODAY      = 'today';
	const YESTERDAY  = 'yesterday';
	const THIS_WEEK  = 'thisweek';
	const LAST_WEEK  = 'lastweek';
	const THIS_MONTH = 'thismonth';
	const LAST_MONTH = 'lastmonth';
	const THIS_YEAR  = 'thisyear';

	public function get_supported_dates() {
		return array(
			self::YESTERDAY  => 'Gestern',
			self::TODAY      => 'Heute',
			self::THIS_WEEK  => 'Diese Woche',
			self::LAST_WEEK  => 'Letzte Woche',
			self::THIS_MONTH => 'Diesen Monat',
			self::LAST_MONTH => 'Letzten Monat',
			self::THIS_YEAR  => 'Dieses Jahr',
		);
	}

	public function detect_period_and_date( $report_date ) {
		$period = 'day';
		$date   = 'yesterday';

		switch ( $report_date ) {
			case self::TODAY:
				$period = 'day';
				$date   = 'today';
				break;
			case self::YESTERDAY:
				$period = 'day';
				$date   = 'yesterday';
				break;
			case self::THIS_MONTH:
				$period = 'month';
				$date   = 'today';
				break;
			case self::LAST_MONTH:
				$period = 'month';
				$date   = gmdate( 'Y-m-d', strtotime( 'Vor 1 Monat' ) );
				break;
			case self::THIS_WEEK:
				$period = 'week';
				$date   = 'today';
				break;
			case self::LAST_WEEK:
				$period = 'week';
				$date   = gmdate( 'Y-m-d', strtotime( 'Vor 1 Woche' ) );
				break;
			case self::THIS_YEAR:
				$period = 'year';
				$date   = 'today';
				break;
			default:
				if ( preg_match( '/\d{4}-\d{2}-\d{2}/', $report_date ) ) {
					$period = 'day';
					$date   = $report_date;
				}
		}

		return array( $period, $date );
	}


}
