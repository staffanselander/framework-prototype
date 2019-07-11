<?php


namespace Selander\Framework\Database\Configs;


use Selander\Framework\Database\ConnectionConfigInterface;

class MysqlConfig implements ConnectionConfigInterface
{
    /**
     * @var string
     */
    private $host;

    /**
     * @var string
     */
    private $database;

    /**
     * @var string
     */
    private $username;

    /**
     * @var string
     */
    private $password;

    /**
     * MysqlConfig constructor.
     * @param string $host
     * @param string $database
     * @param string $username
     * @param string $password
     */
    public function __construct(
        string $host,
        string $database,
        string $username,
        string $password
    ) {

        $this->host = $host;
        $this->database = $database;
        $this->username = $username;
        $this->password = $password;
    }

    /**
     * @return string
     */
    public function dsn(): string
    {
        return "mysql:host={$this->host};dbname={$this->database}";
    }

    /**
     * @return string
     */
    public function username(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    public function password(): string
    {
        return $this->password;
    }

    /**
     * @return array
     */
    public function options(): array
    {
        return [];
    }
}
