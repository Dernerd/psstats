# PHP Client for Psstats Analytics Tracking API

The PHP Tracker Client provides all features of the [Psstats Javascript Tracker](https://n3rds.work/docs/ps-stats-entwickler-javascript-tracking-client), such as Ecommerce Tracking, Custom Variables, Event Tracking and more. 

## Documentation and examples 
Check out our [Psstats-PHP-Tracker developer documentation](https://developer.psstats.org/api-reference/PHP-Piwik-Tracker) and [Psstats Tracking API guide](https://n3rds.work/docs/tracking-api/).


```php
// Required variables
$psstatsSiteId = 6;                  // Site ID
$psstatsUrl = "https://example.tld"; // Your psstats URL
$psstatsToken = "";                  // Your authentication token

// Optional variable
$psstatsPageTitle = "";              // The title of the page

// Load object
require_once("PsstatsTracker.php");

// Psstats object
$psstatsTracker = new PsstatsTracker((int)$psstatsSiteId, $psstatsUrl);

// Set authentication token
$psstatsTracker->setTokenAuth($psstatsToken);

// Track page view
$psstatsTracker->doTrackPageView($psstatsPageTitle);
```

## Requirements:
* JSON extension (json_decode, json_encode)
* cURL or stream extension (to issue the HTTPS request to Psstats)

## Installation

### Composer

```
composer require psstats/psstats-php-tracker
``` 

### Manually

Alternatively, you can download the files and require the Psstats tracker manually: 

```
require_once("PsstatsTracker.php");
```

## License

Released under the [BSD License](http://www.opensource.org/licenses/bsd-license.php)
