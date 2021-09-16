<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\MultiSites\Columns;

use Piwik\Columns\Dimension;
use Piwik\Piwik;

class Website extends Dimension
{
    public function getName()
    {
        return Piwik::translate('General_Website');
    }
}