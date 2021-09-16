<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Marketplace\Categories;

use Piwik\Category\Subcategory;

class PremiumFeaturesSubcategory extends Subcategory
{
    protected $categoryId = 'Marketplace_Marketplace';
    protected $id = 'Marketplace_PaidPlugins';
    protected $order = 10;

}
