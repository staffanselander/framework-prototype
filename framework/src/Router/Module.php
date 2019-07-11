<?php

namespace Selander\Framework\Router;

use Selander\Framework\Container\ContainerInterface;
use Selander\Framework\Core\CoreModuleInterface;
use Selander\Framework\Http\RequestInterface;
use Selander\Framework\Router\Exceptions\PathNotFoundException;

class Module implements CoreModuleInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var RequestInterface
     */
    private $request;

    /**
     * RouterModule constructor.
     * @param ContainerInterface $container
     * @param RequestInterface $request
     */
    public function __construct(
        ContainerInterface $container,
        RequestInterface $request
    ) {
        $this->container = $container;
        $this->request = $request;
    }

    public function warmUp()
    {
        $this->container->singleton(Routes::class, function () {
            return new Routes();
        });

        $this->container->singleton(RouterInterface::class, function (ContainerInterface $container) {
            return $container->get(Router::class);
        });
    }

    public function execute()
    {
        $router = $this->container->get(RouterInterface::class);

        try {
            $route = $router->parse(
                $this->request->method(),
                $this->request->url()->path()
            );

            $this->setRoute($route);
        } catch (PathNotFoundException $exception) {
            $this->setEmptyRoute();
        }
    }

    /**
     * @param RouteInterface $route
     */
    protected function setRoute(RouteInterface $route)
    {
        $this->container->set(RouteInterface::class, $route);
//        $this->container->set(RouteDefinitionInterface::class, $route->definition());
    }

    protected function setEmptyRoute()
    {
//        $this->container->set(RouteInterface::class, null);
//        $this->container->set(RouteDefinitionInterface::class, null);
    }
}
