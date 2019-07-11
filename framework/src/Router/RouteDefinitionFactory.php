<?php


namespace Selander\Framework\Router;


use Selander\Framework\DocBlock\DocItemInterface;

abstract class RouteDefinitionFactory
{
    public static function createFromDocItem(string $class, DocItemInterface $method): RouteDefinition
    {
        return new RouteDefinition(
            $method->doc('Route\Path'),
            $method->doc('Route\Method'),
            new MethodReference($class, $method->name())
        );
    }
}
