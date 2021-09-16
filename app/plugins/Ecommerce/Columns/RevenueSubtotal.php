<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Ecommerce\Columns;

use Piwik\Tracker\GoalManager;
use Piwik\Tracker\Action;
use Piwik\Tracker\Request;
use Piwik\Tracker\Visitor;

class RevenueSubtotal extends BaseConversion
{
    protected $columnName = 'revenue_subtotal';
    protected $type = self::TYPE_MONEY;
    protected $category = 'Goals_Ecommerce';
    protected $nameSingular = 'General_Subtotal';

    /**
     * @param Request $request
     * @param Visitor $visitor
     * @param Action|null $action
     * @param GoalManager $goalManager
     *
     * @return mixed|false
     */
    public function onEcommerceOrderConversion(Request $request, Visitor $visitor, $action, GoalManager $goalManager)
    {
        return $this->roundRevenueIfNeeded($request->getParam('ec_st'));
    }
}