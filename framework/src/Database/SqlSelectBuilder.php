<?php


namespace Selander\Framework\Database;


class SqlSelectBuilder
{
    /**
     * @var
     */
    private $table;

    /**
     * @var array
     */
    private $where = [];

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
     * @return SqlSelectBuilder
     */
    public static function create(string $table): SqlSelectBuilder
    {
        return new SqlSelectBuilder($table);
    }

    /**
     * @return string
     */
    public function table(): string
    {
        return $this->table;
    }

    /**
     * @param string $key
     * @param string $value
     * @return SqlSelectBuilder
     */
    public function where(string $key, string $value): SqlSelectBuilder
    {
        $this->where[$key] = $value;
        return $this;
    }

    /**
     * @return string
     */
    public function query(): string
    {
        return join(' ', [
            sprintf('select * from %s', $this->table),
            $this->getWherePart(),
        ]);
    }

    /**
     * @return array
     */
    public function data(): array
    {
        return $this->where;
    }

    /**
     * @return string
     */
    private function getWherePart(): string
    {
        if (empty($this->where)) {
            return '';
        }

        $where = array_map(function(string $key) {
            return sprintf('%s = :%s', $key, $key);
        }, array_keys($this->where));

        return sprintf('where %s', join($where, ', '));
    }
}
