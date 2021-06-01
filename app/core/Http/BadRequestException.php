<?php
/**
 * Psstats - free/libre analytics platform
 *
 * @link https://psstats.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html GPL v3 or later
 */

namespace Piwik\Http;


class BadRequestException extends HttpCodeException
{
    public function __construct($message)
    {
        parent::__construct($message, $code = 400);
    }
}