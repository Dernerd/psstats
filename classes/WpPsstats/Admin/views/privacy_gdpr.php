<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 * https://github.com/braekling/psstats
 *
 */

use WpPsstats\Admin\Menu;
use WpPsstats\Admin\PrivacySettings;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/** @var \WpPsstats\Settings $psstats_settings */

?>

<h2><?php esc_html_e( 'PS STATS gewährleistet die Privatsphäre Deiner Benutzer und Analysedaten! DU behältst die Kontrolle über Deine Daten.', 'psstats' ); ?></h2>

<blockquote
	class="psstats-blockquote"><?php esc_html_e( 'Eines der Leitprinzipien von PS STATS: Respektieren der Privatsphäre', 'psstats' ); ?></blockquote>
<p>
	<?php esc_html_e( 'PS STATS Analytics ist Datenschutz durch Design. Alle gesammelten Daten werden nur in Deiner eigenen MySQL-Datenbank gespeichert, kein anderes Unternehmen (oder PS STATS-Teammitglied) kann auf diese Informationen zugreifen und Protokolle oder Berichtsdaten werden von PS STATS niemals an andere Server gesendet', 'psstats' ); ?>
	.

	<?php
	echo sprintf(
		__( 'Der Quellcode der Software ist Open Source, daher haben Hunderte von Personen ihn überprüft, um sicherzustellen, dass er %1$ssicher%2$s ist und Deine Daten privat bleiben.', 'psstats' ),
		'<a href="https://n3rds.work/security/" rel="noreferrer noopener">',
		'</a>'
	);
	?>
</p>
<?php if ($psstats_settings->is_network_enabled() && is_network_admin()) { ?>
    <h2>Datenschutzeinstellungen konfigurieren</h2>
    <p>
		Derzeit müssen die Datenschutzeinstellungen pro Blog konfiguriert werden.
        IP-Adressen werden standardmäßig anonymisiert. Wenn Du Datenschutzeinstellungen ändern möchtest, gehe bitte zu den Datenschutzeinstellungen von PS STATS in jedem Blog.
        Wir hoffen, dies in Zukunft verbessern zu können.
    </p>
<?php } else { ?>

<h2>
	<?php esc_html_e( 'So schützt PS STATS die Privatsphäre Deiner Benutzer und Kunden', 'psstats' ); ?>
</h2>
<p><?php esc_html_e( 'Obwohl PS STATS Analytics eine Webanalysesoftware ist, die den Zweck hat, die Benutzeraktivität auf Deiner Website zu verfolgen, nehmen wir den Datenschutz sehr ernst.', 'psstats' ); ?></p>
<p><?php esc_html_e( 'Datenschutz ist ein Grundrecht. Wenn Du also PS STATS verwendest, kannst Du sicher sein, dass Du 100% Kontrolle über diese Daten hast und die Privatsphäre Deiner Benutzer schützen kannst, da sie sich auf Deinem eigenen Server befinden.', 'psstats' ); ?></p>

<ul class="psstats-list">
	<li>
		<a href="<?php echo Menu::get_psstats_goto_url( Menu::REPORTING_GOTO_ANONYMIZE_DATA ); ?>"><?php esc_html_e( 'Daten und IP-Adressen anonymisieren', 'psstats' ); ?></a>
	</li>
	<li>
		<a href="<?php echo Menu::get_psstats_goto_url( Menu::REPORTING_GOTO_DATA_RETENTION ); ?>"><?php esc_html_e( 'Datenaufbewahrung konfigurieren', 'psstats' ); ?></a>
	</li>
	<li>
		<a href="<?php echo Menu::get_psstats_goto_url( Menu::REPORTING_GOTO_OPTOUT ); ?>"><?php esc_html_e( 'PS STATS verfügt über einen Opt-out-Mechanismus, mit dem Benutzer sich vom Webanalyse-Tracking abmelden können', 'psstats' ); ?></a>
		(<?php esc_html_e( 'see below for the shortcode', 'psstats' ); ?>)
	</li>
	<li>
		<a href="<?php echo Menu::get_psstats_goto_url( Menu::REPORTING_GOTO_ASK_CONSENT ); ?>"><?php esc_html_e( 'Einverständnis einholen', 'psstats' ); ?></a>
	</li>
	<li>
		<a href="<?php echo Menu::get_psstats_goto_url( Menu::REPORTING_GOTO_GDPR_OVERVIEW ); ?>"><?php esc_html_e( 'DSGVO-Übersicht', 'psstats' ); ?></a>
	</li>
	<li>
		<a href="<?php echo Menu::get_psstats_goto_url( Menu::REPORTING_GOTO_GDPR_TOOLS ); ?>"><?php esc_html_e( 'DSGVO-Tools', 'psstats' ); ?></a>
	</li>
</ul>
<?php } ?>
<h2>
	<?php esc_html_e( 'Benutzern erlauben, das Tracking abzulehnen', 'psstats' ); ?>
</h2>
<p>
	<?php
	echo sprintf(
		__( 'Verwende den Shortcode %1$s, um den Deaktivierungs-Iframe in Deine Webseite einzubetten.', 'psstats' ),
		'<code>' . esc_html( PrivacySettings::EXAMPLE_MINIMAL ) . '</code>'
	);
	?>
		<br/>
	<?php esc_html_e( 'Du kannst diese Shortcode-Optionen verwenden:', 'psstats' ); ?>
</p>
<ul class="psstats-list">
	<li>language - eg de or en. <?php esc_html_e( 'Standardmäßig wird die Sprache basierend auf dem Browser des Benutzers automatisch erkannt', 'psstats' ); ?></li>
</ul>
<p><?php esc_html_e( 'Beispiel', 'psstats' ); ?>: <code><?php echo esc_html( PrivacySettings::EXAMPLE_FULL ); ?></code></p>
