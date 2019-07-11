<?php


namespace Selander\Framework\Router;


interface MethodReferenceInterface
{
    public function class(): string;
    public function method(): string;
}
