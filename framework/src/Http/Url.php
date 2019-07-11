<?php


namespace Selander\Framework\Http;


use InvalidArgumentException;

class Url implements UrlInterface
{
    const PORT_HTTP = 80;
    const PORT_HTTPS = 443;

    /**
     * @var array
     */
    static private $validSchemes = [
        UrlInterface::SCHEME_HTTP,
        UrlInterface::SCHEME_HTTPS,
    ];

    /**
     * @var string
     */
    private $scheme;

    /**
     * @var string
     */
    private $userInfo;

    /**
     * @var string
     */
    private $host;

    /**
     * @var int
     */
    private $port;

    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $query;

    /**
     * @var string
     */
    private $fragment;

    /**
     * Url constructor.
     * @param string $scheme
     * @param string $userInfo
     * @param string $host
     * @param int $port
     * @param string $path
     * @param string $query
     * @param string $fragment
     */
    public function __construct(
        string $scheme,
        string $userInfo,
        string $host,
        int $port,
        string $path,
        string $query,
        string $fragment
    ) {
        if (!in_array($scheme, self::$validSchemes)) {
            throw new InvalidArgumentException(sprintf('$scheme must be on of %s', join(',', self::$validSchemes)));
        }

        if (substr($path, 0, 1) !== '/') {
            throw new InvalidArgumentException('$path must start with /');
        }

        $this->scheme = $scheme;
        $this->userInfo = $userInfo;
        $this->host = $host;
        $this->port = $port;
        $this->path = $path;
        $this->query = $query;
        $this->fragment = $fragment;
    }

    /**
     * @return string
     */
    public function scheme(): string
    {
        return $this->scheme;
    }

    /**
     * @return string
     */
    public function userInfo(): string
    {
        return $this->userInfo;
    }

    /**
     * @return string
     */
    public function host(): string
    {
        return $this->host;
    }

    /**
     * @return int
     */
    public function port(): int
    {
        return $this->port;
    }

    /**
     * @return string
     */
    public function path(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function query(): string
    {
        return $this->query;
    }

    /**
     * @return string
     */
    public function fragment(): string
    {
        return $this->fragment;
    }

    /**
     * @return string
     */
    public function toString(): string
    {
        $url = "{$this->scheme}://";

        // Append userInfo
        if (!empty($this->userInfo)) {
            $url .= "{$this->userInfo}@";
        }

        // Append host
        $url .= $this->host;

        // Append port
        if (!in_array($this->port, [self::PORT_HTTP, self::PORT_HTTPS])) {
            $url .= ":{$this->port}";
        }

        // Append path
        if (!empty($this->path)) {
            $url .= "{$this->path}";
        }

        // Append query
        if (!empty($this->query)) {
            $url .= "?{$this->query}";
        }

        // Append fragment
        if (!empty($this->fragment)) {
            $url .= "#{$this->fragment}";
        }

        return $url;
    }
}
