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
		<thead>
		<tr>
			<th width="75%"><?php echo esc_html( $report_meta['dimension'] ); ?></th>
			<th class="right"><?php echo esc_html( $first_metric_display_name ); ?></th>
		</tr>
		</thead>

		<tbody>
		<?php
		$psstats_report_metadata = $report['reportMetadata'];
		foreach ( $report['reportData']->getRows() as $psstats_report_id => $psstats_report_row ) {
			if ( ! empty( $psstats_report_row[ $first_metric_name ] ) ) {
				$psstats_logo_image = '';
				$psstats_meta_row   = $psstats_report_metadata->getRowFromId( $psstats_report_id );
				if ( ! empty( $psstats_meta_row ) ) {
					$psstats_logo = $psstats_meta_row->getColumn( 'logo' );
					if ( ! empty( $psstats_logo ) ) {
						$psstats_logo_image = '<img height="16" src="' . plugins_url( 'app/' . $psstats_logo, PSSTATS_ANALYTICS_FILE ) . '"> ';
					}
				}

				echo '<tr><td width="75%">' . $psstats_logo_image . esc_html( $psstats_report_row['label'] ) . '</td><td width="25%">' . esc_html( $psstats_report_row[ $first_metric_name ] ) . '</td></tr>';
			}
		}
		?>
		</tbody>
	</table>
</div>
