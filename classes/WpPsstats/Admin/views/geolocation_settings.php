<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 * Code Based on
 * @author Andr&eacute; Br&auml;kling
 * @package WP_Psstats
 * https://github.com/braekling/psstats
 *
 */

use WpPsstats\Admin\GeolocationSettings;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/** @var bool $was_updated */
/** @var bool $invalid_format */
/** @var string $current_maxmind_license */

if ($invalid_format) { ?>
    <div class="updated notice error">
        <p><?php esc_html_e( 'Es sieht so aus, als ob der MaxMind-Lizenzschlüssel ein falsches Format hat.', 'psstats' ); ?></p>
    </div>
<?php
}
?>

<form method="post">
	<?php wp_nonce_field( GeolocationSettings::NONCE_NAME ); ?>

	<p>
        <?php esc_html_e( 'Auf dieser Seite kannst Du konfigurieren, wie Psstats die Standorte Deiner Besucher erkennt.', 'psstats' ); ?>
    </p>
    <p>
        <?php esc_html_e('To detect the location of a visitor, the IP address of a visitor is looked up in a so called geolocation database. This is automatically taken care of for you. However, the freely available database DB-IP we are using is sometimes less accurate than other freely available geolocation databases. This applies to the free and paid version of DB-IP. An alternative geolocation database is called MaxMind which has a free and a paid version as well. Because of GDPR we cannot configure this database automatically for you.', 'psstats'); ?>
        <br><br>
	    <?php
	    echo sprintf(
		    __( 'To use MaxMind instead of the default DB-IP geolocation database %1$s get a MaxMind license key%2$s and then configure this key below.', 'psstats' ),
		    '<a target="_blank" rel="noreferrer noopener" href="https://psstats.org/faq/how-to/how-do-i-get-a-license-key-for-the-maxmind-geolocation-database/">', '</a>'
	    );
	    ?>
    </p>

	<table class="psstats-tracking-form widefat">
		<tbody>
		<tr>
			<th  scope="row" style="vertical-align: top;">
                <label for="<?php echo esc_attr( GeolocationSettings::FORM_NAME ) ?>"><?php esc_html_e( 'MaxMind License Key', 'psstats' ); ?></label>:
			</th>
			<td>
				<input size="20" type="text" maxlength="20"
                       id="<?php echo esc_attr( GeolocationSettings::FORM_NAME ) ?>"
                       name="<?php echo esc_attr( GeolocationSettings::FORM_NAME ) ?>" value="<?php echo esc_attr($current_maxmind_license) ?>">
			</td>
            <td>
                <?php if (!empty($current_maxmind_license)) {?>
                    <p style="color: green;"><span class="dashicons dashicons-yes" ></span> <?php esc_html_e('MaxMind is configured.', 'psstats') ?></p>
                <?php }?>
                <p>
                    <?php esc_html_e('Leave the field empty and click on "Save Changes" to configure the default DB-IP database.', 'psstats') ?>
                    <?php esc_html_e('When configured, your WordPress will send an HTTP request to a MaxMind server to download an approx. 60MB database and store it in your "wp-content/uploads/psstats" directory.', 'psstats') ?>
                </p>
            </td>
		</tr>
		<tr>
			<td colspan="3">
				<p class="submit"><input name="Submit" type="submit" class="button-primary"
										 value="<?php echo esc_attr__( 'Save Changes', 'psstats' ); ?>"/></p>
			</td>
		</tr>

		</tbody>
	</table>
</form>
