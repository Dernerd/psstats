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

class ChallengeViewVisitsLog extends Challenge
{
    public function getName()
    {
        return Piwik::translate('Tour_ViewX', Piwik::translate('Live_VisitsLog'));
    }

    public function getDescription()
    {
        return Piwik::translate('Tour_ViewVisitsLogDescription');
    }

    public function getId()
    {
        return 'view_visits_log';
    }

    public function getUrl()
    {
        return 'https://n3rds.work/docs/real-time/#visits-log';
    }


}