<?php


namespace Selander\Framework\Http;


use Selander\Framework\Support\GlobalVars;

class UrlFactory
{
    /**
     * Create a Url instance from PHP $_SERVER structure.
     *
     * @param GlobalVars $globalVars
     * @return UrlInterface
     */
    public function createFromGlobalVars(GlobalVars $globalVars): UrlInterface
    {
        return new Url(
            Util::isHttps($globalVars->server) ? UrlInterface::SCHEME_HTTPS : UrlInterface::SCHEME_HTTP,
            '',
            $globalVars->server['SERVER_NAME'],
            intval($globalVars->server['SERVER_PORT']),
            $globalVars->server['REQUEST_URI'],
            $globalVars->server['QUERY_STRING'] ?? '',
            ''
        );
    }
}
