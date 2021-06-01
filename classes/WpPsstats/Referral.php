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

/**
 * Every 90 days we show a please review notice until the user dismisses this notice or clicks on rate us.
 * We only show this notice on Psstats screens.
 *
 * @package WpPsstats
 */
class Referral {

	const OPTION_NAME_REFERRAL_DISMISSED = 'psstats-referral-dismissed';

	/**
	 * @var int
	 */
	private $time;

	public function __construct() {
		$this->time = time();
	}

	/**
	 * @internal  for tests only
	 * @param int $time
	 */
	public function set_time( $time ) {
		$this->time = $time;
	}

	public function register_hooks() {
		$self = $this;

		add_action(
			'wp_ajax_psstats_referral_dismiss_admin_notice',
			function () use ( $self ) {
				if ( is_admin() && $self->should_show() && $self->can_refer() ) {
					// no need for an nonce check here as it's nothing critical
					if ( ! empty( $_POST['forever'] ) ) {
						$self->dismiss_forever();
					} else {
						$self->dismiss();
					}
				}
			}
		);
		add_action(
			'admin_notices',
			function () use ( $self ) {
				if ( $self->can_refer() && $self->should_show_on_screen() ) {
					$self->render();
				}
			}
		);
	}

	public function render() {
		include 'views/referral.php';
	}

	public function should_show_on_screen() {
		if ( ! is_admin() ) {
			return false;
		}
		$screen = get_current_screen();
		return $screen && $screen->id && strpos( $screen->id, 'psstats-' ) === 0;
	}

	public function can_refer() {
		return current_user_can( Capabilities::KEY_VIEW );
	}

	public function dismiss_forever() {
		$tenYears = 60 * 60 * 24 * 365 * 10;
		update_option( self::OPTION_NAME_REFERRAL_DISMISSED, $this->time + $tenYears );
	}

	public function dismiss() {
		update_option( self::OPTION_NAME_REFERRAL_DISMISSED, $this->time, true );
	}

	public function get_last_dismissed() {
		return get_option( self::OPTION_NAME_REFERRAL_DISMISSED );
	}

	private function get_days_in_seconds( $num_days ) {
		return 60 * 60 * 24 * $num_days;
	}

	public function should_show() {
		$dismissed = $this->get_last_dismissed();

		if ( ! $dismissed ) {
			// the first time we check... we set it back 30 days cause we want to see first rating after 60 days
			$this->time = $this->time - $this->get_days_in_seconds( 30 );
			$this->dismiss();
			return false;
		}

		$ninetyDaysInSeconds = $this->get_days_in_seconds( 90 );

		if ( $this->time > ( $dismissed + $ninetyDaysInSeconds ) ) {
			return true;
		}

		return false;
	}


}