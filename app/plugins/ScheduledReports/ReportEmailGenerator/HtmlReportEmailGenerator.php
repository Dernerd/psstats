<?php
/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

namespace Piwik\Plugins\ScheduledReports\ReportEmailGenerator;

use Piwik\Mail;
use Piwik\Plugins\ScheduledReports\GeneratedReport;
use Piwik\Plugins\ScheduledReports\ReportEmailGenerator;

class HtmlReportEmailGenerator extends ReportEmailGenerator
{
    protected function configureEmail(Mail $mail, GeneratedReport $report)
    {
        // Needed when using images as attachment with cid
        $mail->setBodyHtml($report->getContents());
    }
}