<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\TagManager\Template\Variable\PreConfigured;

class FormElement extends BaseDataLayerVariable
{
    public function getCategory()
    {
        return self::CATEGORY_CLICKS;
    }

    protected function getDataLayerVariableName()
    {
        return 'mtm.formElement';
    }

}
