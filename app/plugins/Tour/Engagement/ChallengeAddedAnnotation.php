<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Tour\Engagement;

use Piwik\Piwik;

class ChallengeAddedAnnotation extends Challenge
{
    public function getName()
    {
        return Piwik::translate('Tour_AddAnnotation');
    }

    public function getDescription()
    {
        return Piwik::translate('Annotations_PluginDescription');
    }

    public function getId()
    {
        return 'add_annotation';
    }

    public function getUrl()
    {
        return 'https://psstats.org/docs/annotations/';
    }


}