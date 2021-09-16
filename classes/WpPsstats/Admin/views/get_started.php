<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

use WpPsstats\Admin\AdminSettings;
use WpPsstats\Admin\Menu;
use WpPsstats\Admin\TrackingSettings;
use WpPsstats\Admin\GetStarted;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/** @var \WpPsstats\Settings $settings */
/** @var bool $can_user_edit */
/** @var bool $was_updated */
/** @var bool $show_this_page */

if ( empty( $show_this_page ) ) {
	echo '<meta http-equiv="refresh" content="0;url=' . esc_attr( menu_page_url( Menu::SLUG_ABOUT, false ) ) . '" />';
}
?>

<div class="wrap">
	<div id="icon-plugins" class="icon32"></div>

	<h1><?php esc_html_e( 'Mache Dir ein vollständiges Bild von Deinen Besuchern', 'psstats' ); ?></h1>

	<?php
	if ( $was_updated ) {
		include 'update_notice_clear_cache.php';
	}
	?>

	<?php if ( $settings->is_tracking_enabled() ) { ?>
		<h2>1. <?php esc_html_e( 'Tracking ist aktiviert', 'psstats' ); ?> <span class="dashicons dashicons-yes" style="color: green;"></span></h2>
		<p><?php esc_html_e('Das Tracking sollte jetzt funktionieren und Du musst nichts weiter tun, um das Tracking einzurichten.') ?> <a href="<?php echo AdminSettings::make_url( AdminSettings::TAB_TRACKING ); ?>"><?php esc_html_e( 'Klicke hier, um den Tracking-Code optional nach Deinen Wünschen zu konfigurieren (nicht erforderlich).', 'psstats' ); ?></a></p>

	<?php } else { ?>
		<h2>1. <?php esc_html_e( 'Tracking aktivieren', 'psstats' ); ?></h2>

		<form
			method="post"><?php esc_html_e( 'Tracking ist derzeit deaktiviert', 'psstats' ); ?> <?php wp_nonce_field( GetStarted::NONCE_NAME ); ?>
			<input type="hidden" name="<?php echo GetStarted::FORM_NAME; ?>[track_mode]"
				   value="<?php echo esc_attr( TrackingSettings::TRACK_MODE_DEFAULT ); ?>">
			<input type="submit" class="button-primary" value="<?php esc_html_e( 'Tracking jetzt aktivieren', 'psstats' ); ?>">
		</form>
	<?php } ?>

	<h2>2. <?php esc_html_e( 'Aktualisiere Deine Datenschutzseite', 'psstats' ); ?></h2>

	<?php echo sprintf( esc_html__( 'Gib Deinen Benutzern die Möglichkeit, das Tracking zu deaktivieren, indem Du Deiner Datenschutzseite den Shortcode %1$s hinzufügst. Du kannst die Abmeldung %2$nach Deinen Wünschen anpassen – siehe Datenschutzeinstellungen%3$s.', 'psstats' ), '<code>[psstats_opt_out]</code>', '<a href="' . AdminSettings::make_url( AdminSettings::TAB_PRIVACY ) . '">', '</a>' ); ?>

	<?php esc_html_e( 'Möglicherweise musst Du auch erwähnen, dass Du Psstats Analytics auf Deiner Webseite verwendest.', 'psstats' ); ?>
	<?php echo sprintf(esc_html__( 'Durch %1$sDeaktivierung von Cookies in den Tracking-Einstellungen%2$s müssen Sie möglicherweise keine Cookie- oder Tracking-Zustimmung einholen, wenn die DSGVO oder ePrivacy auf Dich zutrifft %3$s(weitere Informationen)%4$s.', 'psstats' ), '<a href="'.AdminSettings::make_url( AdminSettings::TAB_TRACKING ).'" target="_blank" rel="noreferrer noopener">', '</a>', '<a href="https://n3rds.work/docs/ps-stats-datenschutzgrundlagen/" target="_blank" rel="noreferrer noopener">', '</a>'); ?>

	<h2>3. <?php esc_html_e( 'Fertig', 'psstats' ); ?></h2>
	<form method="post">
		<?php wp_nonce_field( GetStarted::NONCE_NAME ); ?>
		<input type="hidden" name="<?php echo esc_attr( GetStarted::FORM_NAME ); ?>[show_get_started_page]"
			   value="no">
		<input type="submit" class="button-primary" value="<?php esc_html_e( 'Diese Seite nicht mehr anzeigen', 'psstats' ); ?>">
	</form>
	<p>
		<br/>
	</p>

	<?php require 'info_shared.php'; ?>
	<?php
	$show_troubleshooting_link = false;
	require 'info_help.php'; ?>
</div>
