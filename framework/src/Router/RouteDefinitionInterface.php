<?php


namespace Selander\Framework\Router;


interface RouteDefinitionInterface
{
    public function path(): string;
    public function method(): string;
    public function reference(): MethodReferenceInterface;
}
