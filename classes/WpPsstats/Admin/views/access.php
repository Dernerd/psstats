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

use WpPsstats\Access;
use WpPsstats\Admin\AccessSettings;

/** @var Access $access */
/** @var \WpPsstats\Roles $roles */
/** @var \WpPsstats\Capabilities $capabilites */
?>

<p><?php esc_html_e( 'Manage which roles can view and manage your reporting data.', 'psstats' ); ?></p>

<form method="post">
	<?php wp_nonce_field( AccessSettings::NONCE_NAME ); ?>

	<table class="psstats-form widefat">
		<thead>
		<tr>
			<th width="30%"><?php esc_html_e( 'WordPress Role', 'psstats' ); ?></th>
			<th><?php esc_html_e( 'Psstats Role', 'psstats' ); ?></th>
		</tr>
		</thead>
		<tbody>
		<?php
		foreach ( $roles->get_available_roles_for_configuration() as $psstats_role_id => $psstats_role_name ) {
			echo '<tr><td>';
			echo esc_html( $psstats_role_name ) . '</td>';
			echo "<td><select name='" . AccessSettings::FORM_NAME . '[' . esc_attr( $psstats_role_id ) . "]'>";
			$psstats_value = $access->get_permission_for_role( $psstats_role_id );
			foreach ( Access::$psstats_permissions as $psstats_permission => $psstats_display_name ) {
				echo "<option value='" . esc_attr( $psstats_permission ) . "' " . ( $psstats_value === $psstats_permission ? 'selected' : '' ) . '>' . esc_html( $psstats_display_name ) . '</option>';
			}
			echo '</td></tr>';
		}
		?>
		<tr>
			<td colspan="2"><input name="Submit" type="submit" class="button-primary"
								   value="<?php echo esc_attr__( 'Save Changes', 'psstats' ); ?>"/></td>
		</tr>
		</tbody>
	</table>
</form>

<p>
    <?php
        if (!is_multisite()) {
	        esc_html_e( 'A user with role administrator automatically has the super user role.', 'psstats' );
        }
    ?>
	<?php esc_html_e( 'Learn about the differences between these Psstats roles:', 'psstats' ); ?>
	<a href="https://psstats.org/faq/general/faq_70/" target="_blank" rel="noopener"><?php esc_html_e( 'View', 'psstats' ); ?></a>,
	<a href="https://psstats.org/faq/general/faq_26910/" target="_blank"
	   rel="noopener"><?php esc_html_e( 'Write', 'psstats' ); ?></a>,
	<a href="https://psstats.org/faq/general/faq_69/" target="_blank" rel="noopener"><?php esc_html_e( 'Admin', 'psstats' ); ?></a>,
	<a href="https://psstats.org/faq/general/faq_35/" target="_blank"
	   rel="noopener"><?php esc_html_e( 'Super User', 'psstats' ); ?></a><br/>
	<?php esc_html_e( 'Want to redirect to the home page when not logged in?', 'psstats' ); ?> <a href="https://psstats.org/faq/wordpress/how-do-i-hide-my-wordpress-login-url-when-someone-accesses-a-psstats-report-directly/" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'Learn more', 'psstats' ); ?></a>
</p>

<h2><?php esc_html_e( 'Roles', 'psstats' ); ?></h2>
<p>
<?php
esc_html_e(
	'Want to give individual users access to Psstats? Simply create a user in your WordPress and assign of these roles
    to the user:',
	'psstats'
)
?>
</p>
<ul class="psstats-list">
	<?php foreach ( $roles->get_psstats_roles() as $psstats_role_config ) { ?>
		<li><?php echo esc_html( $psstats_role_config['name'] ); ?></li>
	<?php } ?>
</ul>

<h2><?php esc_html_e( 'Capabilities', 'psstats' ); ?></h2>
<p>
<?php
esc_html_e(
	'You can also install a WordPress plugin which lets you manage capabilities for each individual users. These are
    the supported capabilities:',
	'psstats'
)
?>
</p>
<ul class="psstats-list">
	<?php
	foreach ( $capabilites->get_all_capabilities_sorted_by_highest_permission() as $psstats_cap_name ) {
		?>
		<li><?php echo esc_html( $psstats_cap_name ); ?></li>
	<?php } ?>
</ul>