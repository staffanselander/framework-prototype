<?php


namespace Selander\Framework\Core;


use Exception;
use Selander\Framework\Container\ContainerInterface;
use Selander\Framework\Core\Exceptions\ModuleRegistrationException;
use Selander\Framework\Support\GlobalVars;

class Core implements CoreInterface
{
    /**
     * @var array
     */
    private $modules = [];

    /**
     * @var CoreModuleInterface[]
     */
    private $warmModules = [];

    /**
     * @var GlobalVars
     */
    private $globalVars;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * @var CoreConfigInterface
     */
    private $coreConfig;

    /**
     * Core constructor.
     * @param GlobalVars $globalVars
     * @param ContainerInterface $container
     * @param CoreConfigInterface $coreConfig
     */
    public function __construct(GlobalVars $globalVars, ContainerInterface $container, CoreConfigInterface $coreConfig)
    {
        $this->globalVars = $globalVars;
        $this->container = $container;
        $this->coreConfig = $coreConfig;

        $this->container->set(GlobalVars::class, $globalVars);
        $this->container->set(ContainerInterface::class, $container);
        $this->container->set(CoreConfigInterface::class, $coreConfig);
    }

    /**
     * @param array $modules
     * @return CoreInterface
     */
    public function modules(array $modules): CoreInterface
    {
        foreach ($modules as $module) {
            $this->modules[] = $module;
        }

        return $this;
    }

    /**
     * @return $this
     * @throws ModuleRegistrationException
     */
    public function run()
    {
        foreach ($this->modules as $module) {
            try {
                /** @var CoreModuleInterface $warmModule */
                $warmModule = $this->container->get($module);
            } catch (Exception $exception) {
                throw new ModuleRegistrationException(sprintf("Could not register %s", $module), 0, $exception);
            }

            $warmModule->warmUp();

            $this->warmModules[] = $warmModule;
        }

        foreach ($this->warmModules as $module) {
            $module->execute();
        }

        return $this;
    }
}
