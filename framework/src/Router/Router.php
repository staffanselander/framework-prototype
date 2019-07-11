<?php


namespace Selander\Framework\Router;

use Selander\Framework\Http\RequestInterface;
use Selander\Framework\Router\Exceptions\PathNotFoundException;

class Router implements RouterInterface
{
    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * @var RouteDefinitions
     */
    private $routeDefinitions;

    /**
     * Router constructor.
     * @param RequestInterface $request
     * @param RouteDefinitions $routeDefinitions
     */
    public function __construct(
        RequestInterface $request,
        RouteDefinitions $routeDefinitions
    ) {
        $this->request = $request;
        $this->routeDefinitions = $routeDefinitions;
    }

    /**
     * @param string $method
     * @param string $pathArgument
     * @return RouteInterface
     * @throws PathNotFoundException
     * @throws \ReflectionException
     */
    public function parse(string $method, string $pathArgument): RouteInterface
    {
        $path = new Path($pathArgument);

        foreach ($this->routeDefinitions->all() as $definition) {
            if ($definition->method() !== $method) {
                continue;
            }

            $pathMatcher = new PathMatcher(
                $definitionPath = new Path($definition->path()),
                $path
            );

            if ($pathMatcher->isAccepted()) {
                $wildcards = Wildcard::extract($definitionPath, $path);

                return new Route($definition, $path, $wildcards);
            }
        }

        throw new PathNotFoundException();
    }
}
