<?php


namespace Selander\DemoApp\Modules;


use Selander\DemoApp\Controllers\HomeController;
use Selander\DemoApp\Controllers\PostController;
use Selander\Framework\Container\ContainerInterface;
use Selander\Framework\Core\CoreModuleInterface;
use Selander\Framework\Router\RouteDefinitionInterface;
use Selander\Framework\Router\RouteInterface;
use Selander\Framework\Router\Routes;
use Selander\Framework\Template\TemplateManagerConfigInterface;

class HttpModule implements CoreModuleInterface
{
    /**
     * @var TemplateManagerConfigInterface
     */
    private $templateManagerConfig;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var Routes
     */
    private $routes;

    /**
     * AppModule constructor.
     * @param TemplateManagerConfigInterface $templateManagerConfig
     * @param ContainerInterface $container
     * @param Routes $routes
     */
    public function __construct(
        TemplateManagerConfigInterface $templateManagerConfig,
        ContainerInterface $container,
        Routes $routes
    ) {
        $this->templateManagerConfig = $templateManagerConfig;
        $this->container = $container;
        $this->routes = $routes;
    }

    public function warmUp()
    {
        $this->templateManagerConfig->set(TemplateManagerConfigInterface::ROOT, __DIR__ . '/Views');

        $this->routes->set([
            HomeController::class,
            PostController::class
        ]);
    }

    public function execute()
    {
        $reference = $this->getRouteDefinition()
            ->reference();

        $class = $this->container->get($reference->class());
        $class->{$reference->method()}();
    }

    /**
     * @return RouteDefinitionInterface
     */
    private function getRouteDefinition(): RouteDefinitionInterface
    {
        /** @var RouteInterface $route */
        $route = $this->container->get(RouteInterface::class);

        return $route->definition();
    }
}
