<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
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
    <h1><?php psstats_header_icon(); ?> <?php esc_html_e( 'Settings', 'psstats' ); ?></h1>
    <?php
        if ( $psstats_settings->is_network_enabled() && is_network_admin() ) {
            echo '<div class="notice notice-info is-dismissible"><br>You are running Psstats in network mode. This means below settings will be applied to all blogs in your network.<br><br></div>';
        } elseif ($psstats_settings->is_network_enabled() && !is_network_admin()) {
            echo '<div class="notice notice-info is-dismissible"><br>';
            esc_html_e('You are running Psstats in network mode.', 'psstats');
            echo ' ';
            echo 'Below settings aren\'t applied for all blogs but have to be configured for each blog separately. We are hoping to improve this in the future. Any setting within the Psstats admin is configured on a per blog basis as well. Only you as a Psstats super user can see these settings.<br><br></div>';
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
