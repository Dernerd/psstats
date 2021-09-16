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
<h2><?php esc_html_e( 'Wie können wir helfen?', 'psstats' ); ?></h2>

<form method="get" action="https://n3rds.work" target="_blank" rel="noreferrer noopener">
	<input type="text" name="s" style="width:300px;"><input type="submit" class="button-secondary"
															value="Suche auf N3rds@Work">
</form>
<ul class="psstats-list">
	<li><a target="_blank" rel="noreferrer noopener"
		   href="https://n3rds.work/docs/"><?php esc_html_e( 'Dokumentation', 'psstats' ); ?></a>
		- <?php esc_html_e( 'Erfahre wie Du Psstats konfigurieren und Deine Daten effektiv analysierst', 'psstats' ); ?>
	</li>
	<li><a target="_blank" rel="noreferrer noopener" href="https://n3rds.work/faq/wordpress/"><?php esc_html_e( 'Psstats for WordPress FAQs', 'psstats' ); ?></a>
		- <?php esc_html_e( 'Get answers to frequently asked questions', 'psstats' ); ?>
	</li>
	<li><a target="_blank" rel="noreferrer noopener" href="https://n3rds.work/faq/"><?php esc_html_e( 'General FAQs', 'psstats' ); ?></a>
		- <?php esc_html_e( 'Get answers to frequently asked questions', 'psstats' ); ?>
	</li>
	<li><a target="_blank" rel="noreferrer noopener"
		   href="https://forum.psstats.org/"><?php esc_html_e( 'Forums', 'psstats' ); ?></a>
		- <?php esc_html_e( 'Get help directly from the community of Psstats users', 'psstats' ); ?>
	</li>
	<li><a target="_blank" rel="noreferrer noopener"
		   href="https://glossary.psstats.org"><?php esc_html_e( 'Glossary', 'psstats' ); ?> </a>
		- <?php esc_html_e( 'Learn about commonly used terms to make the most of Psstats Analytics', 'psstats' ); ?>
	</li>
	<li><a target="_blank" rel="noreferrer noopener"
		   href="https://n3rds.work/support-plans/"><?php esc_html_e( 'Support Plans', 'psstats' ); ?></a>
		- <?php esc_html_e( 'Let our experienced team assist you online on how to best utilise Psstats', 'psstats' ); ?>
	</li>
	<?php if ( ! empty( $show_troubleshooting_link ) ) { ?>
	<li><a
		   href="<?php echo esc_url( add_query_arg( array( 'tab' => 'troubleshooting' ), menu_page_url( \WpPsstats\Admin\Menu::SLUG_SYSTEM_REPORT, false ) ) ); ?>"><?php esc_html_e( 'Troubleshooting', 'psstats' ); ?></a>
		- <?php esc_html_e( 'Click here if you are having Trouble with Psstats', 'psstats' ); ?>
	</li>
	<?php } ?>
</ul>
