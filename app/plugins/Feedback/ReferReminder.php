<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Feedback;

use Piwik\Piwik;
use Piwik\Option;

class ReferReminder
{
    public $userLogin;
    public $option;

    public function __construct()
    {
        $this->userLogin = Piwik::getCurrentUserLogin();
        $this->option = 'Feedback.nextReferReminder';
    }

    public function getUserOption()
    {
        return Option::get("{$this->option}.{$this->userLogin}");
    }

    public function setUserOption($value)
    {
        Option::set("{$this->option}.{$this->userLogin}", $value);
    }
}
