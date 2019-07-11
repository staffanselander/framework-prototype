<?php


namespace Selander\DemoApp\Modules;


use Selander\DemoApp\AppConfig;
use Selander\Framework\Container\ContainerInterface;
use Selander\Framework\Core\CoreConfigInterface;
use Selander\Framework\Core\CoreModuleInterface;
use Selander\Framework\Database\Configs\MysqlConfig;
use Selander\Framework\Database\ConnectionConfigInterface;
use Selander\Framework\Database\MigrationConfig;

class DatabaseModule implements CoreModuleInterface
{
    /**
     * @var CoreConfigInterface
     */
    private $coreConfig;

    /**
     * @var ContainerInterface
     */
    private $container;

    /**
     * DatabaseModule constructor.
     * @param CoreConfigInterface $coreConfig
     * @param ContainerInterface $container
     */
    public function __construct(
        CoreConfigInterface $coreConfig,
        ContainerInterface $container
    ) {
        $this->coreConfig = $coreConfig;
        $this->container = $container;
    }

    public function warmUp()
    {
        $this->container->singleton(MigrationConfig::class, function () {
            return new MigrationConfig([
                MigrationConfig::ROOT => __DIR__ . '/../../migrations'
            ]);
        });

        $this->container->singleton(ConnectionConfigInterface::class, function () {
            return new MysqlConfig(
                $this->coreConfig->get(AppConfig::DB_HOST),
                $this->coreConfig->get(AppConfig::DB_DATABASE),
                $this->coreConfig->get(AppConfig::DB_USERNAME),
                $this->coreConfig->get(AppConfig::DB_PASSWORD)
            );
        });
    }

    public function execute()
    {

    }

}
