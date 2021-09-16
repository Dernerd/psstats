<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}
?>
<h2><?php esc_html_e( 'Do you have a bug to report or a feature request?', 'psstats' ); ?></h2>
<p>
<?php
echo sprintf(
	esc_html__( 'Please read the recommendations on writing a good %1$sbug report%2$s or %3$sfeature request%4$s. Then register or login to %5$sour issue tracker%6$s and create a %7$snew issue%8$s.', 'psstats' ),
	'<a target="_blank" rel="noreferrer noopener" href="https://developer.psstats.org/guides/core-team-workflow#submitting-a-bug-report">',
	'</a>',
	'<a target="_blank" rel="noreferrer noopener" href="https://developer.psstats.org/guides/core-team-workflow#submitting-a-feature-request">',
	'</a>',
	'<a target="_blank" rel="noreferrer noopener" href="https://github.com/psstats-org/wp-psstats/issues">',
	'</a>',
	'<a target="_blank" rel="noreferrer noopener" href="https://github.com/psstats-org/wp-psstats/issues/new">',
	'</a>'
);
?>
		</p>
