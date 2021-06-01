<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Tour\Engagement;

use Piwik\ArchiveProcessor\Rules;
use Piwik\Piwik;

class ChallengeDisableBrowserArchiving extends Challenge
{
    public function getName()
    {
        return Piwik::translate('Tour_DisableBrowserArchiving');
    }

    public function getId()
    {
        return 'disable_browser_archiving';
    }

    public function isCompleted()
    {
        return !Rules::isBrowserTriggerEnabled();
    }

    public function getUrl()
    {
        return 'https://psstats.org/docs/setup-auto-archiving/';
    }


}