<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 * Code Based on
 * @author Andr&eacute; Br&auml;kling
 * https://github.com/braekling/WP-Psstats
 *
 */

use WpPsstats\Admin\AdvancedSettings;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/** @var bool $was_updated */
/** @var string $psstats_detected_ip */
/** @var array $psstats_client_headers */
?>

<?php
if ( $was_updated ) {
	include 'update_notice_clear_cache.php';
}
?>
<form method="post">
	<?php wp_nonce_field( AdvancedSettings::NONCE_NAME ); ?>

    <p><?php esc_html_e( 'Advanced settings', 'psstats' ); ?></p>
    <table class="psstats-tracking-form widefat">
        <tbody>
        <tr>
            <th width="20%" scope="row"><label for="psstats[proxy_client_header]"><?php esc_html_e( 'Proxy IP headers', 'psstats' ) ?>:</label>
            </th>
            <td>
				<?php
				echo '<span style="white-space: nowrap;display: inline-block;"><input type="radio" ' . ( empty($psstats_client_headers) ? 'checked="checked" ' : '' ) . ' value="REMOTE_ADDR" name="psstats[proxy_client_header]" /> <code>REMOTE_ADDR</code> ' . ( ! empty( $_SERVER[ 'REMOTE_ADDR' ] ) ? esc_html( $_SERVER[ 'REMOTE_ADDR' ] ) : esc_html__( 'No value found', 'psstats' ) ) . ' (' . esc_html__( 'Default', 'psstats' ) .')</span>';
				foreach ( AdvancedSettings::$valid_host_headers as $host_header ) {
					echo '<span style="white-space: nowrap;display: inline-block;"><input type="radio" ' . ( in_array( $host_header, $psstats_client_headers, true ) ? 'checked="checked" ' : '' ) . 'value="'. esc_attr($host_header).'" name="psstats[proxy_client_header]" /> <code>' . $host_header . '</code> ' . ( ! empty( $_SERVER[ $host_header ] ) ? ('<strong>'. esc_html( $_SERVER[ $host_header ] ) . '</strong>') : esc_html__( 'No value found', 'psstats' ) ) . ' &nbsp; </span>';
				}
				?>
            </td>
            <td width="50%">
	            <?php esc_html_e( 'We detected you have the following IP address:', 'psstats' ) ?>
	            <?php echo esc_html( $psstats_detected_ip ) ?> <br>
	            <?php echo sprintf(esc_html__( 'To compare this value with your actual IP address %1$splease click here%2$s.', 'psstats' ), '<a rel="noreferrer noopener" target="_blank" href="https://psstats.org/ip.php">', '</a>') ?><br><br>
                <?php esc_html_e( 'Should your IP address not match the above value, your WordPress might be behind a proxy and you may need to select a different HTTP header depending on which of the values on the left shows your correct IP address.', 'psstats' ) ?>
            </td>
        </tr>
        <?php if (!defined('PSSTATS_REMOVE_ALL_DATA')) { ?>
        <tr>
            <th width="20%" scope="row"><label for="psstats[delete_all_data]"><?php esc_html_e( 'Delete all data on uninstall', 'psstats' ) ?>:</label>
            </th>
            <td>
				<?php
				echo '<span style="white-space: nowrap;display: inline-block;"><input type="checkbox" ' . ( !empty($psstats_delete_all_data) ? 'checked="checked" ' : '' ) . ' value="1" name="psstats[delete_all_data]" /> '.esc_html__( 'Yes', 'psstats' ).'</span>';
				?>
            </td>
            <td width="50%">
	            By default, when you uninstall the Psstats plugin, all data is deleted and cannot be restored unless you have backups. When you disable this feature, the tracked data in the database will be kept. This can be useful to prevent accidental deletion of all your historical analytics data when you uninstall the plugin. <a href="https://psstats.org/faq/wordpress/how-do-i-delete-or-reset-the-psstats-for-wordpress-data-completely/" target="_blank" rel="noreferrer noopener">Learn more</a>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="3"><p class="submit"><input name="Submit" type="submit" class="button-primary"
                                                     value="<?php esc_attr_e( 'Save Changes', 'psstats' ) ?>"/></p></td>
        </tr>
        </tbody>
    </table>
</form>