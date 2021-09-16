<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Events\Reports;

use Piwik\Piwik;
use Piwik\Plugins\Events\Columns\EventCategory;

/**
 * Report metadata class for the Events.getCategoryFromNameId class.
 */
class GetCategoryFromNameId extends Base
{
    protected function init()
    {
        parent::init();

        $this->dimension     = new EventCategory();
        $this->name          = Piwik::translate('Events_EventCategories');
        $this->isSubtableReport = true;
    }
}