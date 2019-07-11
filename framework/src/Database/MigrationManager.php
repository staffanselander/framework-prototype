<?php


namespace Selander\Framework\Database;


use DirectoryIterator;
use Exception;
use Selander\Framework\Database\Exceptions\MigrationOperationException;

class MigrationManager
{
    /**
     * @var MigrationConfig
     */
    private $migrationConfig;

    /**
     * @var Connection
     */
    private $connection;

    /**
     * MigrationManager constructor.
     * @param MigrationConfig $migrationConfig
     * @param Connection $connection
     */
    public function __construct(
        MigrationConfig $migrationConfig,
        Connection $connection
    ) {
        $this->migrationConfig = $migrationConfig;
        $this->connection = $connection;
    }

    /**
     * @return Migration[]
     */
    public function getMigrations(): array
    {
        $migrations = [];

        foreach ($this->getRootDirectory() as $fileInfo) {
            if ($fileInfo->isDot()) {
                continue;
            }

            $migrations[] = new Migration(
                file_get_contents($fileInfo->getPathname())
            );
        }

        return $migrations;
    }

    /**
     * @throws Exception
     */
    public function run()
    {
        foreach ($this->getMigrations() as $migration) {
            $this->migrate($migration);
        }
    }

    /**
     * @param Migration $migration
     * @throws Exception
     */
    public function migrate(Migration $migration)
    {
        $pdo = $this->connection->pdo();

        $pdo->beginTransaction();

        try {
            $wasCompleted = $pdo->exec($migration);

            if (!$wasCompleted) {
                throw new MigrationOperationException(join(' ', $pdo->errorInfo()));
            }
        }
        catch (Exception $exception) {
            $pdo->rollBack();

            throw $exception;
        }
    }

    /**
     * @return DirectoryIterator
     */
    private function getRootDirectory(): DirectoryIterator
    {
        return $directoryIterator = new DirectoryIterator(
            $this->migrationConfig->get(MigrationConfig::ROOT)
        );
    }
}
