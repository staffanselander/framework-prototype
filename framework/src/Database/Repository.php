<?php


namespace Selander\Framework\Database;


use PDOStatement;
use Selander\Framework\Database\Exceptions\NotFoundException;

class Repository implements RepositoryInterface
{
    /**
     * @var Connection
     */
    private $connection;

    /**
     * @var ObjectContext
     */
    private $context;

    public function __construct(Connection $connection, ObjectContext $context)
    {
        $this->connection = $connection;
        $this->context = $context;
    }

    /**
     * @return array
     */
    public function get()
    {
        $builder = SqlSelectBuilder::create($this->context->table());
        $statement = $this->execute($builder->query(), $builder->data());

        return array_map(function (array $properties) {
            return ObjectFactory::createFromObjectContext($this->context, $properties);
        }, $statement->fetchAll());
    }

    /**
     * @param $id
     * @return mixed
     * @throws NotFoundException
     */
    public function find($id)
    {
        $builder = SqlSelectBuilder::create($this->context->table())
            ->where($this->context->primaryKey(), $id);

        $result = $this->execute($builder->query(), $builder->data())->fetch();
        if (!$result) {
            throw new NotFoundException($this->context->class());
        }

        return ObjectFactory::createFromObjectContext($this->context, $result);
    }

    /**
     * @param $model
     */
    public function update($model)
    {
        // TODO: Implement update() method.
    }

    /**
     * @param $model
     */
    public function create($model)
    {
        $insertBuilder = SqlInsertBuilder::create($this->context->table());

        foreach ($this->context->properties() as $property) {
            if ($property->autoIncrements()) {
                continue;
            }

            $insertBuilder->column($property->column(), $model->{$property->name()});
        }

        $this->execute($insertBuilder->query(), $insertBuilder->data());
    }

    /**
     * @param $model
     */
    public function delete($model)
    {
        // TODO: Implement delete() method.
    }

    /**
     * @param string $query
     * @param array $parameters
     * @return bool|PDOStatement
     */
    protected function execute(string $query, array $parameters)
    {
        $pdo = $this->connection->pdo();
        $statement = $pdo->prepare($query);
        $statement->execute($parameters);
        return $statement;
    }
}
