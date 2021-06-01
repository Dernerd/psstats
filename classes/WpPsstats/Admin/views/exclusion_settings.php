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

use Piwik\Piwik;
use WpPsstats\Admin\ExclusionSettings;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/** @var bool $was_updated */
/** @var bool $exclude_visits_cookie */
/** @var string $current_ip */
/** @var string $excluded_ips */
/** @var string $excluded_user_agents */
/** @var string $excluded_query_params */
/** @var bool|string|int $keep_url_fragments */
/** @var \WpPsstats\Settings $settings */

?>

<?php
if ( $was_updated ) {
	include 'update_notice_clear_cache.php';
}
?>
<?php if ($settings->is_network_enabled() && is_network_admin()) { ?>
    <h2>Exclusion settings</h2>
    <p>
        Exclusion settings have to be configured on a per blog basis.
        Should you wish to change any setting, please go to the Psstats exclusion settings within each blog.
        We are hoping to improve this in the future.
    </p>
<?php } else { ?>

<form method="post">
	<?php wp_nonce_field( ExclusionSettings::NONCE_NAME ); ?>

	<p><?php esc_html_e( 'Configure exclusions.', 'psstats' ); ?></p>
	<table class="psstats-tracking-form widefat">
		<tbody>

		<tr>
			<th width="20%" scope="row"><label><?php esc_html_e( 'Tracking filter', 'psstats' ); ?></label>:
			</th>
			<td>
				<?php
				$psstats_tracking_caps = \WpPsstats\Settings::OPTION_KEY_STEALTH;
				$psstats_filter        = $settings->get_global_option( $psstats_tracking_caps );
				foreach ( $wp_roles->role_names as $psstats_key => $psstats_name ) {
					echo '<input type="checkbox" ' . ( isset( $psstats_filter [ $psstats_key ] ) && $psstats_filter [ $psstats_key ] ? 'checked="checked" ' : '' ) . 'value="1" name="' . esc_attr( ExclusionSettings::FORM_NAME ) . '[' . esc_attr( $psstats_tracking_caps ) . '][' . esc_attr( $psstats_key ) . ']" /> ' . esc_html( $psstats_name ) . ' &nbsp; <br />';
				}
				?>
			</td>
			<td width="50%">
				<?php echo sprintf( esc_html__( 'Choose users by user role you do %1$snot%2$s want to track.', 'psstats' ), '<strong>', '</strong>' ); ?>
                 <?php if ($settings->is_network_enabled()) { ?>
                     <br><p><strong>This setting will be applied to all blogs. Changing it here also changes it for other blogs.</strong></p>
                <?php } ?>
			</td>
		</tr>
		<tr>
			<th width="20%" scope="row"><label><?php echo esc_html( Piwik::translate( 'SitesManager_GlobalListExcludedIps' ) ); ?></label>:
			</th>
			<td width="30%">
				<?php echo sprintf( '<textarea cols="40" rows="4" id="%1$s" name="' . esc_attr( ExclusionSettings::FORM_NAME ) . '[%1$s]">%2$s</textarea>', 'excluded_ips', esc_html( $excluded_ips ) ); ?>
			</td>
			<td width="50%">
				<?php
				echo Piwik::translate(
					'SitesManager_HelpExcludedIpAddresses',
					array(
						'1.2.3.4/24',
						'1.2.3.*',
						'1.2.*.*',
					)
				)
				?>
				<br/>
				<?php echo esc_html( Piwik::translate( 'SitesManager_YourCurrentIpAddressIs', esc_html( $current_ip ) ) ); ?>
			</td>
		</tr>
		<tr>
			<th scope="row"><label><?php echo esc_html( Piwik::translate( 'SitesManager_GlobalListExcludedQueryParameters' ) ); ?></label>:
			</th>
			<td>
				<?php echo sprintf( '<textarea cols="40" rows="4" id="%1$s" name="' . esc_attr( ExclusionSettings::FORM_NAME ) . '[%1$s]">%2$s</textarea>', 'excluded_query_parameters', esc_html( $excluded_query_params ) ); ?>
			</td>
			<td>
				<?php echo esc_html( Piwik::translate( 'SitesManager_ListOfQueryParametersToExclude', '/^sess.*|.*[dD]ate$/' ) ); ?>
				<?php echo esc_html( Piwik::translate( 'SitesManager_PiwikWillAutomaticallyExcludeCommonSessionParameters', 'phpsessid, sessionid, ...' ) ); ?>
			</td>
		</tr>
		<tr>
			<th scope="row"><label><?php echo esc_html( Piwik::translate( 'SitesManager_GlobalListExcludedUserAgents' ) ); ?></label>:
			</th>
			<td>
				<?php echo sprintf( '<textarea cols="40" rows="4" id="%1$s" name="' . esc_attr( ExclusionSettings::FORM_NAME ) . '[%1$s]">%2$s</textarea>', 'excluded_user_agents', esc_html( $excluded_user_agents ) ); ?>
			</td>
			<td>

				<?php echo esc_html( Piwik::translate( 'SitesManager_GlobalExcludedUserAgentHelp1' ) ); ?>
				<br/>
				<?php echo esc_html( Piwik::translate( 'SitesManager_GlobalListExcludedUserAgents_Desc' ) ); ?>
				<?php echo esc_html( Piwik::translate( 'SitesManager_GlobalExcludedUserAgentHelp2' ) ); ?>

			</td>
		</tr>
		<tr>
			<th scope="row"><label><?php echo esc_html( Piwik::translate( 'SitesManager_KeepURLFragmentsLong' ) ); ?></label>:
			</th>
			<td>
				<?php echo sprintf( '<input type="checkbox" value="1" %2$s name="' . esc_attr( ExclusionSettings::FORM_NAME ) . '[%1$s]">', 'keep_url_fragments', $keep_url_fragments ? ' checked="checked"' : '' ); ?>
			</td>
			<td>

				<?php
				echo Piwik::translate(
					'SitesManager_KeepURLFragmentsHelp',
					array(
						'<em>#</em>',
						'<em>example.org/index.html#first_section</em>',
						'<em>example.org/index.html</em>',
					)
				)
				?>
				<br/>
				<?php echo esc_html( Piwik::translate( 'SitesManager_KeepURLFragmentsHelp2' ) ); ?>

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

<?php } ?>