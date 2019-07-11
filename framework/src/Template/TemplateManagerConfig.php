<?php


namespace Selander\Framework\Template;


class TemplateManagerConfig implements TemplateManagerConfigInterface
{
    /**
     * @var array
     */
    private $config;

    /**
     * TemplateManagerConfig constructor.
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

    /**
     * @param string $key
     * @param string $value
     * @return TemplateManagerConfigInterface
     */
    public function set(string $key, string $value): TemplateManagerConfigInterface
    {
        $this->config[$key] = $value;
        return $this;
    }
}
