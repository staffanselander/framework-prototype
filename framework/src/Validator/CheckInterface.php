<?php


namespace Selander\Framework\Validator;


interface CheckInterface
{
    public function failed(): bool;
    public function errorMessage(): string;
}
