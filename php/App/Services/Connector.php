<?php

namespace Joc4enRatlla\Services;

class Connector {
    private \PDO $pdo;

    public function __construct($dbConfig) {
        if (isset($_SESSION['connection'])) {
            $this->pdo = unserialize($_SESSION['connection']);
            return;
        }

        try {
            $dsn = "mysql:host={$dbConfig['host']};dbname={$dbConfig['database']}";
            $db = new \PDO($dsn, $dbConfig['user'], $dbConfig['password']);
            $db->setAttribute(\PDO::ATTR_ERRMODE, \PDO::ERRMODE_EXCEPTION);
        } catch (\PDOException $e) {
            die($e->getMessage());
        }

        $this->pdo = $db;
    }

    public function getConnection() {
        return $this->pdo;
    }
}