<?php


namespace Selander\Framework\Core;


interface CoreConfigInterface
{
    public function get(string $key): string;
    public function has(string $key): bool;
}
