<?php
/**
 * Psstats - free/libre analytics platform
 *
 * For more information, see README.md
 *
 * @license released under BSD License http://www.opensource.org/licenses/bsd-license.php
 * @link https://n3rds.work/docs/tracking-api/
 *
 * @category Psstats
 * @package PsstatsTracker
 */

if (!class_exists('\PsstatsTracker')) {
    include_once('PsstatsTracker.php');
}

/**
 * Helper function to quickly generate the URL to track a page view.
 *
 * @deprecated
 * @param $idSite
 * @param string $documentTitle
 * @return string
 */
function Piwik_getUrlTrackPageView($idSite, $documentTitle = '')
{
    return Psstats_getUrlTrackPageView($idSite, $documentTitle);
}

/**
 * Helper function to quickly generate the URL to track a goal.
 *
 * @deprecated
 * @param $idSite
 * @param $idGoal
 * @param float $revenue
 * @return string
 */
function Piwik_getUrlTrackGoal($idSite, $idGoal, $revenue = 0.0)
{
    return Psstats_getUrlTrackGoal($idSite, $idGoal, $revenue);
}

/**
 * For BC only
 *
 * @deprecated use PsstatsTracker instead
 */
class PiwikTracker extends PsstatsTracker {}
