<?php


namespace Selander\Framework\Http;


class Headers implements HeadersInterface
{
    /**
     * @var array
     */
    private $headers;

    /**
     * Headers constructor.
     * @param array $headers
     */
    public function __construct(array $headers)
    {
        $this->headers = $headers;
    }

    /**
     * @return array
     */
    public function all(): array
    {
        return $this->headers;
    }

    /**
     * @param string $name
     * @return string
     */
    public function get(string $name): string
    {
        return $this->headers[$name];
    }

    /**
     * @param string $name
     * @return bool
     */
    public function has(string $name): bool
    {
        return array_key_exists($name, $this->headers);
    }

}
