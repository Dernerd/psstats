<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Settings\Storage\Backend;

use Piwik\Concurrency\Lock;
use Piwik\Container\StaticContainer;
use Piwik\Db;

abstract class BaseSettingsTable implements BackendInterface
{
    /**
     * @var Db\AdapterInterface
     */
    protected $db;

    /** @var Lock */
    protected $lock;

    public function __construct()
    {
        $this->lock = StaticContainer::getContainer()->make(
            Lock::class,
            array ('lockKeyStart' => 'PluginSettingsTable')
        );
    }

    protected function initDbIfNeeded()
    {
        if (!isset($this->db)) {
            // we do not want to create a db connection on backend creation
            $this->db = Db::get();
        }
    }

}