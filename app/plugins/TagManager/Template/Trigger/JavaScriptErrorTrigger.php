<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\TagManager\Template\Trigger;


class JavaScriptErrorTrigger extends BaseTrigger
{
    public function getCategory()
    {
        return self::CATEGORY_OTHERS;
    }

    public function getIcon()
    {
        return 'plugins/TagManager/images/icons/error.svg';
    }

    public function getParameters()
    {
        return array();
    }

}
