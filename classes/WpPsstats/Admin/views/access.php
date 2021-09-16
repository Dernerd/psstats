<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
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

<p><?php esc_html_e( 'Verwalte, welche Rollen Deine Berichtsdaten anzeigen und verwalten können.', 'psstats' ); ?></p>

<form method="post">
	<?php wp_nonce_field( AccessSettings::NONCE_NAME ); ?>

	<table class="psstats-form widefat">
		<thead>
		<tr>
			<th width="30%"><?php esc_html_e( 'WordPress-Rolle', 'psstats' ); ?></th>
			<th><?php esc_html_e( 'Psstats-Rolle', 'psstats' ); ?></th>
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
								   value="<?php echo esc_attr__( 'Änderungen speichern', 'psstats' ); ?>"/></td>
		</tr>
		</tbody>
	</table>
</form>

<p>
    <?php
        if (!is_multisite()) {
	        esc_html_e( 'Ein Benutzer mit der Rolle Administrator hat automatisch die Superuser-Rolle.', 'psstats' );
        }
    ?>
	<?php esc_html_e( 'Erfahre mehr über die Unterschiede zwischen diesen Psstats-Rollen:', 'psstats' ); ?>
	<a href="https://n3rds.work/faq/general/faq_70/" target="_blank" rel="noopener"><?php esc_html_e( 'Ansicht', 'psstats' ); ?></a>,
	<a href="https://n3rds.work/faq/general/faq_26910/" target="_blank"
	   rel="noopener"><?php esc_html_e( 'Schreiben', 'psstats' ); ?></a>,
	<a href="https://n3rds.work/faq/general/faq_69/" target="_blank" rel="noopener"><?php esc_html_e( 'Admin', 'psstats' ); ?></a>,
	<a href="https://n3rds.work/faq/general/faq_35/" target="_blank"
	   rel="noopener"><?php esc_html_e( 'Superuser', 'psstats' ); ?></a><br/>
	<?php esc_html_e( 'Möchtest Du auf die Startseite umleiten, wenn sie nicht eingeloggt sind?', 'psstats' ); ?> <a href="https://n3rds.work/faq/wordpress/how-do-i-hide-my-wordpress-login-url-when-someone-accesses-a-psstats-report-directly/" target="_blank" rel="noreferrer noopener"><?php esc_html_e( 'Mehr erfahren', 'psstats' ); ?></a>
</p>

<h2><?php esc_html_e( 'Rollen', 'psstats' ); ?></h2>
<p>
<?php
esc_html_e(
	'Möchtest Du einzelnen Benutzern Zugriff auf Psstats gewähren? Erstelle einfach einen Benutzer in Deinem WordPress und weise diese Rollen
	 den Benutzer zu:',
	'psstats'
)
?>
</p>
<ul class="psstats-list">
	<?php foreach ( $roles->get_psstats_roles() as $psstats_role_config ) { ?>
		<li><?php echo esc_html( $psstats_role_config['name'] ); ?></li>
	<?php } ?>
</ul>

<h2><?php esc_html_e( 'Fähigkeiten', 'psstats' ); ?></h2>
<p>
<?php
esc_html_e(
	'Du kannst auch ein WordPress-Plugin installieren, mit dem Du die Funktionen für jeden einzelnen Benutzer verwalten kannst. Diese sind
	die unterstützten Fähigkeiten:',
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