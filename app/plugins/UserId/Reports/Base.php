<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\UserId\Reports;

use Piwik\Plugin\Report;

abstract class Base extends Report
{
    protected function init()
    {
        $this->categoryId = 'General_Visitors';
        $this->onlineGuideUrl = 'https://n3rds.work/docs/user-id/';
    }
}
