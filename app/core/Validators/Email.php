<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Validators;

use Piwik\Piwik;

class Email extends BaseValidator
{
    public function validate($value)
    {
        if ($this->isValueBare($value)) {
            return;
        }

        if (!Piwik::isValidEmailString($value)) {
            throw new Exception(Piwik::translate('General_ValidatorErrorNotEmailLike', array($value)));
        }
    }
}