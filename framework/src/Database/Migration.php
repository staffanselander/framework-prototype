<?php


namespace Selander\Framework\Database;


class Migration
{
    /**
     * @var string
     */
    public $statement;

    /**
     * Migration constructor.
     * @param string $statement
     */
    public function __construct(string $statement)
    {
        $this->statement = $statement;
    }
}
