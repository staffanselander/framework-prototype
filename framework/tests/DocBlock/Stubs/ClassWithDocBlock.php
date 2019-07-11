<?php


namespace Selander\Framework\Tests\DocBlock\Stubs;


/**
 * Class ClassWithDocBlock
 * @package Selander\Framework\Tests\DocBlock\Stubs
 * @Some\Name("value")
 */
class ClassWithDocBlock
{
    /**
     * @Some\Property\Stat("cool")
     */
    public $one;

    /**
     * @Other\Property\Stat("not_cool")
     */
    public $two;

    /**
     * @Some\Method\Stat("cool")
     */
    public function one()
    {

    }

    /**
     * @Other\Method\Stat("not_cool")
     */
    public function two()
    {

    }
}
