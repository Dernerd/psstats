<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Container;

use RuntimeException;

/**
 * Thrown if the root container has not been created and set in StaticContainer.
 */
class ContainerDoesNotExistException extends RuntimeException
{
}
