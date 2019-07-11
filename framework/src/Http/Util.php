<?php


namespace Selander\Framework\Http;


abstract class Util
{
    public static function isHttps(array $server): bool
    {
        if (isset($server['HTTPS'])) {
            return strtolower($server['HTTPS']) === 'on' || $server['HTTPS'] === '1';
        }

        if (isset($server['SERVER_PORT'])) {
            return $server['SERVER_PORT'] === '443';
        }

        return false;
    }
}
