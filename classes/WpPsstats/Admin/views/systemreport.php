<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

use WpPsstats\Access;
use WpPsstats\Admin\Menu;
use WpPsstats\Admin\SystemReport;

/** @var Access $access */
/** @var array $psstats_tables */
/** @var array $psstats_has_exception_logs */
/** @var bool $psstats_has_warning_and_no_errors */
/** @var string $psstats_active_tab */
/** @var \WpPsstats\Settings $settings */

if ( ! function_exists( 'psstats_format_value_text' ) ) {
	function psstats_format_value_text( $value ) {
		if ( is_string( $value ) && ! empty( $value ) ) {
			$psstats_format = array(
				'<br />' => ' ',
				'<br/>'  => ' ',
				'<br>'   => ' ',
			);
			foreach ( $psstats_format as $search => $replace ) {
				$value = str_replace( $search, $replace, $value );
			}
		}

		return $value;
	}
}
?>

<div class="wrap psstats-systemreport">
	<?php
	if ( $psstats_has_warning_and_no_errors ) {
		?>
			<div class="notice notice-warning">
				<p><?php esc_html_e( 'Es gibt einige Probleme mit Deinem System. Psstats wird ausgeführt, aber es können einige kleinere Probleme auftreten. Siehe unten für weitere Informationen.', 'psstats' ); ?></p>
			</div>
		<?php
	}
	?>
	<?php if ( $settings->is_network_enabled() && ! is_network_admin() && is_super_admin() ) { ?>
		<div class="updated notice">
			<p><?php esc_html_e( 'Nur Du siehst diese Seite, da Du der Super-Admin bist', 'psstats' ); ?></p>
		</div>
	<?php } ?>
	<div id="icon-plugins" class="icon32"></div>
    <h1><?php psstats_header_icon(); ?> <?php esc_html_e( 'Diagnose', 'psstats' ); ?></h1>

	<h2 class="nav-tab-wrapper">
		<a href="?page=<?php echo Menu::SLUG_SYSTEM_REPORT; ?>"
		   class="nav-tab <?php echo empty( $psstats_active_tab ) ? 'nav-tab-active' : ''; ?>"> System report</a>
		<a href="?page=<?php echo Menu::SLUG_SYSTEM_REPORT; ?>&tab=troubleshooting"
		   class="nav-tab <?php echo 'troubleshooting' === $psstats_active_tab ? 'nav-tab-active' : ''; ?>">Troubleshooting</a>
	</h2>

	<?php if ( empty( $psstats_active_tab ) ) { ?>

		<p><?php esc_html_e( 'Kopiere die folgenden Informationen, falls unser Support-Team Dich nach diesen Informationen fragt:', 'psstats' ); ?>
			<br/> <br/>
			<a href="javascript:void(0);"
			   onclick="var textarea = document.getElementById('psstats_system_report_info');textarea.select();document.execCommand('copy');"
			   class='button-primary'><?php esc_html_e( 'Systembericht kopieren', 'psstats' ); ?></a>

		</p>
		<textarea style="width:100%;height: 200px;" readonly
				  id="psstats_system_report_info">
				  <?php
					foreach ( $psstats_tables as $psstats_table ) {
						if (empty($psstats_table['rows'])) {
							continue;
						}
						echo '# ' . esc_html( $psstats_table['title'] ) . "\n";
						foreach ( $psstats_table['rows'] as $index => $psstats_row ) {
							if ( ! empty( $psstats_row['section'] ) ) {
								echo "\n\n## " . esc_html( $psstats_row['section'] ) . "\n";
								continue;
							}
							$psstats_value = $psstats_row['value'];
							if ( true === $psstats_value ) {
								$psstats_value = 'Yes';
							} elseif ( false === $psstats_value ) {
								$psstats_value = 'No';
							}
							$psstats_class = '';
							if ( ! empty( $psstats_row['is_error'] ) ) {
								$psstats_class = 'Error ';
							} elseif ( ! empty( $psstats_row['is_warning'] ) ) {
								$psstats_class = 'Warning ';
							}
							echo "\n* " . esc_html( $psstats_class ) . esc_html( $psstats_row['name'] ) . ': ' . esc_html( psstats_anonymize_value( psstats_format_value_text( $psstats_value ) ) );
							if ( isset( $psstats_row['comment'] ) && '' !== $psstats_row['comment'] ) {
								echo ' (' . esc_html( psstats_anonymize_value( psstats_format_value_text( $psstats_row['comment'] ) ) ) . ')';
							}
						}
						echo "\n\n";
					}
					?>
	</textarea>

		<?php
		foreach ( $psstats_tables as $psstats_table ) {
		    if (empty($psstats_table['rows'])) {
		        continue;
            }
			echo '<h2>' . esc_html( $psstats_table['title'] ) . "</h2><table class='widefat'><thead></thead><tbody>";
			foreach ( $psstats_table['rows'] as $psstats_row ) {
				if ( ! empty( $psstats_row['section'] ) ) {
					echo '</tbody><thead><tr><th colspan="3" class="section">' . esc_html( $psstats_row['section'] ) . '</th></tr></thead><tbody>';
					continue;
				}
				$psstats_value = $psstats_row['value'];
				if ( true === $psstats_value ) {
					$psstats_value = esc_html__( 'Yes', 'psstats' );
				} elseif ( false === $psstats_value ) {
					$psstats_value = esc_html__( 'No', 'psstats' );
				}
				$psstats_class = '';
				if ( ! empty( $psstats_row['is_error'] ) ) {
					$psstats_class = 'error';
				} elseif ( ! empty( $psstats_row['is_warning'] ) ) {
					$psstats_class = 'warning';
				}
				echo "<tr class='" . esc_attr( $psstats_class ) . "'>";
				echo "<td width='30%'>" . esc_html( $psstats_row['name'] ) . '</td>';
				echo "<td width='" . ( ! empty( $psstats_table['has_comments'] ) ? 20 : 70 ) . "%'>" . esc_html( $psstats_value ) . '</td>';
				if ( ! empty( $psstats_table['has_comments'] ) ) {
					$psstats_replaced_elements = array(
						'<code>'  => '__#CODEBACKUP#__',
						'</code>' => '__##CODEBACKUP##__',
						'<pre style="overflow-x: scroll;max-width: 600px;">' => '__#PREBACKUP#__',
						'</pre>'  => '__##PREBACKUP##__',
						'<br/>'   => '__#BRBACKUP#__',
						'<br />'  => '__#BRBACKUP#__',
						'<br>'    => '__#BRBACKUP#__',
					);
					$psstats_comment           = isset( $psstats_row['comment'] ) ? $psstats_row['comment'] : '';
					$psstats_replaced          = str_replace( array_keys( $psstats_replaced_elements ), array_values( $psstats_replaced_elements ), $psstats_comment );
					$psstats_escaped           = esc_html( $psstats_replaced );
					echo "<td width='50%' class='psstats-systemreport-comment'>" . str_replace( array_values( $psstats_replaced_elements ), array_keys( $psstats_replaced_elements ), $psstats_escaped ) . '</td>';
				}

				echo '</tr>';
			}
			echo '</tbody></table>';
		}
		?>

	<?php } else { ?>
		<h1><?php esc_html_e( 'Fehlerbehebung', 'psstats' ); ?></h1>

		<form method="post">
			<?php wp_nonce_field( SystemReport::NONCE_NAME ); ?>

            <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_ARCHIVE_NOW ); ?>" type="submit"
                   class='button-primary'
                   title="<?php esc_attr_e( 'Wenn Berichte keine Daten anzeigen, obwohl sie sollten, kannst Du versuchen, zu sehen, ob die Berichterstellung funktioniert, wenn Du die Berichterstellung manuell auslöst.', 'psstats' ) ?>"
                   value="<?php esc_html_e( 'Berichte archivieren', 'psstats' ); ?>">
            <br/><br/>
            <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_CLEAR_PSSTATS_CACHE ); ?>" type="submit"
                   class='button-primary'
                   title="<?php esc_attr_e( 'Wird den Psstats-Cache zurücksetzen/leeren, was hilfreich sein kann, wenn etwas nicht wie erwartet funktioniert, zum Beispiel nach einem Update.', 'psstats' ) ?>"
                   value="<?php esc_html_e( 'Psstats-Cache leeren', 'psstats' ); ?>">
            <br/><br/>
			<?php if (!empty($psstats_has_exception_logs)) { ?>
                <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_CLEAR_LOGS ); ?>" type="submit"
                       class='button-primary'
                       title="<?php esc_attr_e( 'Entfernt alle gespeicherten Psstats-Protokolle, die im Systembericht angezeigt werden', 'psstats' ) ?>"
                       value="<?php esc_html_e( 'Systemberichtsprotokolle löschen', 'psstats' ); ?>">
                <br/><br/>
			<?php } ?>

            <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_UPDATE_GEOIP_DB ); ?>" type="submit"
                   class='button-primary'
                   title="<?php esc_attr_e( 'Aktualisiert die Geolocation-Datenbank, die verwendet wird, um den Standort (Stadt/Region/Land) von Besuchern zu erkennen. Diese Aufgabe wird automatisch ausgeführt. Wenn die Geolocation-DB nicht geladen oder aktualisiert wird, musst Du sie möglicherweise manuell auslösen, um den Fehler zu finden, der sie verursacht.', 'psstats' ) ?>"
                   value="<?php esc_html_e( 'Geo-IP-DB installieren/aktualisieren', 'psstats' ); ?>">
            <br/><br/>
            
			<?php if ( ! $settings->is_network_enabled() || ! is_network_admin() ) { ?>
                <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_SYNC_USERS ); ?>" type="submit" class='button-primary'
                       title="<?php esc_attr_e( 'Benutzer werden automatisch synchronisiert. Wenn ein Benutzer aus irgendeinem Grund nicht auf Psstats-Seiten zugreifen kann, obwohl der Benutzer die Berechtigung hat, kann das Auslösen einer manuellen Synchronisierung helfen, dieses Problem sofort zu beheben, oder es kann anzeigen, welcher Fehler die automatische Synchronisierung verhindert.', 'psstats' ) ?>"
                       value="<?php esc_html_e( 'Benutzer synchronisieren', 'psstats' ); ?>">
                <br/><br/>
                <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_SYNC_SITE ); ?>" type="submit" class='button-primary'
                       title="<?php esc_attr_e( 'Seiten/Blogs werden automatisch synchronisiert. Wenn Psstats aus irgendeinem Grund für einen bestimmten Blog nicht angezeigt wird, kann das Auslösen einer manuellen Synchronisierung helfen, dieses Problem sofort zu beheben, oder es kann anzeigen, welcher Fehler die automatische Synchronisierung verhindert.', 'psstats' ) ?>"
                       value="<?php esc_html_e( 'Webseite synchronisieren (Blog)', 'psstats' ); ?>">
                <br/><br/>
                <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_RUN_UPDATER ); ?>" type="submit" class='button-primary'
                       title="<?php esc_attr_e( 'Erzwinge das Auslösen eines Psstats-Updates, falls es fehlgeschlagen ist', 'psstats' ) ?>"
                       value="<?php esc_html_e( 'Updater ausführen', 'psstats' ); ?>">
			<?php } ?>
			<?php if ( $settings->is_network_enabled() ) { ?>
                <input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_SYNC_ALL_USERS ); ?>" type="submit"
                       class='button-primary'
                       title="<?php esc_attr_e( 'Benutzer werden automatisch synchronisiert. Wenn ein Benutzer aus irgendeinem Grund nicht auf Psstats-Seiten zugreifen kann, obwohl der Benutzer die Berechtigung hat, kann das Auslösen einer manuellen Synchronisierung helfen, dieses Problem sofort zu beheben, oder es kann anzeigen, welcher Fehler die automatische Synchronisierung verhindert.', 'psstats' ) ?>"
                       value="<?php esc_html_e( 'Alle Benutzer über Webseiten/Blogs hinweg synchronisieren', 'psstats' ); ?>">
                <br/><br/>
				<input name="<?php echo esc_attr( SystemReport::TROUBLESHOOT_SYNC_ALL_SITES ); ?>" type="submit"
                       title="<?php esc_attr_e( 'Seiten/Blogs werden automatisch synchronisiert. Wenn Psstats aus irgendeinem Grund für einen bestimmten Blog nicht angezeigt wird, kann das Auslösen einer manuellen Synchronisierung helfen, dieses Problem sofort zu beheben, oder es kann anzeigen, welcher Fehler die automatische Synchronisierung verhindert.', 'psstats' ) ?>"
					   class='button-primary'
					   value="<?php esc_html_e( 'Alle Webseiten (Blogs) synchronisieren', 'psstats' ); ?>">
			<?php } ?>
		</form>

		<?php
		$show_troubleshooting_link = false;
		include 'info_help.php';
		?>
		<h3><?php esc_html_e( 'Beliebte FAQs zur Fehlerbehebung', 'psstats' ); ?></h3>
		<ul class="psstats-list">
			<li><a href="https://n3rds.work/docs/ps-stats-problemloesungs-faqs/#psstats-zeigt-keine-statistiken-berichte-an" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'Psstats zeigt keine Statistiken/Berichte an, wie kann ich das beheben?', 'psstats' ); ?></a></li>
			<li><a href="https://n3rds.work/docs/ps-stats-problemloesungs-faqs/#psstats-admin-seite-nicht-oeffnen" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'Ich kann die Psstats-Berichterstellungs-, Admin- oder Tag Manager-Seite nicht öffnen. Wie behebe ich das Problem?', 'psstats' ); ?></a></li>
			<li><a href="https://n3rds.work/docs/ps-stats-problemloesungs-faqs/#problem-mit-plugin-debug-aktivieren" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'Ich habe ein Problem mit dem Plugin, wie kann ich Fehler beheben und den Debug-Modus aktivieren?', 'psstats' ); ?></a></li>
			<li><a href="https://n3rds.work/docs/ps-stats-problemloesungs-faqs/#alle-psstats-daten-loeschen" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'Wie lösche oder setze ich alle Psstats für WordPress-Daten manuell zurück?', 'psstats' ); ?></a></li>
			<li><a href="https://n3rds.work/docs/ps-stats-problemloesungs-faqs/" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'View all FAQs', 'psstats' ); ?></a></li>
		</ul>
		<?php include 'info_bug_report.php'; ?>
		<h4><?php esc_html_e( 'Bevor Du ein Problem erstellst', 'psstats' ); ?></h4>
		<p><?php esc_html_e( 'Wenn bei Ps Stats ein Problem auftritt, ist es immer eine gute Idee, zuerst Deine Webserver-Logs (wenn möglich) auf Fehler zu überprüfen.', 'psstats' ); ?>
			<br/>
			<?php echo sprintf( esc_html__( 'Vielleicht möchtest Du auch %1$s aktivieren.', 'psstats' ), '<a href="https://n3rds.work/docs/ps-stats-problemloesungs-faqs/#problem-mit-plugin-debug-aktivieren" target="_blank" rel="noreferrer noopener"><code>WP_DEBUG</code></a>' ); ?>
			<?php echo sprintf( esc_html__( 'Um im Hintergrund auftretende Probleme zu beheben, z. B. die Berichterstellung während eines Cronjobs, möchtest Du möglicherweise auch %1$s aktivieren.', 'psstats' ), '<code>WP_DEBUG_LOG</code>' ); ?>

		</p>
		<h3><?php esc_html_e( 'Hast Du Leistungsprobleme?', 'psstats' ); ?></h3>
		<p>
		<?php
		echo sprintf(
			esc_html__( 'Vielleicht möchtest Du %1$s in Deinem %2$s deaktivieren und einen tatsächlichen Cronjob einrichten und %3$schecke unsere empfohlene Servergröße%4$s.', 'psstats' ),
			'<code>DISABLE_WP_CRON</code>',
			'<code>wp-config.php</code>',
			'<a target="_blank" rel="noreferrer noopener" href="https://n3rds.work/docs/psstats-hard-software-anforderungen/">',
			'</a>'
		);
		?>
		</p>
		<?php include 'info_high_traffic.php'; ?>
	<?php } ?>
</div>
