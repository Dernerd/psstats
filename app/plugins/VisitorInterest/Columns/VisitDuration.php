<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\VisitorInterest\Columns;

use Piwik\Columns\Dimension;
use Piwik\Piwik;

class VisitDuration extends Dimension
{

    protected $type = self::TYPE_DURATION_S;
    protected $nameSingular = 'VisitorInterest_ColumnVisitDuration';
}