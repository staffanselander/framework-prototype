<?php


namespace Selander\Framework\Core;


class CoreConfig implements CoreConfigInterface
{
    /**
     * @var array
     */
    private $data;

    /**
     * CoreConfig constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->data = $data;
    }

    /**
     * @param string $key
     * @return string
     */
    public function get(string $key): string
    {
        return $this->data[$key];
    }

    /**
     * @param string $key
     * @return bool
     */
    public function has(string $key): bool
    {
        return array_key_exists($key, $this->data);
    }

}
