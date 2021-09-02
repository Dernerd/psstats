<?php
/**
 * Psstats - free/libre analytics platform
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
/** @var string $first_metric_display_name */
?>

<div class="table">
	<table class="widefat psstats-table">
		<tbody>
		<?php
		$psstats_columns = ! empty( $report['columns'] ) ? $report['columns'] : array();
		foreach ( $report['reportData']->getRows() as $psstats_val => $psstats_row ) {
			foreach ( $psstats_row as $psstats_metric_name => $psstats_value ) {
				$psstats_display_name = ! empty( $psstats_columns[ $psstats_metric_name ] ) ? $psstats_columns[ $psstats_metric_name ] : $psstats_metric_name;
				echo '<tr><td width="75%">' . esc_html( $psstats_display_name ) . '</td><td width="25%">' . esc_html( $psstats_value ) . '</td></tr>';
			}
		}
		?>
		</tbody>

	</table>
</div>
