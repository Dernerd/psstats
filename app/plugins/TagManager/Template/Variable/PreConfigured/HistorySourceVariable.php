<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\TagManager\Template\Variable\PreConfigured;

class HistorySourceVariable extends BaseDataLayerVariable
{
    public function getCategory()
    {
        return self::CATEGORY_HISTORY;
    }

    protected function getDataLayerVariableName()
    {
        return 'mtm.historyChangeSource';
    }

}
