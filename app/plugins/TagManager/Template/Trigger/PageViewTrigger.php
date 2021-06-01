<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\TagManager\Template\Trigger;


class PageViewTrigger extends BaseTrigger
{
    const ID = 'PageView';

    public function getId()
    {
        return self::ID;
    }

    public function getCategory()
    {
        return self::CATEGORY_PAGE_VIEW;
    }

    public function getIcon()
    {
        return 'plugins/TagManager/images/icons/pageview.svg';
    }

    public function getParameters()
    {
        return array();
    }

}