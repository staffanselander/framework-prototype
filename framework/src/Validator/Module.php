<?php


namespace Selander\Framework\Validator;


use Selander\Framework\Container\ContainerInterface;
use Selander\Framework\Core\CoreModuleInterface;

class Module implements CoreModuleInterface
{
    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * Module constructor.
     * @param ContainerInterface $container
     */
    public function __construct(ContainerInterface $container)
    {
        $this->container = $container;
    }

    public function warmUp()
    {
        $this->container->singleton(ValidatorInterface::class, function () {
            return new Validator();
        });
    }

    public function execute()
    {

    }

}
