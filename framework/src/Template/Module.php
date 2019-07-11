<?php


namespace Selander\Framework\Template;


use Selander\Framework\Container\ContainerInterface;
use Selander\Framework\Core\CoreModuleInterface;

class Module implements CoreModuleInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * TemplateModule constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function warmUp()
    {
        $this->container->singleton(TemplateManagerConfigInterface::class, function () {
            return new TemplateManagerConfig([]);
        });

        $this->container->singleton(TemplateManagerInterface::class, function (ContainerInterface $container) {
            return new TemplateManager(
                $container->get(TemplateManagerConfigInterface::class)
            );
        });
    }

    public function execute()
    {
    }

}
