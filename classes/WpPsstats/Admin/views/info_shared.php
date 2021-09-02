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
?>
<h1><?php esc_html_e( 'Über', 'psstats' ); ?> <?php psstats_header_icon(true);  ?> </h1>

<p>
	<?php
	echo sprintf(
		__(
			'%1$sPS STATS%2$s ist eine einfache aber mächtige
    Analytics Platform für WordPress, basierend auf dem Quellcode von Matomo. Es ist unsere Mission, 
	Dir beim Wachstum Deines Unternehmens zu helfen und Dir gleichzeitig %3$volle Kontrolle über Deine Daten zu geben%4$s.
    Alle Daten werden nur in Deinem WordPress gespeichert. Du besitzt die Daten, niemand sonst.',
			'psstats'
		),
		'<a target="_blank" rel="noreferrer noopener" href="https://n3rds.work">',
		'</a>',
		'<strong>',
		'</strong>'
	);
	?>
</p>
<ul class="psstats-list">
	<li><?php esc_html_e( '100 % Dateneigentum, niemand sonst kann Deine Daten sehen', 'psstats' ); ?></li>
	<li><?php esc_html_e( 'Leistungsstarke Webanalyse für WordPress', 'psstats' ); ?></li>
	<li><?php esc_html_e( 'Hervorragender Schutz der Privatsphäre der Benutzer', 'psstats' ); ?></li>
	<li><?php esc_html_e( 'Keine Datenlimits oder Sampling überhaupt', 'psstats' ); ?></li>
	<li><?php esc_html_e( 'Einfache Installation und Konfigurationn', 'psstats' ); ?></li>
	<li><?php esc_html_e( 'Endlich verständliche Datenanalyse auf Deutsch', 'psstats' ); ?></li>
</ul>
