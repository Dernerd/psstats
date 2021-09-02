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
?>
<div class="notice notice-info is-dismissible" id="psstats-referral">
    <p>
        <?php esc_html_e( 'Wie findest Du Psstats? Wir würden uns sehr freuen, wenn Du Dir 1 Minute Zeit nehmen würdest, um uns zu bewerten.', 'psstats' ); ?>

        <a href="https://n3rds.work/bewertungen" target="_blank" rel="noreferrer noopener"
           class="button psstats-dismiss-forever"><?php esc_html_e( 'Bewerte Psstats', 'psstats' ) ?></a>
    </p>
    <div style="clear:both;"></div>
</div>