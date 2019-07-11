<?php


namespace Selander\Framework\Database;


use Selander\Framework\DocBlock\DocClass;

class RepositoryFactory implements RepositoryFactoryInterface
{
    /**
     * @var ConnectionConfigInterface
     */
    private $connectionConfig;

    public function __construct(ConnectionConfigInterface $connectionConfig)
    {
        $this->connectionConfig = $connectionConfig;
    }

    public function create($model): RepositoryInterface
    {
        return new Repository(
            new Connection($this->connectionConfig),
            new ObjectContext(new DocClass($model))
        );
    }
}
