/**
 * PS Stats - kostenlose/freie Analyseplattform
 *
 * @link https://n3rds.work
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 *
 */

(function() {

    function init() {
        if ('object' === typeof window && !window.Psstats) {
            // Psstats is not defined yet
            return;
        }

        // disable cookies and remove them when a tracker is created
        window.Psstats.on('TrackerSetup', function(tracker) {
            tracker.setCookieConsentGiven = function() {};
            tracker.rememberCookieConsentGiven = function() {};
            tracker.disableCookies();
        });
    }

    if ('object' === typeof window.Psstats) {
        init();
    } else {
        // tracker is loaded separately for sure
        if ('object' !== typeof window.psstatsPluginAsyncInit) {
            window.psstatsPluginAsyncInit = [];
        }

        window.psstatsPluginAsyncInit.push(init);
    }
})();