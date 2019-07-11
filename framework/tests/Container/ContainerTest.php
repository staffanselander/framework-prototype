<?php

namespace Selander\Framework\Tests\Container;

use PHPUnit\Framework\TestCase;
use Selander\Framework\Container\Container;
use Selander\Framework\Container\ContainerInterface;
use Selander\Framework\Container\Exceptions\UndefinedResolverException;
use stdClass;

class ContainerTest extends TestCase
{
    /**
     * @var ContainerInterface
     */
    protected $container;

    protected function setUp()
    {
        parent::setUp();
        $this->container = new Container();
    }

    /**
     * @test
     */
    public function bind_unbound_returnSelf()
    {
        $this->assertEquals(
            $this->container,
            $this->container->bind(stdClass::class, function () {
            })
        );
    }

    /**
     * @test
     */
    public function singleton_unbound_returnSelf()
    {
        $this->assertEquals(
            $this->container,
            $this->container->bind(stdClass::class, function () {
            })
        );
    }

    /**
     * @test
     */
    public function get_stdClassBounded_returnStdClass()
    {
        $this->container->bind(stdClass::class, function () {
            return new stdClass();
        });

        $this->assertInstanceOf(
            stdClass::class,
            $this->container->get(stdClass::class)
        );
    }

    /**
     * @test
     */
    public function get_stdClassBounded_newInstances()
    {
        $this->container->bind(stdClass::class, function () {
            return new stdClass();
        });

        $this->assertTrue(
            $this->container->get(stdClass::class) !== $this->container->get(stdClass::class)
        );
    }

    /**
     * @test
     */
    public function get_stdClassSingleton_sameInstance()
    {
        $this->container->singleton(stdClass::class, function () {
            return new stdClass();
        });

        $this->assertEquals(
            $this->container->get(stdClass::class),
            $this->container->get(stdClass::class)
        );
    }

    /**
     *
     */
    public function get_stdClassUnbounded_throwException()
    {
        $this->expectException(UndefinedResolverException::class);
        $this->container->get(stdClass::class);
    }

    /**
     * @test
     */
    public function has_stdClassBounded_returnTrue()
    {
        $this->container->bind(stdClass::class, function () {
            return new stdClass();
        });

        $this->assertTrue(
            $this->container->has(stdClass::class)
        );
    }

    /**
     * @test
     */
    public function has_stdClassNotBounded_returnFalse()
    {
        $this->assertFalse(
            $this->container->has(stdClass::class)
        );
    }

    /**
     * @test
     */
    public function has_stdClassSingletonRegistered_returnTrue()
    {
        $this->container->singleton(stdClass::class, function () {
            return new stdClass();
        });

        $this->assertTrue(
            $this->container->has(stdClass::class)
        );
    }

    /**
     * @test
     */
    public function has_stdClassSingletonNotRegistered_returnFalse()
    {
        $this->assertFalse(
            $this->container->has(stdClass::class)
        );
    }

    /**
     * @test
     */
    public function set_stdClass_same()
    {
        $stdClass = new stdClass();
        $stdClass->property = 'value';

        $this->container->set(stdClass::class, $stdClass);
        $this->assertEquals(
            $stdClass,
            $this->container->get(stdClass::class)
        );
    }
}
