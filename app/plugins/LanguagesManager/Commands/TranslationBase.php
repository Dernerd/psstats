<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link     https://psstats.org
 * @license  http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\LanguagesManager\Commands;

use Piwik\Development;
use Piwik\Plugin\ConsoleCommand;
use Symfony\Component\Console\Input\ArrayInput;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Output\OutputInterface;

/**
 */
abstract class TranslationBase extends ConsoleCommand
{
    public function isEnabled()
    {
        return Development::isEnabled();
    }
}
