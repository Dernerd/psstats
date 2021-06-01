(function() {

    var libLoaded = false;
    var libAvailable = false;
    var callbacks = {
        callbacks: [],
        push: function(callback) {
            if (libAvailable) {
                callback();
            } else {
                this.callbacks.push(callback);
            }
        }
    };

    window._paq = window._paq || [];

    if ('object' !== typeof window.piwikPluginAsyncInit) {
        window.piwikPluginAsyncInit = [];
    }

    function executeCallbacks() {

        var i;
        for (i = 0; i < callbacks.callbacks.length; i++) {
            callbacks.callbacks[i]();
        }

        callbacks.callbacks = [];
    }

    window.piwikPluginAsyncInit.push(function() {
        libAvailable = true;
        executeCallbacks();
    });

    function checkLoadedAlready() {
        if (libAvailable || typeof window.Piwik === 'object') {
            libAvailable = true;
            libLoaded = true; // eg loaded by tests or manually by user
            executeCallbacks();
            return true;
        }
        return false;
    }

    function loadPsstats() {
        if (checkLoadedAlready()) {
            return;
        }
        var replaceMeWithTracker = ''; // do not modify this line, be replaced with Psstats tracker. Cannot use /*!! comment because of Jshrink bug
        libAvailable = typeof window.Piwik !== 'undefined' || typeof window.Psstats !== 'undefined';
        libLoaded = libAvailable;
    }

    function loadTracker(url, jsEndpoint) {
        if (checkLoadedAlready()) {
            return;
        }
        if (!libLoaded) {
            // we can load the lib only once... if user tries configures different Psstats instances where they have
            // different piwik.js , this will be a known problem (eg some other instance has maybe additional 3rd party plugin)
            // installed which another doesn't have.
            libLoaded = true;
            var d = document,
                g = d.createElement('script'),
                s = d.getElementsByTagName('script')[0];
            g.type = 'text/javascript';
            g.async = true;
            g.src = url + jsEndpoint;
            s.parentNode.insertBefore(g, s);
        }
    }

    var configuredTrackers = {};

    return function(parameters, TagManager) {
        var lastUserId;
        var lastIdSite;
        var lastPsstatsUrl;

        function getPsstatsUrlFromConfig(psstatsConfig) {
            var psstatsUrl = psstatsConfig.psstatsUrl;
            if (psstatsUrl && String(psstatsUrl).substr(-1, 1) !== '/') {
                psstatsUrl += '/';
            }
            return psstatsUrl;
        }

        this.fire = function() {
            callbacks.push(function() {
                if (!parameters.psstatsConfig || !parameters.psstatsConfig.name) {
                    return;
                }

                // this is the psstatsConfig variable name and the only way to differentiate two different tracker
                // configurations
                var variableName = parameters.psstatsConfig.name;

                // we need to fetch psstatsConfig again in case some parameters changed meanwhile that are variables...
                // eg userId might be a variable and it's value might be different now
                var psstatsConfig = parameters.get('psstatsConfig', {});
                var tracker;
                // we make sure to not update jsonConfig even when the configured values change... otherwise we would create
                // randomly too many trackers when eg userId changes meanwhile etc
                if (variableName in configuredTrackers) {
                    tracker = configuredTrackers[variableName];
                } else {
                    // we need to set it up manually and make sure we call methods in correct order because there could be
                    // lots of different trackers configured either for different psstats URLs, for different psstats Ids
                    lastIdSite = psstatsConfig.idSite;
                    // but even two or more different configs for the same Psstats URL & idSite
                    lastPsstatsUrl = getPsstatsUrlFromConfig(psstatsConfig);
                    var trackerUrl = lastPsstatsUrl + psstatsConfig.trackingEndpoint;
                    if (psstatsConfig.registerAsDefaultTracker) {
                        tracker = Piwik.addTracker(trackerUrl, psstatsConfig.idSite);
                    } else {
                        tracker = Piwik.getTracker(trackerUrl, psstatsConfig.idSite);
                    }
                    configuredTrackers[variableName] = tracker;

                    if (psstatsConfig.disableCookies) {
                        tracker.disableCookies();
                    }

                    if (psstatsConfig.requireCookieConsent) {
                        tracker.requireCookieConsent();
                    }

                    if (psstatsConfig.requireConsent) {
                        tracker.requireConsent();
                    }

                    if (psstatsConfig.enableCrossDomainLinking) {
                        tracker.enableCrossDomainLinking();
                    }

                    if (psstatsConfig.setSecureCookie) {
                        tracker.setSecureCookie(true);
                    }

                    if (psstatsConfig.cookieSameSite) {
                        tracker.setCookieSameSite(psstatsConfig.cookieSameSite);
                    }

                    if (psstatsConfig.cookieDomain) {
                        tracker.setCookieDomain(psstatsConfig.cookieDomain);
                    }

                    if (psstatsConfig.cookiePath) {
                        tracker.setCookiePath(psstatsConfig.cookiePath);
                    }

                    if (psstatsConfig.domains &&
                        TagManager.utils.isArray(psstatsConfig.domains) &&
                        psstatsConfig.domains.length) {
                        var domains = [];
                        var k, domainType;

                        for (k = 0; k < psstatsConfig.domains.length; k++) {
                            var domainType = typeof psstatsConfig.domains[k];
                            if (domainType === 'string') {
                                domains.push(psstatsConfig.domains[k]);
                            } else if (domainType === 'object' && psstatsConfig.domains[k].domain) {
                                domains.push(psstatsConfig.domains[k].domain);
                            }
                        }

                        tracker.setDomains(domains);
                    }

                    if (psstatsConfig.alwaysUseSendBeacon) {
                        tracker.alwaysUseSendBeacon();
                    }

                    if (psstatsConfig.enableLinkTracking) {
                        tracker.enableLinkTracking();
                    }
                    if (psstatsConfig.enableDoNotTrack) {
                        tracker.setDoNotTrack(1);
                    }
                    if (psstatsConfig.enableJSErrorTracking) {
                        tracker.enableJSErrorTracking();
                    }
                    if (psstatsConfig.enableHeartBeatTimer) {
                        tracker.enableHeartBeatTimer();
                    }
                    if (psstatsConfig.trackAllContentImpressions) {
                        tracker.trackAllContentImpressions();
                    }
                    if (psstatsConfig.trackVisibleContentImpressions) {
                        tracker.trackVisibleContentImpressions();
                    }
                }

                if ((psstatsConfig.userId || tracker.getUserId()) && lastUserId !== psstatsConfig.userId) {
                    // we also go in here if a userId is set currently, and we now need to unset it
                    // might change each time this method is called
                    tracker.setUserId(psstatsConfig.userId);
                    lastUserId = psstatsConfig.userId;
                }

                if (psstatsConfig.idSite && lastIdSite !== psstatsConfig.idSite) {
                    // might change each time this method is called
                    tracker.setSiteId(psstatsConfig.idSite);
                    lastIdSite = psstatsConfig.idSite;
                }

                var possiblyUpdatedPsstatsUrl = getPsstatsUrlFromConfig(psstatsConfig);
                if (possiblyUpdatedPsstatsUrl && lastPsstatsUrl !== possiblyUpdatedPsstatsUrl) {
                    // might change each time this method is called
                    tracker.setTrackerUrl(possiblyUpdatedPsstatsUrl + psstatsConfig.trackingEndpoint);
                    lastIdSite = possiblyUpdatedPsstatsUrl;
                }

                if (psstatsConfig.customDimensions &&
                    TagManager.utils.isArray(psstatsConfig.customDimensions) &&
                    psstatsConfig.customDimensions.length) {
                    var dimIndex;
                    for (dimIndex = 0; dimIndex < psstatsConfig.customDimensions.length; dimIndex++) {
                        var dimension = psstatsConfig.customDimensions[dimIndex];
                        if (dimension && TagManager.utils.isObject(dimension) && dimension.index && dimension.value) {
                            tracker.setCustomDimension(dimension.index, dimension.value);
                        }
                    }
                }

                if (tracker) {
                    var trackingType = parameters.get('trackingType');

                    if (trackingType === 'pageview') {
                        var customTitle = parameters.get('documentTitle');
                        if (customTitle) {
                            tracker.setDocumentTitle(customTitle);
                        }
                        var customUrl = parameters.get('customUrl');
                        if (customUrl) {
                            tracker.setCustomUrl(customUrl);
                        }
                        tracker.trackPageView();
                    } else if (trackingType === 'event') {
                        tracker.trackEvent(parameters.get('eventCategory'), parameters.get('eventAction'), parameters.get('eventName'), parameters.get('eventValue'));
                    } else if (trackingType === 'goal') {
                        tracker.trackGoal(parameters.get('idGoal'));
                    }
                }
            });

            // we load the psstats tracker only when the tag was fired
            // and we load it only after adding the callback, this way we make sure at least for the first psstats tag
            // to initialize the tracker during window.piwikPluginAsyncInit

            var psstatsConfig = parameters.get('psstatsConfig', {});
            if (psstatsConfig.bundleTracker) {
                loadPsstats();
                // we don't return in case for some reason psstats was not loaded there, then we have the fallback
            }

            if (!psstatsConfig.psstatsUrl || !psstatsConfig.idSite) {
                return;
            }

            var psstatsUrl = getPsstatsUrlFromConfig(psstatsConfig);
            loadTracker(psstatsUrl, psstatsConfig.jsEndpoint);
        };
    };
})();