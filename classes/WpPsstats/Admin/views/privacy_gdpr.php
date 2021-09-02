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

<h2><?php esc_html_e( 'Psstats ensures the privacy of your users and analytics data! YOU keep control of your data.', 'psstats' ); ?></h2>

<blockquote
	class="psstats-blockquote"><?php esc_html_e( 'One of Psstats\'s guiding principles: respecting privacy', 'psstats' ); ?></blockquote>
<p>
	<?php esc_html_e( 'Psstats Analytics is privacy by design. All data collected is stored only within your own MySQL database, no other business (or Psstats team member) can access any of this information, and logs or report data will never be sent to other servers by Psstats', 'psstats' ); ?>
	.

	<?php
	echo sprintf(
		__( 'The source code of the software is open-source so hundreds of people have reviewed it to ensure it is %1$ssecure%2$s and keeps your data private.', 'psstats' ),
		'<a href="https://n3rds.work/security/" rel="noreferrer noopener">',
		'</a>'
	);
	?>
</p>
<?php if ($psstats_settings->is_network_enabled() && is_network_admin()) { ?>
    <h2>Configure privacy settings</h2>
    <p>
        Currently, privacy settings have to be configured on a per blog basis.
        IP addresses are anonmyised by default. Should you wish to change any privacy setting, please go to the Psstats privacy settings within each blog.
        We are hoping to improve this in the future.
    </p>
<?php } else { ?>

<h2>
	<?php esc_html_e( 'Ways Psstats protects the privacy of your users and customers', 'psstats' ); ?>
</h2>
<p><?php esc_html_e( 'Although Psstats Analytics is a web analytics software that has a purpose to track user activity on your website, we take privacy very seriously.', 'psstats' ); ?></p>
<p><?php esc_html_e( 'Privacy is a fundamental right so by using Psstats you can rest assured you have 100% control over that data and can protect your user\'s privacy as it\'s on your own server.', 'psstats' ); ?></p>

<ul class="psstats-list">
	<li>
		<a href="<?php echo Menu::get_psstats_goto_url( Menu::REPORTING_GOTO_ANONYMIZE_DATA ); ?>"><?php esc_html_e( 'Anonymise data and IP addresses', 'psstats' ); ?></a>
	</li>
	<li>
		<a href="<?php echo Menu::get_psstats_goto_url( Menu::REPORTING_GOTO_DATA_RETENTION ); ?>"><?php esc_html_e( 'Configure data retention', 'psstats' ); ?></a>
	</li>
	<li>
		<a href="<?php echo Menu::get_psstats_goto_url( Menu::REPORTING_GOTO_OPTOUT ); ?>"><?php esc_html_e( 'Psstats has an opt-out mechanism which lets users opt-out of web analytics tracking', 'psstats' ); ?></a>
		(<?php esc_html_e( 'see below for the shortcode', 'psstats' ); ?>)
	</li>
	<li>
		<a href="<?php echo Menu::get_psstats_goto_url( Menu::REPORTING_GOTO_ASK_CONSENT ); ?>"><?php esc_html_e( 'Asking for consent', 'psstats' ); ?></a>
	</li>
	<li>
		<a href="<?php echo Menu::get_psstats_goto_url( Menu::REPORTING_GOTO_GDPR_OVERVIEW ); ?>"><?php esc_html_e( 'GDPR overview', 'psstats' ); ?></a>
	</li>
	<li>
		<a href="<?php echo Menu::get_psstats_goto_url( Menu::REPORTING_GOTO_GDPR_TOOLS ); ?>"><?php esc_html_e( 'GDPR tools', 'psstats' ); ?></a>
	</li>
</ul>
<?php } ?>
<h2>
	<?php esc_html_e( 'Let users opt-out of tracking', 'psstats' ); ?>
</h2>
<p>
	<?php
	echo sprintf(
		__( 'Use the short code %1$s to embed the opt out iframe into your website.', 'psstats' ),
		'<code>' . esc_html( PrivacySettings::EXAMPLE_MINIMAL ) . '</code>'
	);
	?>
		<br/>
	<?php esc_html_e( 'You can use these short code options:', 'psstats' ); ?>
</p>
<ul class="psstats-list">
	<li>language - eg de or en. <?php esc_html_e( 'By default the language is detected automatically based on the user\'s browser', 'psstats' ); ?></li>
</ul>
<p><?php esc_html_e( 'Example', 'psstats' ); ?>: <code><?php echo esc_html( PrivacySettings::EXAMPLE_FULL ); ?></code></p>
