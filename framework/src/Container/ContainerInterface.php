<?php

namespace Selander\Framework\Container;

use Closure;

interface ContainerInterface
{
    public function bind(string $id, Closure $resolver): ContainerInterface;
    public function singleton(string $id, Closure $factory): ContainerInterface;

    public function create(string $id);
    public function set(string $id, $instance): ContainerInterface;
    public function has(string $id): bool;
    public function get(string $id);
}
