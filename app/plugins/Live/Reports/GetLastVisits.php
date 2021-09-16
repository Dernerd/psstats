<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Live\Reports;


class GetLastVisits extends Base
{
    // this class only exists to disable the default sort column
    protected $defaultSortColumn = '';

    public function buildReportMetadata()
    {
        // do not add this report as metadata
    }

}
