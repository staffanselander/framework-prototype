<?php


namespace Selander\Framework\Router;


interface PathInterface
{
    public function parts(): array;
    public function part(int $index): string;
    public function size(): int;
    public function toString(): string;
}
