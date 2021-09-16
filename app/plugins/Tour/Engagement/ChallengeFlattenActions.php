<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Tour\Engagement;

use Piwik\Piwik;

class ChallengeFlattenActions extends Challenge
{
    public function getName()
    {
        return Piwik::translate('Tour_FlattenActions');
    }

    public function getDescription()
    {
        return Piwik::translate('Tour_FlattenActionsDescription');
    }

    public function getId()
    {
        return 'flatten_actions';
    }

    public function getUrl()
    {
        return 'https://n3rds.work/docs/piwik-tour/#flattening-reports';
    }


}