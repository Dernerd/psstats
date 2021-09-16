<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats;

use WpPsstats\User\Sync;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class Access {
	public static $psstats_permissions = array(
		Capabilities::KEY_NONE  => 'None',
		Capabilities::KEY_VIEW  => 'View',
		Capabilities::KEY_WRITE => 'Write',
		Capabilities::KEY_ADMIN => 'Admin',
	);

	/**
	 * @var Settings
	 */
	private $settings;

	public function __construct( Settings $settings ) {
		$this->settings = $settings;
	}

	public function get_permission_for_role( $role_name ) {
		$options = $this->settings->get_global_option( Settings::OPTION_KEY_CAPS_ACCESS );

		$role = get_role( $role_name );
		if ( $role && isset( $options[ $role_name ] ) ) {
			return $options[ $role_name ];
		}
	}

	public function save( $values ) {
		global $wp_roles;

		$roles           = new Roles( $this->settings );
		$available_roles = $roles->get_available_roles_for_configuration();

		$caps_to_store = array();
		foreach ( $values as $role => $psstats_permission ) {
			if ( isset( $available_roles[ $role ] ) &&
				 $wp_roles->is_role( $role )
				 && array_key_exists( $psstats_permission, self::$psstats_permissions ) ) {
				$caps_to_store[ $role ] = $psstats_permission;
			}
		}

		// we can't add the capabilities to the role directly using say $wp_roles->add_role cause it would not be
		// synced across sites when the plugin is network activated
		$this->settings->apply_changes( array( Settings::OPTION_KEY_CAPS_ACCESS => $caps_to_store ) );

		$sync = new Sync();
		$sync->sync_current_users();

		$wp_roles->init_roles();

		if ( $this->settings->is_network_enabled() ) {
			// we do this in the background syncing across all sites...
			wp_schedule_single_event( time() + 10, ScheduledTasks::EVENT_SYNC );
		}
	}

}
