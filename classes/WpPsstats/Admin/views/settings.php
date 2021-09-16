<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

use WpPsstats\Admin\AdminSettings;
use WpPsstats\Admin\AdminSettingsInterface;
use WpPsstats\Admin\Menu;
use WpPsstats\Capabilities;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/** @var AdminSettingsInterface[] $setting_tabs */
/** @var AdminSettingsInterface $content_tab */
/** @var string $active_tab */
/** @var \WpPsstats\Settings $psstats_settings */
?>
<div class="wrap">
	<div id="icon-plugins" class="icon32"></div>
    <h1><?php psstats_header_icon(); ?> <?php esc_html_e( 'Einstellungen', 'psstats' ); ?></h1>
    <?php
        if ( $psstats_settings->is_network_enabled() && is_network_admin() ) {
            echo '<div class="notice notice-info is-dismissible"><br>Du führst Psstats im Netzwerkmodus aus. Dies bedeutet, dass die folgenden Einstellungen auf alle Blogs in Deinem Netzwerk angewendet werden.<br><br></div>';
        } elseif ($psstats_settings->is_network_enabled() && !is_network_admin()) {
            echo '<div class="notice notice-info is-dismissible"><br>';
            esc_html_e('Du führst Psstats im Netzwerkmodus aus.', 'psstats');
            echo ' ';
            echo 'Die folgenden Einstellungen gelten nicht für alle Blogs, sondern müssen für jeden Blog separat konfiguriert werden. Wir hoffen, dies in Zukunft verbessern zu können. Jede Einstellung innerhalb des Psstats-Administrators wird auch pro Blog konfiguriert. Nur Du als Psstats-Superuser kannst diese Einstellungen sehen.<br><br></div>';
        }
    ?>
	<h2 class="nav-tab-wrapper">
		<?php foreach ( $setting_tabs as $psstats_setting_slug => $psstats_setting_tab ) { ?>
			<a href="<?php echo AdminSettings::make_url( $psstats_setting_slug ); ?>"
			   class="nav-tab <?php echo $active_tab === $psstats_setting_slug ? 'nav-tab-active' : ''; ?>"
			><?php echo esc_html( $psstats_setting_tab->get_title() ); ?></a>
		<?php } ?>

		<?php
		if ( current_user_can( Capabilities::KEY_SUPERUSER )
				   && ! is_network_admin() ) {
			?>
			<a href="<?php echo Menu::get_psstats_goto_url( Menu::REPORTING_GOTO_ADMIN ); ?>" class="nav-tab"
			><?php esc_html_e( 'Psstats Admin', 'psstats' ); ?> <span class="dashicons-before dashicons-external"></span></a>

		<?php } ?>
	</h2>

	<?php echo $content_tab->show_settings(); ?>
</div>
