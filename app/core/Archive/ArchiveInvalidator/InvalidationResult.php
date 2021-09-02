<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Archive\ArchiveInvalidator;

use Piwik\Date;

/**
 * Information about the result of an archive invalidation operation.
 */
class InvalidationResult
{
    /**
     * Dates that couldn't be invalidated because they are earlier than the configured log
     * deletion limit.
     *
     * @var array
     */
    public $warningDates = array();

    /**
     * Dates that were successfully invalidated.
     *
     * @var array
     */
    public $processedDates = array();

    /**
     * The day of the oldest log entry.
     *
     * @var Date|bool
     */
    public $minimumDateWithLogs = false;

    /**
     * @return string[]
     */
    public function makeOutputLogs()
    {
        $output = array();
        if ($this->warningDates) {
            $output[] = 'Warnung: Die folgenden Daten wurden nicht ungültig gemacht, da sie vor Deinem Limit für die Protokolllöschung liegen: ' .
                implode(", ", $this->warningDates) .
                "\n Der letzte Tag mit Protokollen ist " . $this->minimumDateWithLogs . ". " .
                "\n Bitte deaktiviere 'Alte Logs löschen' oder stelle einen höheren Löschschwellenwert ein (z.B. 180 Tage oder 365 Jahre)..'.";
        }

        $output[] = "Erfolg. Die folgenden Daten wurden erfolgreich ungültig gemacht: " . implode(", ", $this->processedDates);
        return $output;
    }
}