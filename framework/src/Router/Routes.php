<?php


namespace Selander\Framework\Router;


class Routes
{
    /**
     * @var RouteDefinition[]
     */
    protected $all = [];

    /**
     * @param array $all
     * @return Routes
     */
    public function set(array $all): Routes
    {
        $this->all = $all;
        return $this;
    }

    /**
     * @param string $definition
     * @return $this
     */
    public function push(string $definition)
    {
        $this->all[] = $definition;
        return $this;
    }

    /**
     * @return RouteDefinition[]
     */
    public function all(): array
    {
        return $this->all;
    }
}
