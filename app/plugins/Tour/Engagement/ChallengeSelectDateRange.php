<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Tour\Engagement;

use Piwik\Piwik;

class ChallengeSelectDateRange extends Challenge
{
    public function getName()
    {
        return Piwik::translate('Tour_SelectDateRange');
    }

    public function getDescription()
    {
        return Piwik::translate('Tour_SelectDateRangeDescription');
    }

    public function getId()
    {
        return 'select_date_range';
    }

    public function getUrl()
    {
        return 'https://n3rds.work/docs/piwik-tour/#select-a-date-range';
    }


}