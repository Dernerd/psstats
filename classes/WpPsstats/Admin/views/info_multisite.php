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

/** @var \WpPsstats\Settings $settings */
?>

<div class="wrap">
	<div id="icon-plugins" class="icon32"></div>
	<h1><?php esc_html_e( 'Psstats Analytics in Multi Site mode', 'psstats' ); ?></h1>
	<?php require 'info_newsletter.php'; ?>
	<p><?php esc_html_e( 'You are seeing this page as you are viewing the network admin. Psstats differentiates between two different multi site modes:', 'psstats' ); ?></p>
	<h2><?php esc_html_e( 'Psstats is network enabled', 'psstats' ); ?></h2>
	<p><?php esc_html_e( 'In this mode, the tracking and access settings are managed in the network admin in one place and apply to all sites.', 'psstats' ); ?>
		<?php esc_html_e( 'An administrator of a site cannot view or change these settings.', 'psstats' ); ?>
		<br/><br/>
		<?php esc_html_e( 'The privacy settings have to be configured per site currently.', 'psstats' ); ?>
	</p>
	<h2><?php esc_html_e( 'Psstats is not network enabled', 'psstats' ); ?></h2>
	<p><?php esc_html_e( 'In this mode, the tracking and access settings are managed by each individual site. They cannot be managed in one central place for all sites. An administrator or any user with the "Psstats super user" role can change these settings.', 'psstats' ); ?>
	</p>
	<h2><?php esc_html_e( 'Managing many sites?', 'psstats' ); ?></h2>
	<p>
	<?php
	echo sprintf(
		__(
			'If you are managing quite a few sites or have quite a bit of traffic then we recommend installing %1$sPsstats On-Premise%2$s separately outside WordPress (it\'s free as well) and use it in combination with the %3$sWP-Psstats%4$s WordPress plugin.
        Your Psstats will then run a lot faster, you can put Psstats on a separate server if needed, and it allows you to make use of additional features such as %5$sRoll-Up Reporting%6$s.',
			'psstats'
		),
		'<a href="https://n3rds.work/psstats-on-premise/" target="_blank" rel="noreferrer noopener">',
		'</a>',
		'<a href="https://wordpress.org/plugins/wp-piwik/" target="_blank" rel="noreferrer noopener">',
		'</a>',
		'<a href="https://plugins.psstats.org/RollUpReporting" target="_blank" rel="noreferrer noopener">',
		'</a>'
	);
	?>

		<br/><br/><?php esc_html_e( 'Don\'t want all the hassle of maintaining a Psstats?', 'psstats' ); ?> <a
			href="http://psstats.org/start-free-analytics-trial/" rel="noreferrer noopener"
			target="_blank"><?php esc_html_e( 'Sign up for a free Psstats Cloud trial', 'psstats' ); ?></a>. <?php esc_html_e( 'We can migrate all your data onto our Cloud for free. 100% data ownership guaranteed.', 'psstats' ); ?>
	</p>

	<h2><?php esc_html_e( 'Psstats sites', 'psstats' ); ?></h2>
	<ul class="psstats-list">
		<?php
		if ( function_exists( 'get_sites' ) ) {
			foreach ( get_sites() as $psstats_site ) {
				/** @var WP_Site $psstats_site */
				switch_to_blog( $psstats_site->blog_id );
				if (function_exists('is_plugin_active') && is_plugin_active('psstats/psstats.php')) {
					echo '<li><a href="' . esc_url(admin_url( 'admin.php?page=psstats-reporting' )) . '">' . esc_html($psstats_site->blogname) . ' (Site ID: ' . esc_html($psstats_site->blog_id) . ')</a></li>';
				}
				restore_current_blog();
			}
		}
		?>
	</ul>
</div>
