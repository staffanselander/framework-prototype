<?php


namespace Selander\Framework\Router;


interface RouterInterface
{
    public function parse(string $method, string $pathArgument): RouteInterface;
}
