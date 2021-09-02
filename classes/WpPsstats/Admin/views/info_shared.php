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
<h1><?php esc_html_e( 'About', 'psstats' ); ?> <?php psstats_header_icon(true);  ?> </h1>

<p>
	<?php
	echo sprintf(
		__(
			'%1$sPsstats Analytics%2$s is the most powerful
    analytics platform for WordPress, designed for your success. It is our mission to help you grow
    your business while giving you %3$sfull control over your data%4$s. All
    data is stored in your WordPress. You own the data, nobody else.',
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
	<li><?php esc_html_e( '100% data ownership, no one else can see your data', 'psstats' ); ?></li>
	<li><?php esc_html_e( 'Powerful web analytics for WordPress', 'psstats' ); ?></li>
	<li><?php esc_html_e( 'Superb user privacy protection', 'psstats' ); ?></li>
	<li><?php esc_html_e( 'No data limits or sampling whatsoever', 'psstats' ); ?></li>
	<li><?php esc_html_e( 'Easy installation and configuration', 'psstats' ); ?></li>
</ul>
