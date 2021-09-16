<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 * Code Based on
 * @author Andr&eacute; Br&auml;kling
 * https://github.com/braekling/WP-Psstats
 *
 */

use WpPsstats\Admin\TrackingSettings;
use WpPsstats\Paths;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/** @var \WpPsstats\Settings $settings */
/** @var bool $was_updated */
/** @var array $psstats_default_tracking_code */
/** @var array $containers */
/** @var array $track_modes */
/** @var array $psstats_currencies */

$psstats_form  = new \WpPsstats\Admin\TrackingSettings\Forms( $settings );
$psstats_paths = new Paths();
?>

<?php
if ( $was_updated ) {
	include 'update_notice_clear_cache.php';
}
?>
<form method="post">
	<?php wp_nonce_field( TrackingSettings::NONCE_NAME ); ?>
	<p>
        <?php esc_html_e( 'Hier kannst Du optional das Tracking nach Deinen Wünschen konfigurieren (Du musst es nicht konfigurieren).', 'psstats' );?>
        <?php esc_html_e( 'Der konfigurierte Tracking-Code wird automatisch in Deine Webseite eingebettet und Du musst nichts tun, es sei denn, Du hast das Tracking deaktiviert.', 'psstats' );?>
        <?php esc_html_e( 'Wenn Du unten einen Tracking-Code siehst, musst Du diesen Tracking-Code nicht in Deine Webseite einbetten. Das Plugin erledigt dies automatisch für dich.', 'psstats' );?>
    </p>
	<table class="psstats-tracking-form widefat">
		<tbody>

		<?php
		// Tracking Configuration
		$psstats_is_not_tracking = $settings->get_global_option( 'track_mode' ) === TrackingSettings::TRACK_MODE_DISABLED;

		$psstats_is_not_generated_tracking     = $psstats_is_not_tracking || $settings->get_global_option( 'track_mode' ) === TrackingSettings::TRACK_MODE_MANUALLY;
		$psstats_full_generated_tracking_group = 'psstats-track-option psstats-track-option-default  ';

		$psstats_description = sprintf( '%s<br /><strong>%s:</strong> %s<br /><strong>%s:</strong> %s<br /><strong>%s:</strong> %s<br /><strong>%s:</strong> %s', esc_html__( 'Du kannst zwischen vier Tracking-Code-Modi wählen:', 'psstats' ), esc_html__( 'Deaktiviert', 'psstats' ), esc_html__( 'PS STATS fügt den Tracking-Code nicht hinzu. Verwende dies, wenn Du den Tracking-Code zu Deinen Vorlagendateien hinzufügen möchtest oder ein anderes Plugin verwendest, um den Tracking-Code hinzuzufügen.', 'psstats' ), esc_html__( 'Standard-Tracking', 'psstats' ), esc_html__( 'PS STATS verwendet den Standard-Tracking-Code von PS STATS.', 'psstats' ) . ' ' .esc_html__('Dieser Modus wird für die meisten Anwendungsfälle empfohlen.', 'psstats'), esc_html__( 'Manuell eintragen', 'psstats' ), esc_html__( 'Gib Deinen eigenen Tracking-Code manuell ein. Du kannst eine der vorherigen Optionen wählen, Deinen Tracking-Code vorkonfigurieren und endlich zur manuellen Bearbeitung wechseln.', 'psstats' ) . ( $settings->is_network_enabled() ? ' ' . esc_html__( 'Verwende den Platzhalter {ID}, um die PS STATS-Seiten-ID hinzuzufügen.', 'psstats' ) : '' ), esc_html__( 'Tag Manager', 'psstats' ), esc_html__( 'Wenn Du im Tag Manager Container erstellt hast, kannst Du einen davon auswählen und der Code für den Container wird automatisch eingebettet.', 'psstats' ) );
		$psstats_form->show_select( 'track_mode', esc_html__( 'Tracking-Code hinzufügen', 'psstats' ), $track_modes, $psstats_description, 'jQuery(\'tr.psstats-track-option\').addClass(\'hidden\'); jQuery(\'tr.psstats-track-option-\' + jQuery(\'#track_mode\').val()).removeClass(\'hidden\'); jQuery(\'#tracking_code, #noscript_code\').prop(\'readonly\', jQuery(\'#track_mode\').val() != \'manually\');' );

        $psstats_manually_network = '';
        if ( $settings->is_network_enabled() ) {
            $psstats_manually_network = ' ' . sprintf( esc_html__( 'Du kannst diese Variablen verwenden: %1$s. %2$sMehr erfahren%3$s', 'psstats' ), '{PSSTATS_IDSITE}, {PSSTATS_API_ENDPOINT}, {PSSTATS_JS_ENDPOINT}', '<a href="https://n3rds.work/faq/wordpress/how-can-i-configure-the-tracking-code-manually-when-i-have-wordpress-network-enabled-in-multisite-mode/" target="_blank" rel="noreferrer noopener">', '</a>' );
        }

		if ( ! empty( $containers ) ) {
			echo '<tr class="psstats-track-option psstats-track-option-tagmanager ' . ( $psstats_is_not_tracking ? ' hidden' : '' ) . '">';
			echo '<th scope="row"><label for="tagmanger_container_ids">' . esc_html__( 'Diese Tag Manager-Container hinzufügen', 'psstats' ) . '</label>:</th><td>';
			$selected_container_ids = $settings->get_global_option( 'tagmanger_container_ids' );
			foreach ( $containers as $container_id => $container_name ) {
				echo '<input type="checkbox" ' . ( isset( $selected_container_ids [ $container_id ] ) && $selected_container_ids [ $container_id ] ? 'checked="checked" ' : '' ) . 'value="1" name="psstats[tagmanger_container_ids][' . $container_id . ']" /> ID:' . esc_html( $container_id ) . ' Name: ' . esc_html( $container_name ) . ' &nbsp; <br />';
			}
			echo '<br /><br /><a href="' . menu_page_url( \WpPsstats\Admin\Menu::SLUG_TAGMANAGER, false ) . '" rel="noreferrer noopener" target="_blank">Container bearbeiten <span class="dashicons-before dashicons-external"></span></a>';
			echo '<br /><span class="dashicons dashicons-info-outline"></span> Damit Psstats nachverfolgt werden kann, musst Du dem Container ein PS STATS-Tag hinzufügen. Es wird sonst nicht automatisch verfolgt.';
			echo '</td></tr>';
		}

		$psstats_form->show_textarea( 'tracking_code', esc_html__( 'Tracking Code', 'psstats' ), 15, 'Dies ist eine Vorschau Deines aktuellen Tracking-Codes basierend auf Deiner Konfiguration unten. Du brauchst nichts damit zu tun und dies dient nur zu Deiner Information. Wenn Du Deinen Tracking-Code manuell eingibst, kannst Du ihn hier ändern. Der Tracking-Code ist ein Stück Code, das automatisch in Deine Webseite eingebettet wird und für das Tracking Deiner Besucher verantwortlich ist. Sieh Dir den Systembericht an, um eine Liste aller verfügbaren JS-Tracker- und Tracking-API-Endpunkte zu erhalten. Du musst diesen Tracking-Code nicht in Deine Webseite einbetten, unser Plugin erledigt dies automatisch.' . $psstats_manually_network, $psstats_is_not_tracking, 'psstats-track-option psstats-track-option-default psstats-track-option-tagmanager  psstats-track-option-manually', ! $settings->is_network_enabled(), '', ( $settings->get_global_option( 'track_mode' ) !== 'manually' ), false );


		$psstats_form->show_select( \WpPsstats\Settings::SITE_CURRENCY, esc_html__( 'Währung', 'psstats' ), $psstats_currencies, esc_html__('Wähle die Währung aus, die in Berichten verwendet wird. Die Währung wird verwendet, wenn Du einen E-Commerce-Shop hast oder die Funktion PS STATS-Ziele verwendest und einem Ziel einen Geldwert zuweist.', 'psstats'), '' );

		$psstats_form->show_headline(esc_html__('Tracking anpassen (optional)', 'psstats'), 'psstats-track-option psstats-track-option-default psstats-track-option-manually psstats-track-option-tagmanager');

		$psstats_form->show_checkbox( 'disable_cookies', esc_html__( 'Cookies deaktivieren', 'psstats' ), esc_html__( 'Deaktiviere alle Tracking-Cookies für einen Besucher.', 'psstats' ), $psstats_is_not_generated_tracking, $psstats_full_generated_tracking_group );

		$psstats_form->show_checkbox( 'track_ecommerce', esc_html__( 'E-Commerce aktivieren', 'psstats' ), esc_html__( 'PS Stats kann E-Commerce-Bestellungen, verlassene Warenkörbe und Produktansichten für WooCommerce, Easy Digital Analytics, MemberPress und mehr verfolgen. Durch das Deaktivieren dieser Funktion werden auch E-Commerce-Berichte aus der PS STATS-Benutzeroberfläche entfernt.', 'psstats' ), $psstats_is_not_tracking, $psstats_full_generated_tracking_group . ' psstats-track-option-manually psstats-track-option-tagmanager' );

		$psstats_form->show_checkbox( 'track_search', esc_html__( 'Seitensuche-Tracking', 'psstats' ), esc_html__( 'Verwende die erweiterte Seitensuche Analytics-Funktion von PS Stats.', 'psstats' ) . ' ' . sprintf( esc_html__( 'Siehe %1$sPS Stats-Dokumentation%2$s.', 'psstats' ), '<a href="https://n3rds.work/docs/ps-stats-seitensuche-tracking-und-berichte/" rel="noreferrer noopener" target="_BLANK">', '</a>' ), $psstats_is_not_tracking, $psstats_full_generated_tracking_group . ' psstats-track-option-manually psstats-track-option-tagmanager' );

		$psstats_form->show_checkbox( 'track_404', esc_html__( 'Track 404', 'psstats' ), esc_html__( 'PS Stats kann automatisch eine 404-Kategorie hinzufügen, um 404-Seitenbesuche zu verfolgen.', 'psstats' ) . ' ' . sprintf( esc_html__( 'Siehe %1$sPS Stats FAQ%2$s.', 'psstats' ), '<a href="https://n3rds.work/docs/ps-stats-faqs/#wie-verfolgt-man-404-seiten" rel="noreferrer noopener" target="_BLANK">', '</a>' ), $psstats_is_not_tracking, $psstats_full_generated_tracking_group . ' psstats-track-option-manually' );

		$psstats_form->show_checkbox( 'track_jserrors', esc_html__( 'Track JS Fehler', 'psstats' ), esc_html__( 'Aktiviere die Verfolgung von JavaScript-Fehlern, die auf Deiner Webseite als PS Stats-Ereignisse auftreten.', 'psstats' ) . ' ' . sprintf( esc_html__( 'Siehe %1$sPS Stats FAQ%2$s.', 'psstats' ), '<a href="https://n3rds.work/docs/ps-stats-faqs/#wie-aktiviere-ich-javascript-fehlerverfolgung" rel="noreferrer noopener" target="_BLANK">', '</a>' ), $psstats_is_not_tracking, $psstats_full_generated_tracking_group );

		echo '<tr class="' . $psstats_full_generated_tracking_group . ' psstats-track-option-manually' . ( $psstats_is_not_tracking ? ' hidden' : '' ) . '">';
		echo '<th scope="row"><label for="add_post_annotations">' . esc_html__( 'Anmerkung zu neuem Beitrag des Typs hinzufügen', 'psstats' ) . '</label>:</th><td>';
		$psstats_filter = $settings->get_global_option( 'add_post_annotations' );
		foreach ( get_post_types( array(), 'objects' ) as $post_type ) {
			echo '<input type="checkbox" ' . ( isset( $psstats_filter [ $post_type->name ] ) && $psstats_filter [ $post_type->name ] ? 'checked="checked" ' : '' ) . 'value="1" name="psstats[add_post_annotations][' . $post_type->name . ']" /> ' . $post_type->label . ' &nbsp; ';
		}
		echo '<span class="dashicons dashicons-editor-help" style="cursor: pointer;" onclick="jQuery(\'#add_post_annotations-desc\').toggleClass(\'hidden\');"></span> <p class="description hidden" id="add_post_annotations-desc">' . sprintf( esc_html__( 'Siehe %1$sPS Stats-Dokumentation%2$s.', 'psstats' ), '<a href="https://n3rds.work/docs/ps-stats-anmerkungen-zu-deinen-daten/" rel="noreferrer noopener" target="_BLANK">', '</a>' ) . '</p></td></tr>';

		$psstats_form->show_select(
			'track_content',
			__( 'Inhaltsverfolgung aktivieren', 'psstats' ),
			array(
				'disabled' => esc_html__( 'Deaktiviert', 'psstats' ),
				'all'      => esc_html__( 'Verfolge alle Inhaltsblöcke', 'psstats' ),
				'visible'  => esc_html__( 'Nur sichtbare Inhaltsblöcke verfolgen', 'psstats' ),
			),
			__( 'Mit der Inhaltsverfolgung kannst Du die Interaktion mit dem Inhalt einer Webseite oder Anwendung verfolgen.', 'psstats' ) . ' ' . sprintf( esc_html__( 'Siehe %1$sPS Stats Dokumentation%2$s.', 'psstats' ), '<a href="https://n3rds.work/docs/ps-stats-entwicklerhandbuch-inhaltsverfolgung/" rel="noreferrer noopener" target="_BLANK">', '</a>' ),
			'',
			$psstats_is_not_tracking,
			$psstats_full_generated_tracking_group
		);

		$psstats_form->show_input( 'add_download_extensions', esc_html__( 'Füge neue Dateitypen für das Download-Tracking hinzu', 'psstats' ), esc_html__( 'Füge Dateierweiterungen für das Download-Tracking hinzu, geteilt durch einen vertikalen Balken (&#124;).', 'psstats' ) . ' ' . sprintf( esc_html__( 'Siehe %1$sPS Stats Dokumentation%2$s.', 'psstats' ), '<a href="https://n3rds.work/docs/ps-stats-entwickler-javascript-tracking-client#tracking-outlinks-und-ignoriere-alias-domains" rel="noreferrer noopener" target="_BLANK">', '</a>' ), $psstats_is_not_generated_tracking, $psstats_full_generated_tracking_group );

		$psstats_form->show_checkbox( 'limit_cookies', esc_html__( 'Cookie-Lebensdauer begrenzen', 'psstats' ), esc_html__( 'Du kannst die Cookie-Lebensdauer begrenzen, um die Verfolgung Deiner Benutzer bei Bedarf über einen längeren Zeitraum zu vermeiden.', 'psstats' ), $psstats_is_not_generated_tracking, $psstats_full_generated_tracking_group, true, 'jQuery(\'tr.psstats-cookielifetime-option\').toggleClass(\'psstats-hidden\');' );

		$psstats_form->show_input( 'limit_cookies_visitor', esc_html__( 'Besucher-Timeout (Sekunden)', 'psstats' ), false, $psstats_is_not_generated_tracking || ! $settings->get_global_option( 'limit_cookies' ), $psstats_full_generated_tracking_group . ' psstats-cookielifetime-option' . ( $settings->get_global_option( 'limit_cookies' ) ? '' : ' psstats-hidden' ) );

		$psstats_form->show_input( 'limit_cookies_session', esc_html__( 'Sitzungs-Timeout (Sekunden)', 'psstats' ), false, $psstats_is_not_generated_tracking || ! $settings->get_global_option( 'limit_cookies' ), $psstats_full_generated_tracking_group . ' psstats-cookielifetime-option' . ( $settings->get_global_option( 'limit_cookies' ) ? '' : ' psstats-hidden' ) );

		$psstats_form->show_input( 'limit_cookies_referral', esc_html__( 'Referral-Timeout (Sekunden)', 'psstats' ), false, $psstats_is_not_generated_tracking || ! $settings->get_global_option( 'limit_cookies' ), $psstats_full_generated_tracking_group . ' psstats-cookielifetime-option' . ( $settings->get_global_option( 'limit_cookies' ) ? '' : ' psstats-hidden' ) );

		$psstats_form->show_checkbox( 'track_admin', esc_html__( 'Verfolge Admin-Seiten', 'psstats' ), esc_html__( 'Aktivieren, um Benutzer auf Admin-Seiten zu verfolgen (denke daran, den Tracking-Filter entsprechend zu konfigurieren).', 'psstats' ), $psstats_is_not_tracking, $psstats_full_generated_tracking_group . ' psstats-track-option-manually psstats-track-option-tagmanager' );

		$psstats_form->show_checkbox( 'track_across', esc_html__( 'Verfolge Subdomains auf derselben Webseite', 'psstats' ), esc_html__( 'Fügt *.-Präfix zur Cookie-Domain hinzu.', 'psstats' ) . ' ' . sprintf( esc_html__( 'Siehe %1$sPS Stats Dokumentation%2$s.', 'psstats' ), '<a href="https://n3rds.work/docs/ps-stats-entwickler-javascript-tracking-client#tracking-subdomains-in-the-same-website" rel="noreferrer noopener" target="_BLANK">', '</a>' ), $psstats_is_not_generated_tracking, $psstats_full_generated_tracking_group );

		$psstats_form->show_checkbox( 'track_across_alias', esc_html__( 'Subdomains nicht als Outlink zählen', 'psstats' ), esc_html__( 'Fügt *.-Präfix zur verfolgten Domain hinzu.', 'psstats' ) . ' ' . sprintf( esc_html__( 'Siehe %1$sPS Stats dokumentation%2$s.', 'psstats' ), '<a href="https://n3rds.work/docs/ps-stats-entwickler-javascript-tracking-client#outlink-tracking-exclusions" rel="noreferrer noopener" target="_BLANK">', '</a>' ), $psstats_is_not_generated_tracking, $psstats_full_generated_tracking_group );

		$psstats_form->show_checkbox( 'track_crossdomain_linking', esc_html__( 'Cross-Domain-Linking aktivieren', 'psstats' ), esc_html__( 'Wenn sie aktiviert ist, wird sichergestellt, dass dieselbe Besucher-ID für denselben Besucher in mehreren Domänen verwendet wird. Dies funktioniert nur, wenn diese Funktion aktiviert ist, da die Besucher-ID in einem Cookie gespeichert wird und standardmäßig auf der anderen Domain nicht gelesen werden kann. Wenn diese Funktion aktiviert ist, wird ein URL-Parameter "pk_vid" angehängt, der die Besucher-ID enthält, wenn ein Benutzer auf eine URL klickt, die zu einer Deiner Domains gehört. Damit diese Funktion funktioniert, musst Du auch in Deinen PS Stats-Webseiten-Einstellungen konfigurieren, welche Domains als lokal behandelt werden sollen.', 'psstats' ), $psstats_is_not_tracking, $psstats_full_generated_tracking_group );

		$psstats_form->show_checkbox( 'force_post', esc_html__( 'POST-Anfragen erzwingen', 'psstats' ), esc_html__( 'When enabled, Psstats will always use POST requests. This can be helpful should you experience for example HTTP 414 URI too long errors in your tracking code.', 'psstats' ), $psstats_is_not_tracking, $psstats_full_generated_tracking_group );

		$psstats_form->show_checkbox( 'track_feed', esc_html__( 'RSS-Feeds verfolgen', 'psstats' ), esc_html__( 'Aktiviere das Verfolgen von Beiträgen in Feeds über Tracking-Pixel.', 'psstats' ), $psstats_is_not_tracking, $psstats_full_generated_tracking_group . ' psstats-track-option-manually psstats-track-option-tagmanager' );

		$psstats_form->show_checkbox( 'track_feed_addcampaign', esc_html__( 'Verfolge RSS-Feed-Links als Kampagne', 'psstats' ), esc_html__( 'Dadurch werden die PS Stats-Kampagnenparameter zu den RSS-Feed-Links hinzugefügt.', 'psstats' ) . ' ' . sprintf( esc_html__( 'Siehe %1$sPS Stats Dokumentation%2$s.', 'psstats' ), '<a https://n3rds.work/docs/ps-stats-tracking-von-marketingkampagnen/" rel="noreferrer noopener" target="_BLANK">', '</a>' ), $psstats_is_not_tracking, $psstats_full_generated_tracking_group . ' psstats-track-option-manually psstats-track-option-tagmanager', true, 'jQuery(\'tr.psstats-feed_campaign-option\').toggle(\'hidden\');' );

		$psstats_form->show_input( 'track_feed_campaign', esc_html__( 'RSS-Feed-Kampagne', 'psstats' ), esc_html__( 'Schlagwort: Beitragsname.', 'psstats' ), $psstats_is_not_generated_tracking || ! $settings->get_global_option( 'track_feed_addcampaign' ), $psstats_full_generated_tracking_group . ' psstats-feed_campaign-option psstats-track-option-tagmanager' );

		$psstats_form->show_input( 'track_heartbeat', esc_html__( 'Heartbeat-Timer aktivieren', 'psstats' ), __( 'Aktiviere einen Heartbeat-Timer, um genauere Besuchszeiten zu erhalten, indem Du regelmäßige HTTP-Ping-Anfragen sendest, solange die Webseite geöffnet ist. Gib die Zeit zwischen den Pings in Sekunden (Psstats-Standard: 15) ein, um diese Funktion zu aktivieren, oder 0, um diese Funktion zu deaktivieren. <strong>Hinweis:</strong> Dies führt zu vielen zusätzlichen HTTP-Anfragen auf Deiner Website.', 'psstats' ), $psstats_is_not_generated_tracking, $psstats_full_generated_tracking_group );

		$psstats_form->show_select(
			'track_user_id',
			__( 'Benutzer-ID-Tracking', 'psstats' ),
			array(
				'disabled'    => esc_html__( 'Deaktiviert', 'psstats' ),
				'uid'         => esc_html__( 'WP-Benutzer-ID', 'psstats' ),
				'email'       => esc_html__( 'Email Addresse', 'psstats' ),
				'username'    => esc_html__( 'Benutzername', 'psstats' ),
				'displayname' => esc_html__( 'Anzeigename (nicht empfohlen!)', 'psstats' ),
			),
			__( 'Wenn ein Benutzer bei WordPress angemeldet ist, verfolge seine &quot;Benutzer-ID&quot;. Du kannst auswählen, welches Feld aus dem Benutzerprofil als "Benutzer-ID" verfolgt wird. Wenn aktiviert, wird Tracking basierend auf E-Mail-Adresse empfohlen.', 'psstats' ),
			'',
			$psstats_is_not_tracking,
			$psstats_full_generated_tracking_group . ' psstats-track-option-tagmanager'
		);

		$psstats_form->show_checkbox( 'track_datacfasync', esc_html__( 'data-cfasync=false hinzufügen', 'psstats' ), esc_html__( 'Fügt data-cfasync=false zum Skript-Tag hinzu, um z.B. Rocket Loader aufzufordern, das Skript zu ignorieren.', 'psstats' ) . ' ' . sprintf( esc_html__( 'Siehe %1$sCloudFlare Knowledge Base%2$s.', 'psstats' ), '<a href="https://support.cloudflare.com/hc/en-us/articles/200169436-How-can-I-have-Rocket-Loader-ignore-my-script-s-in-Automatic-Mode-" rel="noreferrer noopener" target="_BLANK">', '</a>' ), $psstats_is_not_tracking, $psstats_full_generated_tracking_group . '  psstats-track-option-tagmanager' );

		$psstats_submit_button = '<tr><td colspan="2"><p class="submit"><input name="Submit" type="submit" class="button-primary" value="' . esc_attr__( 'Änderungen speichern', 'psstats' ) . '" /></p></td></tr>';

		$psstats_form->show_input( 'set_download_extensions', esc_html__( 'Definiere alle Dateitypen für das Download-Tracking', 'psstats' ), esc_html__( 'Ersetze die standardmäßigen Dateierweiterungen von PS Stats für das Download-Tracking, geteilt durch einen vertikalen Balken (&#124;). Leer lassen, um die Standardeinstellungen von PS Stats beizubehalten.', 'psstats' ) . ' ' . sprintf( esc_html__( 'Siehe %1$sPS Stats Dokumentation%2$s.', 'psstats' ), '<a href="https://n3rds.work/docs/ps-stats-entwickler-javascript-tracking-client#download-and-outlink-tracking" target="_BLANK">', '</a>' ), $psstats_is_not_tracking, $psstats_full_generated_tracking_group );

		$psstats_form->show_input( 'set_download_classes', esc_html__( 'Lege fest, dass Klassen als Downloads behandelt werden', 'psstats' ), esc_html__( 'Lege Klassen fest, die als Downloads behandelt werden sollen (zusätzlich zu piwik_download), geteilt durch einen vertikalen Strich (&#124;). Leer lassen, um die Standardeinstellungen von PS Stats beizubehalten.', 'psstats' ) . ' ' . sprintf( esc_html__( 'Siehe %1$sPS Stats JavaScript-Tracking-Client-Referenz%2$s.', 'psstats' ), '<a href="https://n3rds.work/docs/ps-stats-entwickler-javascript-tracking-client" target="_BLANK">', '</a>' ), $psstats_is_not_tracking, $psstats_full_generated_tracking_group );

		$psstats_form->show_input( 'set_link_classes', esc_html__( 'Lege fest, dass Klassen als Outlinks behandelt werden', 'psstats' ), esc_html__( 'Lege Klassen fest, die als Outlinks behandelt werden sollen (zusätzlich zu piwik_link), geteilt durch einen vertikalen Strich (&#124;). Leer lassen, um die Standardeinstellungen von PS Stats beizubehalten.', 'psstats' ) . ' ' . sprintf( esc_html__( 'Siehe %1$sPS Stats JavaScript-Tracking-Client-Referenz%2$s.', 'psstats' ), '<a href="https://n3rds.work/docs/ps-stats-entwickler-javascript-tracking-client" target="_BLANK">', '</a>' ), $psstats_is_not_tracking, $psstats_full_generated_tracking_group );

		$psstats_form->show_textarea( 'noscript_code', esc_html__( 'Noscript Code', 'psstats' ), 2, 'Dies ist eine Vorschau Deines &lt;noscript&gt; Code, der Teil Deines Tracking-Codes ist. Wird nur angezeigt, wenn die Noscript-Funktion aktiviert ist.', $psstats_is_not_tracking, 'psstats-track-option psstats-track-option-default  psstats-track-option-manually', true, '', ( $settings->get_global_option( 'track_mode' ) !== 'manually' ), false );

		$psstats_form->show_checkbox( 'track_noscript', __( '&lt;noscript&gt; hinzufügen', 'psstats' ), __( 'Fügt den &lt;noscript&gt; Code in deine Fußzeile ein.', 'psstats' ) . ' Dies kann nützlich sein, wenn Du viele Besucher hast, bei denen JavaScript deaktiviert ist.', $psstats_is_not_tracking, 'psstats-track-option psstats-track-option-default  psstats-track-option-manually' );

		$psstats_form->show_select(
			'force_protocol',
			__( 'Zwinge PS Stats, ein bestimmtes Protokoll zu verwenden', 'psstats' ),
			array(
				'disabled' => esc_html__( 'Deaktiviert (Standard)', 'psstats' ),
				'https'    => esc_html__( 'https (SSL)', 'psstats' ),
			),
			__( 'Wähle aus, ob Du PS Stats explizit zwingen möchtest, HTTP oder HTTPS zu verwenden. Funktioniert nicht mit einer CDN-URL.', 'psstats' ),
			'',
			$psstats_is_not_tracking,
			$psstats_full_generated_tracking_group . ' psstats-track-option-tagmanager'
		);
		$psstats_form->show_select(
			'track_codeposition',
			__( 'JavaScript-Codeposition', 'psstats' ),
			array(
				'footer' => esc_html__( 'Footer', 'psstats' ),
				'header' => esc_html__( 'Header', 'psstats' ),
			),
			__( 'Wähle aus, ob der JavaScript-Code der Fußzeile oder der Kopfzeile hinzugefügt wird.', 'psstats' ),
			'',
			$psstats_is_not_tracking,
			'psstats-track-option psstats-track-option-default  psstats-track-option-tagmanager psstats-track-option-manually'
		);
		$psstats_form->show_select(
			'track_api_endpoint',
			__( 'Endpunkt für HTTP-Tracking-API', 'psstats' ),
			array(
				'default' => esc_html__( 'Standard', 'psstats' ),
				'restapi' => esc_html__( 'Über WordPress Rest API', 'psstats' ),
			),
			__( 'Standardmäßig zeigt die HTTP-Tracking-API auf Dein PS Stats-Plugin-Verzeichnis "' . esc_html( $psstats_paths->get_tracker_api_url_in_psstats_dir() ) . '". Du kannst stattdessen die WP Rest API (' . esc_html( $psstats_paths->get_tracker_api_rest_api_endpoint() ) . ') verwenden, um beispielsweise psstats.php auszublenden oder wenn die andere URL für Dich nicht funktioniert. Hinweis: Wenn der Tracking-Modus "Tag Manager" ausgewählt ist, gilt diese URL derzeit nur für das Feed-Tracking.', 'psstats' ),
			'',
			$psstats_is_not_tracking,
			$psstats_full_generated_tracking_group . ' psstats-track-option-manually psstats-track-option-tagmanager'
		);

		$psstats_form->show_select(
			'track_js_endpoint',
			__( 'Endpunkt für JavaScript-Tracker', 'psstats' ),
			array(
				'default' => esc_html__( 'Standard', 'psstats' ),
				'restapi' => esc_html__( 'Über WordPress Rest API (langsamer)', 'psstats' ),
				'plugin' => esc_html__( 'Plugin (eine alternative JS-Datei, wenn der Standard vom Webserver blockiert wird)', 'psstats' ),
			),
			__( 'Standardmäßig wird der JS-Tracking-Code von "' . esc_html( $psstats_paths->get_js_tracker_url_in_psstats_dir() ) . '" geladen. Du kannst die JS-Datei über die WP Rest API bereitstellen (' . esc_html( $psstats_paths->get_js_tracker_rest_api_endpoint() ) . '), um beispielsweise psstats.js auszublenden. Bitte beachte, dass dies bedeutet, dass jede Anfrage an die JavaScript-Datei WordPress PHP startet und daher langsamer ist als Dein Webserver, der die JS-Datei direkt bereitstellt.', 'psstats' ),
			'',
			$psstats_is_not_tracking,
			$psstats_full_generated_tracking_group
		);

		$psstats_form->show_headline(esc_html__('Für Entwickler', 'psstats'), 'psstats-track-option psstats-track-option-default psstats-track-option-disabled psstats-track-option-manually psstats-track-option-tagmanager');

		$psstats_form->show_select(
			'tracker_debug',
			__( 'Tracker-Debug-Modus', 'psstats' ),
			array(
				'disabled' => esc_html__( 'Deaktiviert (empfohlen)', 'psstats' ),
				'always'    => esc_html__( 'Immer aktiviert', 'psstats' ),
				'on_demand'    => esc_html__( 'Bei Bedarf aktiviert', 'psstats' ),
			),
			__( 'Aus Sicherheits- und Datenschutzgründen solltest Du diese Einstellung nur so kurz wie möglich aktivieren.', 'psstats' ),
			'',
			$psstats_is_not_tracking,
			$psstats_full_generated_tracking_group . ' psstats-track-option-disabled psstats-track-option-manually psstats-track-option-tagmanager'
		);

		echo $psstats_submit_button;
		?>

		</tbody>
	</table>
</form>

<?php if ( $psstats_is_not_tracking && ! $settings->is_network_enabled() ) { // Can't show it for multisite as idsite and url is always different. ?>
<div id="psstats_default_tracking_code">
	<h2><?php esc_html_e( 'JavaScript-Tracking-Code', 'psstats' ); ?></h2>
	<p>
		<?php echo sprintf( esc_html__( 'Möchtest Du den Tracking-Code manuell in Deine Webseite einbetten oder ein anderes Plugin verwenden? Kein Problem! Kopiere einfach den folgenden Tracking-Code und füge ihn ein. Möchtest Du es anpassen? %1$sSieh Dir unsere Entwicklerdokumentation an.%2$s', 'psstats' ), '<a href="https://n3rds.work/docs/ps-stats-entwickler-javascript-tracking-client" target="_blank" rel="noreferrer noopener">', '</a>' ); ?>
	</p>
	<?php echo '<pre><textarea>' . esc_html( implode( ";\n", explode( ';', $psstats_default_tracking_code['script'] ) ) ) . '</textarea></pre>'; ?>
	<h3><?php esc_html_e( 'NoScript-Tracking-Code', 'psstats' ); ?></h3>
	   <?php echo '<pre><textarea class="no_script">' . esc_html( $psstats_default_tracking_code['noscript'] ) . '</textarea></pre>'; ?>
</div>
<?php } ?>
