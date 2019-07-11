<?php


namespace Selander\Framework\Router;


class Route implements RouteInterface
{
    /**
     * @var RouteDefinitionInterface
     */
    private $definition;

    /**
     * @var PathInterface
     */
    private $path;

    /**
     * @var array
     */
    private $wildcards;

    /**
     * Route constructor.
     * @param RouteDefinitionInterface $definition
     * @param PathInterface $path
     * @param array $wildcards
     */
    public function __construct(RouteDefinitionInterface $definition, PathInterface $path, array $wildcards)
    {
        $this->definition = $definition;
        $this->path = $path;
        $this->wildcards = $wildcards;
    }

    /**
     * @return RouteDefinitionInterface
     */
    public function definition(): RouteDefinitionInterface
    {
        return $this->definition;
    }

    /**
     * @return PathInterface
     */
    public function path(): PathInterface
    {
        return $this->path;
    }

    /**
     * @return array
     */
    public function wildcards(): array
    {
        return $this->wildcards;
    }

    /**
     * @param string $key
     * @param string $default
     * @return string
     */
    public function wildcard(string $key, string $default = ''): string
    {
        if (array_key_exists($key, $this->wildcards)) {
            return $this->wildcards[$key];
        }

        return $default;
    }

}
