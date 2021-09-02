<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\TagManager\Template\Variable\PreConfigured;

use Piwik\Plugins\TagManager\Context\WebContext;


class PageTitleVariable extends BasePreConfiguredVariable
{
    public function getCategory()
    {
        return self::CATEGORY_PAGE_VARIABLES;
    }

    public function loadTemplate($context, $entity)
    {
        switch ($context) {
            case WebContext::ID:
                return $this->makeReturnTemplateMethod('parameters.document.title');
        }
    }

}
