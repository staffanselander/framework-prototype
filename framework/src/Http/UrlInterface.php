<?php


namespace Selander\Framework\Http;


/**
 * Interface UrlInterface
 * scheme:[//userInfo]path[?query][#fragment]
 *
 * @link https://en.wikipedia.org/wiki/URL
 */
interface UrlInterface
{
    const SCHEME_HTTP = 'http';
    const SCHEME_HTTPS = 'https';

    public function scheme(): string;
    public function userInfo(): string;
    public function host(): string;
    public function port(): int;
    public function path(): string;
    public function query(): string;
    public function fragment(): string;
    public function toString(): string;
}
