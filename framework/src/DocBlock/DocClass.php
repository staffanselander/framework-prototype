<?php


namespace Selander\Framework\DocBlock;

use ReflectionException;
use ReflectionClass;
use ReflectionMethod;
use ReflectionProperty;

class DocClass implements DocClassInterface
{
    /**
     * @var ReflectionClass
     */
    protected $reflection;

    /**
     * DocClass constructor.
     * @param string $class
     * @throws ReflectionException
     */
    public function __construct(string $class)
    {
        $this->reflection = new ReflectionClass($class);
    }

    /**
     * @return string
     */
    public function name(): string
    {
        return $this->reflection->getName();
    }

    /**
     * @param string $name
     * @param string $default
     * @return string
     */
    public function doc(string $name, string $default = ''): string
    {
        return Doc::get($this->reflection->getDocComment(), $name, $default);
    }

    /**
     * @return DocItemInterface[]
     */
    public function properties(): array
    {
        return array_map(function (ReflectionProperty $property) {
            return DocItemFactory::createFromReflectionProperty($property);
        }, $this->reflection->getProperties());
    }

    /**
     * @return DocItemInterface[]
     */
    public function methods(): array
    {
        return array_map(function (ReflectionMethod $method) {
            return DocItemFactory::createFromReflectionMethod($method);
        }, $this->reflection->getMethods());
    }
}
