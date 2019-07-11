<?php


namespace Selander\Framework\Http;


interface HeadersInterface
{
    public function all(): array;
    public function get(string $name): string;
    public function has(string $name): bool;
}
