<?php


namespace Selander\Framework\Router;


class RouteDefinition implements RouteDefinitionInterface
{
    /**
     * @var string
     */
    private $path;

    /**
     * @var string
     */
    private $method;

    /**
     * @var callable
     */
    private $reference;

    /**
     * Route constructor.
     * @param string $path
     * @param string $method
     * @param MethodReferenceInterface $reference
     */
    public function __construct(string $path, string $method, MethodReferenceInterface $reference)
    {
        $this->path = $path;
        $this->method = $method;
        $this->reference = $reference;
    }

    /**
     * @return string
     */
    public function path(): string
    {
        return $this->path;
    }

    /**
     * @return string
     */
    public function method(): string
    {
        return $this->method;
    }

    /**
     * @return MethodReferenceInterface
     */
    public function reference(): MethodReferenceInterface
    {
        return $this->reference;
    }

}
