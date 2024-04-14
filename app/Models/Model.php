<?php

namespace App\Models;

use App\Classes\Connection;
use App\Interfaces\ModelInterface;
use PDO;
use ReflectionClass;

abstract class Model implements ModelInterface
{
    protected string $table;
    protected PDO $connection;

    /**
     * @throws \Exception
     */
    public function __construct()
    {
        $this->connection = Connection::connect();
        if (!$this->table) {
            $this->table = (new ReflectionClass($this))->getShortName();
        }
    }

    public function all()
    {
        $sql = "SELECT * FROM {$this->table}";
        $prepare = $this->connection->prepare($sql);
        $prepare->execute();
        return $prepare->fetchAll();
    }

    public function find(string $key, mixed $value): mixed
    {
        $sql = "SELECT * FROM {$this->table} WHERE {$key} = :{$key}";
        $prepare = $this->connection->prepare($sql);
        $prepare->bindValue(":{$key}", $value);
        $prepare->execute();
        return $prepare->fetch();
    }
}