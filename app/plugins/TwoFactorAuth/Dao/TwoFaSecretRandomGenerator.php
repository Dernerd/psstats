<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\TwoFactorAuth\Dao;

require_once PIWIK_DOCUMENT_ROOT . '/libs/Authenticator/TwoFactorAuthenticator.php';

class TwoFaSecretRandomGenerator
{
    public function generateSecret()
    {
        $authenticator = new \TwoFactorAuthenticator();
        return $authenticator->createSecret(16);
    }
}

