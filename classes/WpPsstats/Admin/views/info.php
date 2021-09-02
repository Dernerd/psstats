<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

use \WpPsstats\Admin\Menu;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="wrap">
	<div id="icon-plugins" class="icon32"></div>

	<?php require 'info_shared.php'; ?>
	<?php
	$show_troubleshooting_link = true;
	require 'info_help.php';
	?>

	<h2><?php esc_html_e( 'Support the project', 'psstats' ); ?></h2>
	<p>
	<?php
	echo sprintf(
		esc_html__(
			'Psstats is a collaborative project brought to you by %1$sPsstats team%2$s members as well as many other contributors around the globe. If you like Psstats,
        %3$splease give us a review%4$s and spread the word about us.',
			'psstats'
		),
		'<a target="_blank" rel="noreferrer noopener" href="https://n3rds.work/team/">',
		'</a>',
		'<a target="_blank" rel="noreferrer noopener" href="https://wordpress.org/support/plugin/psstats/reviews/?rate=5#new-post">',
		'<span class="dashicons-before dashicons-star-filled" style="color:gold;"></span><span class="dashicons-before dashicons-star-filled" style="color:gold;"></span><span class="dashicons-before dashicons-star-filled" style="color:gold;"></span><span class="dashicons-before dashicons-star-filled" style="color:gold;"></span><span class="dashicons-before dashicons-star-filled" style="color:gold;"></span></a>'
	);
	?>
		<br/><br/>
        Psstats will always cost you nothing to use, but that doesn't mean it costs us nothing to make.
        Psstats needs your continued support to grow and thrive.
        <?php
		echo sprintf(
			esc_html__(
				'You can also help us by %1$sdonating%2$s or by %3$spurchasing premium plugins%4$s which fund the
        development of the free Psstats Analytics version.',
				'psstats'
			),
			'<a href="' . Menu::get_psstats_goto_url( Menu::REPORTING_GOTO_ADMIN ) . '">',
			'</a>',
			'<a href="https://plugins.psstats.org/premium" target="_blank" rel="noreferrer noopener">',
			'</a>'
		);
		?>
        Every penny will help.
	</p>

	<?php require 'info_newsletter.php'; ?>

	<h2><?php esc_html_e( 'High traffic websites', 'psstats' ); ?></h2>
	<?php require 'info_high_traffic.php'; ?>

	<?php require 'info_bug_report.php'; ?>

	<div class="psstats-footer">
		<ul>
			<li>
				<a target="_blank" rel="noreferrer noopener" href="https://n3rds.work/newsletter/"><span
						class="dashicons-before dashicons-email"></span></a>
				<a target="_blank" rel="noreferrer noopener"
				   href="https://n3rds.work/newsletter/"><?php esc_html_e( 'Newsletter', 'psstats' ); ?></a>
			</li>
			<li>
				<a target="_blank" rel="noreferrer noopener" href="https://www.facebook.com/Psstats.org"><span
						class="dashicons-before dashicons-facebook"></span></a>
				<a target="_blank" rel="noreferrer noopener" href="https://www.facebook.com/Psstats.org">Facebook</a>
			</li>
			<li>
				<a target="_blank" rel="noreferrer noopener" href="https://twitter.com/psstats_org"><span
						class="dashicons-before dashicons-twitter"></span></a>
				<a target="_blank" rel="noreferrer noopener" href="https://twitter.com/psstats_org">Twitter</a>
			</li>
			<li>
				<a target="_blank" rel="noreferrer noopener" href="https://www.linkedin.com/groups/867857/">Linkedin</a>
			</li>
			<li>
				<a target="_blank" rel="noreferrer noopener" href="https://github.com/psstats-org/psstats">GitHub</a>
			</li>
		</ul>
		<ul>
			<li><a target="_blank" rel="noreferrer noopener"
				   href="https://n3rds.work/blog/"><?php esc_html_e( 'Blog', 'psstats' ); ?></a></li>
			<li><a target="_blank" rel="noreferrer noopener"
				   href="https://developer.psstats.org"><?php esc_html_e( 'Developers', 'psstats' ); ?></a></li>
			<li><a target="_blank" rel="noreferrer noopener"
				   href="https://plugins.psstats.org"><?php esc_html_e( 'Marketplace', 'psstats' ); ?></a></li>
			<li><a target="_blank" rel="noreferrer noopener"
				   href="https://n3rds.work/thank-you-all/"><?php esc_html_e( 'Credits', 'psstats' ); ?></a></li>
		</ul>
	</div>
</div>
