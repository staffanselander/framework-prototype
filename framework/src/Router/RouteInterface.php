<?php


namespace Selander\Framework\Router;


interface RouteInterface
{
    public function definition(): RouteDefinitionInterface;
    public function path(): PathInterface;
    public function wildcards(): array;
    public function wildcard(string $key, string $default = ''): string;
}
