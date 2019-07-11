<?php


namespace Selander\Framework\Router;

use ReflectionException;
use Selander\Framework\DocBlock\DocClass;

class RouteDefinitions
{
    /**
     * @var Routes
     */
    private $routes;

    /**
     * RouterDefinitions constructor.
     * @param Routes $routes
     */
    public function __construct(Routes $routes)
    {
        $this->routes = $routes;
    }

    /**
     * @return RouteDefinition[]
     * @throws ReflectionException
     */
    public function all(): array
    {
        $definitions = [];

        foreach ($this->routes->all() as $class) {
            $docClass = new DocClass($class);

            foreach ($docClass->methods() as $docMethod) {
                $definitions[] = RouteDefinitionFactory::createFromDocItem($docClass->name(), $docMethod);
            }
        }

        return $definitions;
    }
}
