<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
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
				'Du kannst uns auch helfen, indem Du %1$sspendest%2$s zur Finanzierung der
				Entwicklung der kostenlosen Psstats Analytics-Version.',
				'psstats'
			),
			'<a href="https://n3rds.work/spendenaktionen/unterstuetze-unsere-psource-free-werke/" target="_blank" rel="noreferrer noopener">',
			'</a>'
		);
		?>
        Jeder Cent wird helfen.
	</p>

	<h2><?php esc_html_e( 'Webseiten mit hohem Traffic', 'psstats' ); ?></h2>
	<?php require 'info_high_traffic.php'; ?>

	<?php require 'info_bug_report.php'; ?>

	<div class="psstats-footer">
		<ul>
			<li>
				<a target="_blank" rel="noreferrer noopener" href="https://n3rds.work/webmasterservice-n3rdswork-digalize-das-piestingtal/newsletter-management/"><span
						class="dashicons-before dashicons-email"></span></a>
				<a target="_blank" rel="noreferrer noopener"
				   href="https://n3rds.work/webmasterservice-n3rdswork-digalize-das-piestingtal/newsletter-management/"><?php esc_html_e( 'Newsletter', 'psstats' ); ?></a>
			</li>
			<li>
				<a target="_blank" rel="noreferrer noopener" href="https://github.com/Dernerd/psstats">GitHub</a>
			</li>
		</ul>
		<ul>
			<li><a target="_blank" rel="noreferrer noopener"
				   href="https://n3rds.work/blog/"><?php esc_html_e( 'Blog', 'psstats' ); ?></a></li>
		</ul>
	</div>
</div>
