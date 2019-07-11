<?php


namespace Selander\Framework\Database;


class SqlInsertBuilder
{
    /**
     * @var
     */
    private $table;

    /**
     * @var array
     */
    private $data = [];

    /**
     * InsertBuilder constructor.
     * @param string $table
     */
    public function __construct(string $table)
    {
        $this->table = $table;
    }

    /**
     * @param string $table
     * @return SqlInsertBuilder
     */
    public static function create(string $table): SqlInsertBuilder
    {
        return new SqlInsertBuilder($table);
    }

    /**
     * @param string $name
     * @return string
     */
    public function table(string $name): string
    {
        return $this->table;
    }

    /**
     * @param $name
     * @param $value
     * @return SqlInsertBuilder
     */
    public function column(string $name, $value): SqlInsertBuilder
    {
        $this->data[$name] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function query(): string
    {
        return sprintf('insert into %s (%s) values (%s)',
            $this->table,
            join(', ', array_keys($this->data)),
            join(', ', $this->getPlaceholders())
        );
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return $this->data;
    }

    /**
     * @return array
     */
    private function getPlaceholders(): array
    {
        return array_map(function (string $name) {
            return sprintf(':%s', $name);
        }, array_keys($this->data));
    }
}
