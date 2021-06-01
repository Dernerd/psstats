<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Ecommerce\Columns;

class Items extends BaseConversion
{
    protected $columnName = 'items';
    protected $type = self::TYPE_NUMBER;
    protected $category = 'Goals_Ecommerce';
    protected $nameSingular = 'Ecommerce_NumberOfItems';

}