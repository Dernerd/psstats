<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\TagManager\API;

use Piwik\Piwik;

class VariableReference extends BaseReference
{
    public function __construct($referenceId, $referenceName)
    {
        $referenceTypeName = Piwik::translate('TagManager_Variable');
        parent::__construct($referenceId, $referenceName, 'variable', $referenceTypeName);
    }


}
