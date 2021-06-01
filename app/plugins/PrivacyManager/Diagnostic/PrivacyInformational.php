<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\PrivacyManager\Diagnostic;

use Piwik\Plugins\Diagnostics\Diagnostic\Diagnostic;
use Piwik\Plugins\Diagnostics\Diagnostic\DiagnosticResult;
use Piwik\Plugins\PrivacyManager\Config;
use Piwik\SettingsPiwik;
use Piwik\Translation\Translator;

/**
 * Information about Psstats itself
 */
class PrivacyInformational implements Diagnostic
{
    /**
     * @var Translator
     */
    private $translator;

    public function __construct(Translator $translator)
    {
        $this->translator = $translator;
    }

    public function execute()
    {
        $results = [];

        if (SettingsPiwik::isPsstatsInstalled()) {
            $config = new Config();

            $results[] = DiagnosticResult::informationalResult('Anonymize Referrer', $config->anonymizeReferrer);
            $results[] = DiagnosticResult::informationalResult('Do Not Track enabled', $config->doNotTrackEnabled);
        }

        return $results;
    }


}