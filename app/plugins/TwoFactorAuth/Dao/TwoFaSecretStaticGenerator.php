<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\TwoFactorAuth\Dao;

class TwoFaSecretStaticGenerator extends TwoFaSecretRandomGenerator
{
    public function generateSecret()
    {
       return str_pad('1', 16, '1');
    }
}

