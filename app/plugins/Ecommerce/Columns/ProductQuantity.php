<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Ecommerce\Columns;

use Piwik\Columns\Dimension;

class ProductQuantity extends Dimension
{
    protected $type = self::TYPE_NUMBER;
    protected $dbTableName = 'log_conversion_item';
    protected $columnName = 'quantity';
    protected $nameSingular = 'Goals_ProductQuantity';
    protected $category = 'Goals_Ecommerce';

}