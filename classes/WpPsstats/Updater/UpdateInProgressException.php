<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats\Updater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class UpdateInProgressException extends \Exception {

	public function __construct( $message = "Psstats-Upgrade ist bereits im Gange", $code = 0, $previous = null ) {
		parent::__construct( $message, $code, $previous );
	}
}
