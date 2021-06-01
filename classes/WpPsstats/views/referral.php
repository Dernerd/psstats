<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<div class="notice notice-info is-dismissible" id="psstats-referral">
    <p>
        <?php esc_html_e( 'Like Psstats? We would really appreciate if you took 1 minute to rate us.', 'psstats' ); ?>

        <a href="https://wordpress.org/support/plugin/psstats/reviews/?rate=5#new-post" target="_blank" rel="noreferrer noopener"
           class="button psstats-dismiss-forever"><?php esc_html_e( 'Rate Psstats', 'psstats' ) ?></a>
    </p>
    <div style="clear:both;"></div>
</div>