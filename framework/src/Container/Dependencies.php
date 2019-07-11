<?php


namespace Selander\Framework\Container;


use ReflectionClass;
use ReflectionParameter;

class Dependencies
{
    /**
     * @var ReflectionClass
     */
    protected $reflectionClass;

    /**
     * Dependencies constructor.
     * @param string $id
     * @throws \ReflectionException
     */
    public function __construct(string $id)
    {
        $this->reflectionClass = new ReflectionClass($id);
    }

    /**
     * @return array
     */
    public function all(): array
    {
        $dependencies = [];

        foreach ($this->parameters() as $parameter) {
            $dependencies[] = $parameter->getClass()->getName();
        }

        return $dependencies;
    }

    /**
     * @return ReflectionParameter[]
     */
    private function parameters(): array
    {
        if ($constructor = $this->reflectionClass->getConstructor()) {
            return $constructor->getParameters();
        }

        return [];
    }
}
