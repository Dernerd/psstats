<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Contents\Categories;

use Piwik\Category\Subcategory;
use Piwik\Piwik;

class ContentsSubcategory extends Subcategory
{
    protected $categoryId = 'General_Actions';
    protected $id = 'Contents_Contents';
    protected $order = 45;

    public function getHelp()
    {
        return '<p>' . Piwik::translate('Contents_ContentsSubcategoryHelp1') . '</p>'
            . '<p><a href="https://n3rds.work/docs/content-tracking/" rel="noreferrer noopener" target="_blank">' . Piwik::translate('Contents_ContentsSubcategoryHelp2') . '</a></p>';
    }
}
