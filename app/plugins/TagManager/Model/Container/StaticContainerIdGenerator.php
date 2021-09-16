<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\TagManager\Model\Container;

/**
 * @ignore for tests only
 */
class StaticContainerIdGenerator implements ContainerIdGenerator
{
    /**
     * @var string
     */
    private $containerId;

    public function __construct($containerId)
    {
        $this->containerId = $containerId;
    }

    public function generateId()
    {
        return $this->containerId;
    }
}

