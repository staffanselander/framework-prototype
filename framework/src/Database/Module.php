<?php


namespace Selander\Framework\Database;


use Selander\Framework\Container\ContainerInterface;
use Selander\Framework\Core\CoreModuleInterface;

class Module implements CoreModuleInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function warmUp()
    {
        $this->container->singleton(RepositoryFactoryInterface::class, function (ContainerInterface $container) {
            return new RepositoryFactory(
                $container->get(ConnectionConfigInterface::class)
            );
        });
    }

    public function execute()
    {
    }
}
