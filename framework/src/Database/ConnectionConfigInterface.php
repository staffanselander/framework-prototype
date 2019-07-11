<?php


namespace Selander\Framework\Database;


interface ConnectionConfigInterface
{
    public function dsn(): string;
    public function username(): string;
    public function password(): string;
    public function options(): array;
}
