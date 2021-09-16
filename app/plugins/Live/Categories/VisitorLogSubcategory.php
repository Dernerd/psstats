<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Live\Categories;

use Piwik\Category\Subcategory;
use Piwik\Piwik;

class VisitorLogSubcategory extends Subcategory
{
    protected $categoryId = 'General_Visitors';
    protected $id = 'Live_VisitorLog';
    protected $order = 5;

    public function getHelp()
    {
        $help = '<p>' . Piwik::translate('Live_VisitorLogSubcategoryHelp1') . '</p>';
        $help .= '<p>' . Piwik::translate('Live_VisitorLogSubcategoryHelp2') . '</p>';
        $help .= '<p><a href="https://n3rds.work/docs/real-time/" target="_blank" rel="noreferrer noopener">' . Piwik::translate('Live_VisitorLogSubcategoryHelp3') . '</a></p>';
        return $help;
    }
}
