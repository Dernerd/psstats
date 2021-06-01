<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\TagManager\Template\Variable;

use Piwik\Settings\FieldConfig;
use Piwik\Validators\CharacterLength;
use Piwik\Validators\NotEmpty;

class ConstantVariable extends BaseVariable
{
    public function getCategory()
    {
        return self::CATEGORY_UTILITIES;
    }

    public function getParameters()
    {
        return array(
            $this->makeSetting('constantValue', '', FieldConfig::TYPE_STRING, function (FieldConfig $field) {
                $field->title = 'Value';
                $field->validators[] = new NotEmpty();
                $field->validators[] = new CharacterLength(1, 500);
            }),

        );
    }

}
