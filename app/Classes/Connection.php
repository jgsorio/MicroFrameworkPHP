<?php

namespace App\Classes;

use PDO;
use PDOException;
use Exception;
class Connection
{
    private static ?PDO $instance = null;

    /**
     * @throws Exception
     */
    public static function connect(): PDO
    {
        $config = require_once __DIR__ . '/../../config.php';

        try {
            if (!static::$instance) {
                static::$instance = new PDO(
                    "mysql:host={$config['db']['host']};dbname={$config['db']['dbname']}",
                    $config['db']['user'],
                    $config['db']['password'], [
                        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
                        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_OBJ,
                    ]
                );
            }

            return static::$instance;
        } catch (PdoException $e) {
            throw new Exception($e->getMessage());
        }
    }
}
