<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\IntranetMeasurable;

class Type extends \Piwik\Measurable\Type
{
    const ID = 'intranet';
    protected $name = 'IntranetMeasurable_Intranet';
    protected $namePlural = 'IntranetMeasurable_Intranets';
    protected $description = 'IntranetMeasurable_IntranetDescription';
    protected $howToSetupUrl = '?module=CoreAdminHome&action=trackingCodeGenerator';

}

