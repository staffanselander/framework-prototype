<?php


namespace Selander\Framework\Http;


use Selander\Framework\Support\GlobalVars;

class HeadersFactory
{
    /**
     * Create a Headers instance from PHP $_SERVER structure.
     *
     * @param GlobalVars $globalVars
     * @return HeadersInterface
     */
    public function createFromGlobalVars(GlobalVars $globalVars): HeadersInterface
    {
        $headers = [];

        foreach ($globalVars->server as $key => $value) {
            if (!self::isHeader($key)) {
                continue;
            }

            $headers[self::formatHeaderName($key)] = $value;
        }

        return new Headers($headers);
    }

    /**
     * @param string $key
     * @return bool
     */
    private function isHeader(string $key): bool
    {
        return substr($key, 0, 5) === 'HTTP_';
    }

    /**
     * @param string $key
     * @return string
     */
    private function formatHeaderName(string $key): string
    {
        // HTTP_CONTENT_TYPE becomes CONTENT_TYPE
        $key = substr($key, 5);

        // CONTENT_TYPE becomes CONTENT-TYPE
        $key = str_replace('_', '-', $key);

        // CONTENT-TYPE becomes Content-Type
        return mb_convert_case($key, MB_CASE_TITLE, 'utf-8');
    }
}
