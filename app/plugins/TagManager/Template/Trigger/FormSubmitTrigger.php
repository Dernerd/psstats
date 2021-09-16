<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\TagManager\Template\Trigger;

class FormSubmitTrigger extends BaseTrigger
{
    public function getCategory()
    {
        return self::CATEGORY_USER_ENGAGEMENT;
    }

    public function getIcon()
    {
        return 'plugins/TagManager/images/icons/form.svg';
    }

    public function getParameters()
    {
        return array();
    }

}
