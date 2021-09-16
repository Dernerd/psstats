<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

use WpPsstats\Admin\Menu;
use WpPsstats\Report\Dates;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** @var array $report_metadata */
/** @var array $report_dates */
/** @var array $reports_to_show */
/** @var string $report_date */
/** @var string $report_period_selected */
/** @var string $report_date_selected */
/** @var bool $psstats_pinned */
/** @var bool $is_tracking */
/** @var bool $psstats_is_version_pre55 */
/** @var \WpPsstats\Admin\Dashboard $psstats_dashboard */
global $wp;

$psstats_dashboard_nonce = wp_create_nonce(\WpPsstats\Admin\Summary::NONCE_DASHBOARD);
?>
<?php
    if ($psstats_pinned) {
        echo '<div class="notice notice-success"><p>' . esc_html__( 'Dashboard aktualisiert.', 'psstats' ) . '</p></div>';
    }
    if ($psstats_is_version_pre55) {
        echo '<style type="text/css">.handle-actions { position: absolute; right: 0;top: 0;}</style>';
    }
?>
<?php if ( ! $is_tracking ) { ?>
	<div class="notice notice-warning"><p><?php esc_html_e( 'Psstats-Tracking ist nicht aktiviert. Wenn Du den Psstats-Tracking-Code auf andere Weise hinzugefügt hast, beispielsweise mit einem Einwilligungs-Plugin, kannst Du diese Nachricht ignorieren.', 'psstats' ); ?></p></div>
<?php } ?>
<div class="wrap">
	<div id="icon-plugins" class="icon32"></div>
	<h1><?php psstats_header_icon(); ?> <?php esc_html_e( 'Zusammenfassung', 'psstats' ); ?></h1>
	<?php
	if ( Dates::TODAY === $report_date ) {
		echo '<div class="notice notice-info" style="padding:8px;">' . esc_html__( 'Berichte für heute werden nur ungefähr stündlich über den WordPress-Cronjob aktualisiert.', 'psstats' ) . '</div>';
	}
	?>
	<p><?php esc_html_e( 'Suche nach allen Berichten und erweiterten Funktionen wie Segmentierung, Echtzeitberichten und mehr?', 'psstats' ); ?>
		<a href="<?php echo add_query_arg( array( 'report_date' => $report_date ), menu_page_url( Menu::SLUG_REPORTING, false ) ); ?>"
		><?php esc_html_e( 'Vollständige Berichte anzeigen', 'psstats' ); ?></a>
		<br/><br/>
		<?php esc_html_e( 'Datum ändern:', 'psstats' ); ?>
		<?php
		foreach ( $report_dates as $psstats_report_date_key => $psstats_report_name ) {
			$psstats_button_class = 'button';
			if ( $report_date === $psstats_report_date_key ) {
				$psstats_button_class = 'button-primary';
			}
			echo '<a href="' . esc_url( add_query_arg( array( 'report_date' => $psstats_report_date_key ), menu_page_url( Menu::SLUG_REPORT_SUMMARY, false ) ) ) . '" class="' . $psstats_button_class . '">' . esc_html( $psstats_report_name ) . '</a> ';
		}
		?>

	<div id="dashboard-widgets" class="metabox-holder  has-right-sidebar psstats-dashboard-container">
		<?php
		$psstats_columns = array( 1, 0 );
		foreach ( $psstats_columns as $psstats_column_index => $psstats_column_modulo ) {
			?>
			<div id="postbox-container-<?php echo( $psstats_column_index + 1 ); ?>" class="postbox-container">
				<div id="normal-sortables" class="meta-box-sortables ui-sortable">
					<?php
					foreach ( $reports_to_show as $psstats_index => $psstats_report_meta ) {
						if ( $psstats_index % 2 === $psstats_column_modulo ) {
							continue;
						}
						$shortcode = sprintf( '[psstats_report unique_id=%s report_date=%s limit=10]', $psstats_report_meta['uniqueId'], $report_date );
						?>
						<div class="postbox ">
                            <div class="postbox-header">
                            <h2 class="hndle ui-sortable-handle"
                                style="cursor: help;"
                                title="<?php echo ! empty( $psstats_report_meta['documentation'] ) ? ( wp_strip_all_tags( $psstats_report_meta['documentation'] ) . ' ' ) : null; ?><?php esc_html_e( 'Du kannst diesen Bericht auf jeder Seite einbetten mit dem Shortcode:', 'psstats' ); ?> <?php echo esc_attr( $shortcode ); ?>"
                            >
	                            <?php echo esc_html( $psstats_report_meta['name'] ); ?></h2>
                            <div class="handle-actions hide-if-no-js">
							<?php if ( ! empty( $psstats_report_meta['page'] ) ) { ?>
								<button type="button" class="handlediv" aria-expanded="true"
										title="<?php esc_html_e( 'Klicke hier, um den Bericht im Detail anzuzeigen', 'psstats' ); ?>"><a
										href="
										<?php

										echo Menu::get_psstats_reporting_url(
											$psstats_report_meta['page']['category'],
											$psstats_report_meta['page']['subcategory'],
											array(
												'period' => $report_period_selected,
												'date'   => $report_date_selected,
											)
										);
										?>
												" style="color: inherit;text-decoration: none;" target="_blank" rel="noreferrer noopener"
										class="dashicons-before dashicons-external" aria-hidden="true"></a></button>
							<?php } ?>

                            <?php
                            $psstats_is_dashboard_widget = $psstats_dashboard->has_widget($psstats_report_meta['uniqueId'], $report_date);
                            ?>
                            <button type="button" class="handlediv" aria-expanded="true"
                                    title="<?php if ($psstats_is_dashboard_widget) { esc_html_e( 'Klicke hier, um diesen Bericht aus dem WordPress-Admin-Dashboard zu entfernen', 'psstats' ); } else { esc_html_e( 'Click to add this report to the WordPress admin dashboard', 'psstats' ); } ?>"><a
                                        href="
										<?php
                                        echo esc_url(add_query_arg(array(
                                                'pin' => true,
                                                '_wpnonce' => $psstats_dashboard_nonce,
                                                'report_uniqueid' => $psstats_report_meta['uniqueId'],
                                                'report_date' => $report_date,
                                        ), menu_page_url(Menu::SLUG_REPORT_SUMMARY, false)));
										?>
												" style="color: inherit;text-decoration: none;<?php if ($psstats_is_dashboard_widget) {  echo 'opacity: 0.4 !important'; } ?>"
                                        class="dashicons-before dashicons-admin-post" aria-hidden="true"></a></button>

                            </div></div>
							<div>
								<?php echo do_shortcode( $shortcode ); ?>
							</div>
						</div>
					<?php } ?>
				</div>
			</div>
		<?php } ?>
	</div>

	<p style="clear:both;">
		<?php esc_html_e( 'Wusstest du schon? Du kannst jeden Bericht mit einem Shortcode in jede Seite oder jeden Beitrag einbetten. Bewege einfach die Maus über den Titel, um den richtigen Shortcode zu finden.', 'psstats' ); ?>
		<?php esc_html_e( 'Nur Benutzer mit Lesezugriff können den Inhalt des Berichts anzeigen.', 'psstats' ); ?>
		<?php esc_html_e( 'Hinweis: Das Einbetten von Berichtsdaten kann schwierig sein, wenn Du Caching-Plugins verwendest, die den gesamten HTML-Code Deiner Seite oder Deines Beitrags zwischenspeichern. Falls Du ein solches Plugin verwendest, empfehlen wir Dir, das Caching für diese Seiten zu deaktivieren.', 'psstats' ); ?>
	</p>
</div>
