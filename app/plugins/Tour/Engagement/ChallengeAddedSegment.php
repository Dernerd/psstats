<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Tour\Engagement;

use Piwik\Piwik;
use Piwik\Plugins\Tour\Dao\DataFinder;

class ChallengeAddedSegment extends Challenge
{
    /**
     * @var DataFinder
     */
    private $finder;

    /**
     * @var null|bool
     */
    private $completed = null;

    public function __construct(DataFinder $dataFinder)
    {
        $this->finder = $dataFinder;
    }

    public function getName()
    {
        return Piwik::translate('Tour_AddSegment');
    }

    public function getDescription()
    {
        return Piwik::translate('SegmentEditor_PluginDescription');
    }

    public function getId()
    {
        return 'add_segment';
    }

    public function isCompleted()
    {
        if (!isset($this->completed)) {
            $login = Piwik::getCurrentUserLogin();
            $this->completed = $this->finder->hasAddedSegment($login);
        }
        return $this->completed;
    }

    public function getUrl()
    {
        return 'https://n3rds.work/docs/segmentation/';
    }


}