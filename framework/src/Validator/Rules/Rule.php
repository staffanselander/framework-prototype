<?php


namespace Selander\Framework\Validator\Rules;


use Selander\Framework\Validator\RuleInterface;

abstract class Rule
{
    /**
     * @param string $key
     * @return RuleInterface
     */
    public static function required(string $key): RuleInterface
    {
        return new Required($key);
    }

    /**
     * @param string $key
     * @return RuleInterface
     */
    public static function disallowDigits(string $key): RuleInterface
    {
        return new DisallowDigits($key);
    }

    /**
     * @param string $key
     * @return RuleInterface
     */
    public static function disallowHtml(string $key): RuleInterface
    {
        return new DisallowHtml($key);
    }
}
