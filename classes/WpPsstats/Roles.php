<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class Roles {
	const OPTION_SETUP_NAME = 'roles-setup';
	const ROLE_PREFIX       = 'psstats_';
	const ROLE_VIEW         = 'psstats_view_role';
	const ROLE_WRITE        = 'psstats_write_role';
	const ROLE_ADMIN        = 'psstats_admin_role';
	const ROLE_SUPERUSER    = 'psstats_superuser_role';

	/**
	 * @var Settings
	 */
	private $settings;

	public function __construct( $settings ) {
		$this->settings = $settings;
	}

	public function register_hooks() {
		add_action( 'init', array( $this, 'add_roles' ) );
	}

	public function get_available_roles_for_configuration() {
		global $wp_roles;
		$is_network_enabled = $this->settings->is_network_enabled();
		$roles              = array();

		foreach ( $wp_roles->role_names as $role_name => $name ) {
			if ( ! $is_network_enabled && 'administrator' === $role_name ) {
				// when multi site, then we consider "administrator" just a regular role and not a super user
				// when not multi site, administrator is automatically the super user
				continue;
			}

			if ( $this->is_psstats_role( $role_name ) ) {
				// a psstats capability which we don't want to change
				continue;
			}

			$roles[ $role_name ] = $name;
		}

		return $roles;
	}

	public function is_psstats_role( $role_name ) {
		return strpos( $role_name, self::ROLE_PREFIX ) === 0;
	}

	public function get_psstats_roles() {
		return array(
			self::ROLE_VIEW      => array(
				'name'       => 'Psstats View',
				'defaultCap' => Capabilities::KEY_VIEW,
			),
			self::ROLE_WRITE     => array(
				'name'       => 'Psstats Write',
				'defaultCap' => Capabilities::KEY_WRITE,
			),
			self::ROLE_ADMIN     => array(
				'name'       => 'Psstats Admin',
				'defaultCap' => Capabilities::KEY_ADMIN,
			),
			self::ROLE_SUPERUSER => array(
				'name'       => 'Psstats Super User',
				'defaultCap' => Capabilities::KEY_SUPERUSER,
			),
		);
	}

	public function add_roles() {
		if ( ! $this->has_set_up_roles() ) {
			foreach ( $this->get_psstats_roles() as $role_name => $config ) {
				add_role( $role_name, $config['name'], array( $config['defaultCap'] => true ) );
			}
			$this->mark_roles_set_up();
		}
	}

	private function mark_roles_set_up() {
		update_option( Settings::OPTION_PREFIX . self::OPTION_SETUP_NAME, 1, 1 );
	}

	private function has_set_up_roles() {
		return (bool) get_option( Settings::OPTION_PREFIX . self::OPTION_SETUP_NAME );
	}

	public function uninstall() {
		foreach ( $this->get_psstats_roles() as $role_name => $role ) {
			remove_role( $role_name );
		}
		Uninstaller::uninstall_options( Settings::OPTION_PREFIX . self::OPTION_SETUP_NAME );
	}
}
