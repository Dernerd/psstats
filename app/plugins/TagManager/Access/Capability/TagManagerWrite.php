<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\TagManager\Access\Capability;

use Piwik\Access\Capability;
use Piwik\Access\Role\Admin;
use Piwik\Access\Role\Write;
use Piwik\Piwik;

class TagManagerWrite extends Capability
{
    public const ID = 'tagmanager_write';

    public function getId(): string
    {
        return self::ID;
    }

    public function getCategory(): string
    {
        return Piwik::translate('TagManager_TagManager');
    }

    public function getName(): string
    {
        return Piwik::translate('UsersManager_PrivWrite');
    }

    public function getDescription(): string
    {
        return Piwik::translate('TagManager_CapabilityWriteDescription');
    }

    public function getIncludedInRoles(): array
    {
        return array(
            Write::ID,
            Admin::ID
        );
    }

}
