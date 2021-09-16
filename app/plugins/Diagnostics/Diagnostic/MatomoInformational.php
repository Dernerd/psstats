<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */
namespace Piwik\Plugins\Diagnostics\Diagnostic;

use Piwik\DbHelper;
use Piwik\Option;
use Piwik\SettingsPiwik;
use Piwik\Translation\Translator;
use Piwik\Updater;
use Piwik\Version;

/**
 * Information about Psstats itself
 */
class PsstatsInformational implements Diagnostic
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

        $results[] = DiagnosticResult::informationalResult('Psstats Version', Version::VERSION);

        if (SettingsPiwik::isPsstatsInstalled()) {
            $results[] = DiagnosticResult::informationalResult('Psstats Update History', Option::get(Updater::OPTION_KEY_PSSTATS_UPDATE_HISTORY));
            $results[] = DiagnosticResult::informationalResult('Psstats Install Version', $this->getInstallVersion());
            $results[] = DiagnosticResult::informationalResult('Latest Available Version', Option::get(\Piwik\Plugins\CoreUpdater\Updater::OPTION_LATEST_VERSION));
            $results[] = DiagnosticResult::informationalResult('Is Git Deployment', SettingsPiwik::isGitDeployment());
        }

        return $results;
    }

    private function getInstallVersion() {
        try {
            $version = DbHelper::getInstallVersion();
            if (empty($version)) {
                $version = 'Unknown - pre 3.8.';
            }
            return $version;
        } catch (\Exception $e) {
            return $e->getMessage();
        }
    }

}
