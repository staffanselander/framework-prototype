<?php


namespace Selander\Framework\Database;


use PDO;

class Connection
{
    /**
     * @var ConnectionConfigInterface
     */
    private $connectionConfig;

    /**
     * @var
     */
    private $pdo;

    /**
     * @var array
     */
    private $options = [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    ];

    /**
     * Connection constructor.
     * @param ConnectionConfigInterface $connectionConfig
     */
    public function __construct(ConnectionConfigInterface $connectionConfig)
    {
        $this->connectionConfig = $connectionConfig;
    }

    /**
     * @return PDO
     */
    public function pdo(): PDO
    {
        if (is_null($this->pdo))
        {
            $this->pdo = new PDO(
                $this->connectionConfig->dsn(),
                $this->connectionConfig->username(),
                $this->connectionConfig->password(),
                $this->options
            );
        }

        return $this->pdo;
    }
}
