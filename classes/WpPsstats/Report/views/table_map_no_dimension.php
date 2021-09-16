<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

/** @var array $report */
/** @var array $report_meta */
/** @var string $first_metric_name */
?>
<div class="table">
	<table class="widefat psstats-table">

		<tbody>
		<?php
		$psstats_report_metadata = $report['reportMetadata'];
		$psstats_tables = $report['reportData']->getDataTables();
		foreach (array_reverse($psstats_tables)  as $psstats_report_date => $psstats_report_table ) {
			/** @var \Piwik\DataTable\Simple $psstats_report_table  */
			echo '<tr><td width="75%">' . esc_html( $psstats_report_date ) . '</td><td width="25%">';
			if ($psstats_report_table->getFirstRow()) {
				echo esc_html( $psstats_report_table->getFirstRow()->getColumn( $first_metric_name ) );
			} else {
				echo '-';
			}
			echo '</td></tr>';
		}
		?>
		</tbody>
	</table>
</div>
