<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\TagManager\Template\Trigger;

class WindowLoadedTrigger extends BaseTrigger
{
    const ID = 'WindowLoaded';

    public function getId()
    {
        return self::ID;
    }

    public function getCategory()
    {
        return self::CATEGORY_PAGE_VIEW;
    }

    public function getParameters()
    {
        return array();
    }

}
