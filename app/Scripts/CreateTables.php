<?php

namespace App\Scripts;

require_once __DIR__ . '/../../vendor/autoload.php';

use App\Classes\Connection;
use Exception;

class CreateTables
{
    protected \PDO $connection;

    /**
     * @throws Exception
     */
    public function __construct()
    {
        $this->connection = Connection::connect();
        $this->run();
    }

    private function run(): void
    {
        try {
            $this->createUsersTable();
            $this->createPostsTable();
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    private function createUsersTable(): int
    {
        $sql = "CREATE TABLE IF NOT EXISTS users (
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                name VARCHAR(255) NOT NULL,
                email VARCHAR(255) NOT NULL,
                password VARCHAR(255) NOT NULL,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP)";
        $prepare = $this->connection->query($sql);
        return $prepare->execute();
    }

    private function createPostsTable(): int
    {
        $sql = "CREATE TABLE IF NOT EXISTS posts (
                id INT(11) NOT NULL AUTO_INCREMENT PRIMARY KEY,
                title VARCHAR(255) NOT NULL,
                description VARCHAR(255) NOT NULL,
                user_id INT(11) NOT NULL,
                created_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME NOT NULL DEFAULT CURRENT_TIMESTAMP)";
        $prepare = $this->connection->query($sql);
        return $prepare->execute();
    }

}

new CreateTables();