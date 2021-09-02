<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
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

    <p><?php esc_html_e( 'Erweiterte Einstellungen', 'psstats' ); ?></p>
    <table class="psstats-tracking-form widefat">
        <tbody>
        <tr>
            <th width="20%" scope="row"><label for="psstats[proxy_client_header]"><?php esc_html_e( 'Proxy-IP-Header', 'psstats' ) ?>:</label>
            </th>
            <td>
				<?php
				echo '<span style="white-space: nowrap;display: inline-block;"><input type="radio" ' . ( empty($psstats_client_headers) ? 'checked="checked" ' : '' ) . ' value="REMOTE_ADDR" name="psstats[proxy_client_header]" /> <code>REMOTE_ADDR</code> ' . ( ! empty( $_SERVER[ 'REMOTE_ADDR' ] ) ? esc_html( $_SERVER[ 'REMOTE_ADDR' ] ) : esc_html__( 'Kein Wert gefunden', 'psstats' ) ) . ' (' . esc_html__( 'Standard', 'psstats' ) .')</span>';
				foreach ( AdvancedSettings::$valid_host_headers as $host_header ) {
					echo '<span style="white-space: nowrap;display: inline-block;"><input type="radio" ' . ( in_array( $host_header, $psstats_client_headers, true ) ? 'checked="checked" ' : '' ) . 'value="'. esc_attr($host_header).'" name="psstats[proxy_client_header]" /> <code>' . $host_header . '</code> ' . ( ! empty( $_SERVER[ $host_header ] ) ? ('<strong>'. esc_html( $_SERVER[ $host_header ] ) . '</strong>') : esc_html__( 'Kein Wert gefunden', 'psstats' ) ) . ' &nbsp; </span>';
				}
				?>
            </td>
            <td width="50%">
	            <?php esc_html_e( 'Wir haben festgestellt, dass Du die folgende IP-Adresse hast:', 'psstats' ) ?>
	            <?php echo esc_html( $psstats_detected_ip ) ?> <br>
	            <?php echo sprintf(esc_html__( 'Um diesen Wert mit Deiner tatsächlichen IP-Adresse zu vergleichen, %1$sklicke bitte hier%2$s.', 'psstats' ), '<a rel="noreferrer noopener" target="_blank" href="https://n3rds.work/ip.php">', '</a>') ?><br><br>
                <?php esc_html_e( 'Sollte Deine IP-Adresse nicht mit dem obigen Wert übereinstimmen, befindet sich Dein WordPress möglicherweise hinter einem Proxy und Du musst möglicherweise einen anderen HTTP-Header auswählen, je nachdem, welcher der Werte auf der linken Seite Deine richtige IP-Adresse anzeigt.', 'psstats' ) ?>
            </td>
        </tr>
        <?php if (!defined('PSSTATS_REMOVE_ALL_DATA')) { ?>
        <tr>
            <th width="20%" scope="row"><label for="psstats[delete_all_data]"><?php esc_html_e( 'Alle Daten bei der Deinstallation löschen', 'psstats' ) ?>:</label>
            </th>
            <td>
				<?php
				echo '<span style="white-space: nowrap;display: inline-block;"><input type="checkbox" ' . ( !empty($psstats_delete_all_data) ? 'checked="checked" ' : '' ) . ' value="1" name="psstats[delete_all_data]" /> '.esc_html__( 'Ja', 'psstats' ).'</span>';
				?>
            </td>
            <td width="50%">
            Wenn Du das Psstats-Plugin deinstallierst, werden standardmäßig alle Daten gelöscht und können nur dann wiederhergestellt werden, wenn Du über Backups verfügst. Wenn Du diese Funktion deaktivierst, bleiben die verfolgten Daten in der Datenbank erhalten. Dies kann nützlich sein, um ein versehentliches Löschen aller Deiner historischen Analysedaten zu verhindern, wenn Du das Plugin deinstallierst. <a href="https://n3rds.work/faq/wordpress/how-do-i-delete-or-reset-the-psstats-for-wordpress-data-completely/" target="_blank" rel="noreferrer noopener">Mehr erfahren</a>
            </td>
        </tr>
        <?php } ?>
        <tr>
            <td colspan="3"><p class="submit"><input name="Submit" type="submit" class="button-primary"
                                                     value="<?php esc_attr_e( 'Änderungen speichern', 'psstats' ) ?>"/></p></td>
        </tr>
        </tbody>
    </table>
</form>