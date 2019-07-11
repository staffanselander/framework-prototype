<?php


namespace Selander\Framework\Validator;


class CheckOk implements CheckInterface
{
    public function failed(): bool
    {
        return false;
    }

    public function errorMessage(): string
    {
        return '';
    }
}
