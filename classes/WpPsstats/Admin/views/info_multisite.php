<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** @var \WpPsstats\Settings $settings */
?>

<div class="wrap">
	<div id="icon-plugins" class="icon32"></div>
	<h1><?php esc_html_e( 'PS STATS Analytics im Multi-Site-Modus', 'psstats' ); ?></h1>
	<p><?php esc_html_e( 'Du siehst diese Seite, während Du den Netzwerkadministrator anzeigst. PS STATS unterscheidet zwischen zwei verschiedenen Multi-Site-Modi:', 'psstats' ); ?></p>
	<h2><?php esc_html_e( 'PS STATS ist Netzwerkweit aktiviert', 'psstats' ); ?></h2>
	<p><?php esc_html_e( 'In diesem Modus werden die Tracking- und Zugriffseinstellungen im Netzwerkadministrator an einem Ort verwaltet und gelten für alle Webseiten.', 'psstats' ); ?>
		<?php esc_html_e( 'Ein Administrator einer Webseite kann diese Einstellungen nicht anzeigen oder ändern.', 'psstats' ); ?>
		<br/><br/>
		<?php esc_html_e( 'Die Datenschutzeinstellungen müssen derzeit pro Webseite konfiguriert werden.', 'psstats' ); ?>
	</p>
	<h2><?php esc_html_e( 'PS STATS ist nicht Netzwerkweit aktiviert', 'psstats' ); ?></h2>
	<p><?php esc_html_e( 'In diesem Modus werden die Tracking- und Zugriffseinstellungen von jeder einzelnen Webseite verwaltet. Sie können nicht an einem zentralen Ort für alle Standorte verwaltet werden. Ein Administrator oder jeder Benutzer mit der Rolle "PS STATS-Superuser" kann diese Einstellungen ändern.', 'psstats' ); ?>
	</p>

	<h2><?php esc_html_e( 'PS STATS Webseiten', 'psstats' ); ?></h2>
	<ul class="psstats-list">
		<?php
		if ( function_exists( 'get_sites' ) ) {
			foreach ( get_sites() as $psstats_site ) {
				/** @var WP_Site $psstats_site */
				switch_to_blog( $psstats_site->blog_id );
				if (function_exists('is_plugin_active') && is_plugin_active('psstats/psstats.php')) {
					echo '<li><a href="' . esc_url(admin_url( 'admin.php?page=psstats-reporting' )) . '">' . esc_html($psstats_site->blogname) . ' (Webseiten ID: ' . esc_html($psstats_site->blog_id) . ')</a></li>';
				}
				restore_current_blog();
			}
		}
		?>
	</ul>
</div>
