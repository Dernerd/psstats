<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 * @package psstats
 */

namespace WpPsstats\Updater;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // if accessed directly
}

class UpdateInProgressException extends \Exception {

	public function __construct( $message = "Psstats upgrade is already in progress", $code = 0, $previous = null ) {
		parent::__construct( $message, $code, $previous );
	}
}
