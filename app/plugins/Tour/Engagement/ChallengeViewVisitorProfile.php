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

class ChallengeViewVisitorProfile extends Challenge
{
    public function getName()
    {
        return Piwik::translate('Tour_ViewX', Piwik::translate('Live_VisitorProfile'));
    }

    public function getDescription()
    {
        return Piwik::translate('Tour_ViewVisitorProfileDescription');
    }

    public function getId()
    {
        return 'view_visitor_profile';
    }

    public function getUrl()
    {
        return 'https://n3rds.work/docs/user-profile/';
    }


}