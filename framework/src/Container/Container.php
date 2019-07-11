<?php

namespace Selander\Framework\Container;

use Closure;
use ReflectionException;
use Selander\Framework\Container\Exceptions\InstructionsNeededException;
use Selander\Framework\Container\Exceptions\UndefinedResolverException;

class Container implements ContainerInterface
{
    /**
     * @var array
     */
    private $factories = [];

    /**
     * @var array
     */
    private $singletons = [];

    /**
     * @param string $id
     * @param Closure $resolver
     * @return ContainerInterface
     */
    public function bind(string $id, Closure $resolver): ContainerInterface
    {
        $this->factories[$id] = $resolver;
        return $this;
    }

    /**
     * @param string $id
     * @param Closure $factory
     * @return ContainerInterface
     */
    public function singleton(string $id, Closure $factory): ContainerInterface
    {
        $this->factories[$id] = $factory;
        $this->singletons[$id] = null;
        return $this;
    }

    /**
     * @param string $id
     * @param $instance
     * @return ContainerInterface
     */
    public function set(string $id, $instance): ContainerInterface
    {
        $this->singletons[$id] = $instance;
        return $this;
    }

    /**
     * @param string $id
     * @return mixed
     * @throws UndefinedResolverException
     */
    public function create(string $id)
    {
        if (!$this->has($id)) {
            throw new UndefinedResolverException(
                sprintf('No factory defined for id "%s"', $id)
            );
        }

        return $this->save($id, $this->factories[$id]($this));
    }

    /**
     * @param string $id
     * @return mixed
     * @throws ReflectionException
     * @throws InstructionsNeededException
     */
    public function resolve(string $id)
    {
        if (!class_exists($id)) {
            throw new InstructionsNeededException(sprintf('Cannot instantiate %s without instructions', $id));
        }

        $dependencies = new Dependencies($id);

        $warmDependencies = array_map(function (string $id) {
            return $this->get($id);
        }, $dependencies->all());

        return $this->save($id, new $id(...$warmDependencies));
    }

    /**
     * @param string $id
     * @return mixed
     * @throws UndefinedResolverException
     */
    public function get(string $id)
    {
        // If singleton instance created return
        if ($singleton = $this->getSingleton($id)) {
            return $singleton;
        }

        // If have factory create and return
        if ($this->hasFactory($id)) {
            return $this->create($id);
        }

        // If not defined resolve and return
        return $this->resolve($id);
    }

    /**
     * @param string $id
     * @return bool
     */
    public function hasFactory(string $id): bool
    {
        return array_key_exists($id, $this->factories);
    }

    /**
     * @param string $id
     * @return mixed|null
     */
    public function getSingleton(string $id)
    {
        if (!array_key_exists($id, $this->singletons)) {
            return null;
        }

        return $this->singletons[$id];
    }

    /**
     * @param string $id
     * @return bool
     */
    public function has(string $id): bool
    {
        return array_key_exists($id, $this->factories);
    }

    /**
     * @param string $id
     * @param $instance
     * @return mixed
     */
    private function save(string $id, $instance)
    {
        if (array_key_exists($id, $this->singletons)) {
            $this->singletons[$id] = $instance;
        }

        return $instance;
    }
}
