<?php


namespace Selander\Framework\Database;


class MigrationConfig
{
    const ROOT = 'root';

    /**
     * @var array
     */
    private $config;

    /**
     * MigrationConfig constructor.
     * @param array $config
     */
    public function __construct(array $config)
    {
        $this->config = $config;
    }

    /**
     * @param string $key
     * @return string
     */
    public function get(string $key): string
    {
        return $this->config[$key];
    }
}
