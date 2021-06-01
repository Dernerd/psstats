<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
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

	<h1><?php esc_html_e( 'Start getting a full picture of your visitors', 'psstats' ); ?></h1>

	<?php
	if ( $was_updated ) {
		include 'update_notice_clear_cache.php';
	}
	?>

	<?php if ( $settings->is_tracking_enabled() ) { ?>
		<h2>1. <?php esc_html_e( 'Tracking is enabled', 'psstats' ); ?> <span class="dashicons dashicons-yes" style="color: green;"></span></h2>
		<p><?php esc_html_e('Tracking should be working now and you don\'t have to do anything else to set up tracking.') ?> <a href="<?php echo AdminSettings::make_url( AdminSettings::TAB_TRACKING ); ?>"><?php esc_html_e( 'Click here to optionally configure the tracking code to your liking (not required).', 'psstats' ); ?></a></p>

	<?php } else { ?>
		<h2>1. <?php esc_html_e( 'Enable tracking', 'psstats' ); ?></h2>

		<form
			method="post"><?php esc_html_e( 'Tracking is currently disabled', 'psstats' ); ?> <?php wp_nonce_field( GetStarted::NONCE_NAME ); ?>
			<input type="hidden" name="<?php echo GetStarted::FORM_NAME; ?>[track_mode]"
				   value="<?php echo esc_attr( TrackingSettings::TRACK_MODE_DEFAULT ); ?>">
			<input type="submit" class="button-primary" value="<?php esc_html_e( 'Enable tracking now', 'psstats' ); ?>">
		</form>
	<?php } ?>

	<h2>2. <?php esc_html_e( 'Update your privacy page', 'psstats' ); ?></h2>

	<?php echo sprintf( esc_html__( 'Give your users the chance to opt-out of tracking by adding the shortcode %1$s to your privacy page. You can %2$stweak the opt-out to your liking - see the Privacy Settings%3$s.', 'psstats' ), '<code>[psstats_opt_out]</code>', '<a href="' . AdminSettings::make_url( AdminSettings::TAB_PRIVACY ) . '">', '</a>' ); ?>

	<?php esc_html_e( 'You may also need to mention that you are using Psstats Analytics on your website.', 'psstats' ); ?>
	<?php echo sprintf(esc_html__( 'By %1$sdisabling cookies in the tracking settings%2$s, you might not need to ask for any cookie or tracking consent if the GDPR or ePrivacy applies to you %3$s(learn more)%4$s.', 'psstats' ), '<a href="'.AdminSettings::make_url( AdminSettings::TAB_TRACKING ).'" target="_blank" rel="noreferrer noopener">', '</a>', '<a href="https://psstats.org/faq/new-to-piwik/how-do-i-use-psstats-analytics-without-consent-or-cookie-banner/" target="_blank" rel="noreferrer noopener">', '</a>'); ?>

	<h2>3. <?php esc_html_e( 'Done', 'psstats' ); ?></h2>
	<form method="post">
		<?php wp_nonce_field( GetStarted::NONCE_NAME ); ?>
		<input type="hidden" name="<?php echo esc_attr( GetStarted::FORM_NAME ); ?>[show_get_started_page]"
			   value="no">
		<input type="submit" class="button-primary" value="<?php esc_html_e( 'Don\'t show this page anymore', 'psstats' ); ?>">
	</form>
	<p>
		<br/>
	</p>

	<?php require 'info_shared.php'; ?>
	<?php
	$show_troubleshooting_link = false;
	require 'info_help.php'; ?>
</div>