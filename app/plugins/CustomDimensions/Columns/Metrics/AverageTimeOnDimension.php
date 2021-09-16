<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\CustomDimensions\Columns\Metrics;

use Piwik\DataTable\Row;
use Piwik\Metrics\Formatter;
use Piwik\Piwik;
use Piwik\Plugins\Actions\Columns\Metrics\AverageTimeOnPage;

/**
 * The average amount of time spent on a dimension. Calculated as:
 *
 *     sum_time_spent / nb_visits
 *
 * sum_time_spent and nb_visits are calculated by Archiver classes.
 */
class AverageTimeOnDimension extends AverageTimeOnPage
{
    public function getName()
    {
        return 'avg_time_on_dimension';
    }

    public function getTranslatedName()
    {
        return Piwik::translate('CustomDimensions_ColumnAvgTimeOnDimension');
    }

}