<?php


namespace Selander\Framework\Validator;


interface RuleInterface
{
    public function check(array $data): CheckInterface;
}
