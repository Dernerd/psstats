<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Actions\Categories;

use Piwik\Category\Subcategory;
use Piwik\Piwik;

class SiteSearchSubcategory extends Subcategory
{
    protected $categoryId = 'General_Actions';
    protected $id = 'Actions_SubmenuSitesearch';
    protected $order = 25;

    public function getHelp()
    {
        return '<p>' . Piwik::translate('Actions_SiteSearchSubcategoryHelp1') . '</p>'
            . '<p>' . Piwik::translate('Actions_SiteSearchSubcategoryHelp2') . '</p>'
            . '<p><a href="https://psstats.org/docs/site-search/" rel="noreferrer noopener" target="_blank">' . Piwik::translate('Actions_SiteSearchSubcategoryHelp3') . '</a></p>';
    }
}