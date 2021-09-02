<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */
namespace Piwik\Plugins\Installation;

use Piwik\Mail;
use Piwik\Option;
use Piwik\Piwik;

class Onboarding
{
    const OPTION_NAME_INSTALL_MAIL = 'install_mail_sent';

    public static function sendSysAdminMail($email)
    {
        if (!Piwik::isValidEmailString($email)) {
            return;
        }
        if (Option::get(self::OPTION_NAME_INSTALL_MAIL)) {
            return;
        }
        Option::set(self::OPTION_NAME_INSTALL_MAIL, 1);

        $message = 'Hey there,<br>
<br>
Thank you for installing Psstats On-Premises, the #1 Google Analytics alternative that protects your data.<br>
<br>
You’re receiving this email from your Psstats instance because you\'re the Super User and you have just finished installing Psstats On-Premise. You’re the only person who will receive this email. The mail was sent from your Psstats.<br>
<br>
It’s now our job to ensure you get the best possible Psstats experience without any disruptions, so we hope to answer the three most common problems we find users ask when starting out with Psstats.<br>
<br>
<strong>1. Speed up your Psstats by generating your reports in the background</strong><br>
This is a common problem for first time users that can easily be fixed in a few minutes. What you’ll need to do is set up auto-archiving of your reports. I have provided you with a link of step-by-step instructions on how to do this below:<br>
<a href="https://n3rds.work/docs/setup-auto-archiving/">&gt;&gt; Set up auto-archiving of your reports</a><br><br>
<strong>2. Get the server size right for your traffic</strong><br>
Psstats is a platform designed to be fast, no matter the size of your database and how many visits you’re tracking. Here we can recommend the best infrastructure to host your Psstats.<br>
<a href="https://n3rds.work/docs/requirements/#recommended-servers-sizing-cpu-ram-disks">&gt;&gt; Learn the recommended server configuration and sizing to run Psstats with speed</a><br>
<br>
<strong>3. Next, make sure your data is secure</strong><br>
Privacy and security are of utmost importance to the Psstats team and we want to make sure security is up to the standard you need.<br>
Below is a link that will give your Psstats administrator a list of tips and best practices to improve security.<br>
<a href="https://n3rds.work/docs/security/">&gt;&gt; Tips for staying secure in Psstats</a><br>
<br>
<strong>Need more help?</strong><br>
<ul><li>Join our forum</li>
<li>If there is a feature you’d like to see in Psstats, submit a request through Github</li>
<li>And if you want first-hand assistance from our expert team, support plans are available for your business</li>
</ul>
<br>
It’s so great to have you be part of the Psstats community! We hope to deliver you the valuable insights you need to make better data-driven decisions for your website.<br>
<br>
Happy Analytics,<br>
<br>
Matthieu<br>
Psstats Founder<br>
<br>
';

        $mail = new Mail();
        $mail->addTo($email);
        $mail->setSubject('Congratulations for setting up Psstats');
        $mail->setBodyHtml($message);

        try {
            $mail->send();
        } catch (\Exception $e) {
            // Mail might not be configured yet and it won't work...
        }
    }


}
