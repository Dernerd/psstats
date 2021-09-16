<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Live\Reports;

abstract class Base extends \Piwik\Plugin\Report
{
    protected function init()
    {
        $this->categoryId = 'Live!';
    }

    public function configureReportMetadata(&$availableReports, $infos)
    {
    }
}
