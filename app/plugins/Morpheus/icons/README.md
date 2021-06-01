# Psstats-Icons

[![Build Status](https://api.travis-ci.com/psstats-org/psstats-icons.svg?branch=master)](https://travis-ci.com/psstats-org/psstats-icons)

This reposistory provides the source files for the icons in [psstats](https://github.com/psstats-org/psstats) and the scripts used to resize them to a common size.

## Contributing

An icon is missing or you have a better one? Create a [new issue](https://github.com/psstats-org/psstats-icons/issues/new) or, even better, open a pull request.
You can find a up-to-date list of all improvable icons on [Travis](https://travis-ci.com/psstats-org/psstats-icons).

All source files except those in `devices`, `flags`, `searchEngines` and `socials` need to have a second file called `iconname.ext.source` that mentions where the image is from.

### Naming conventions

| icon type | example | possible names |
| --------- | ------- | ----------- |
|brand|*Apple*| *Device detection* in Psstats Administration page|
|browsers|*FF*|https://github.com/psstats-org/device-detector/blob/master/Parser/Client/Browser.php#L37 |
|devices|*smartphone*| *Device detection* in Psstats Administration page|
|flags|*at*| all except *un* and *gb-** |
|os|*WIN*|https://github.com/psstats-org/device-detector/blob/master/Parser/OperatingSystem.php#L38 |
|plugins|*flash*|files in [plugins/DevicePlugins/Columns/](https://github.com/psstats-org/psstats/tree/4.x-dev/plugins/DevicePlugins/Columns) |
|searchEngines|*google.com*|https://github.com/psstats-org/searchengine-and-social-list/blob/master/SearchEngines.yml |
|SEO|*bing.com*|https://github.com/psstats-org/psstats/tree/4.x-dev/plugins/SEO |
|socials|*facebook.com*|https://github.com/psstats-org/searchengine-and-social-list/blob/master/Socials.yml |

### File Formats

Ideally all source files should be SVGs or high resolution (>100px) PNGs. As this is not always possible, JPGs, GIFs and (even multiresolution) ICOs are supported.
