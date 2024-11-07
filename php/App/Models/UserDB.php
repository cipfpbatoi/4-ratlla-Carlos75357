<?php

namespace Joc4enRatlla\Models;

use Joc4enRatlla\Services\Connector;
use \PDO;

class UserDB {
    private $db;

    public function __construct($db) {
        $this->db = $db;
    }

    public function getUserByUsername($username) {
        $query = "SELECT * FROM usuaris WHERE nom_usuari = :username";
        $stmt = $this->db->prepare($query);
        $stmt->execute(['username' => $username]);
        $user = $stmt->fetch(PDO::FETCH_ASSOC);

        return $user;
    }

    public function createUser($username, $password) {
        $query = "INSERT INTO usuaris (nom_usuari, contrasenya) VALUES (:username, :password)";
        $stmt = $this->db->prepare($query);
        $encriptedPassword = password_hash($password, PASSWORD_DEFAULT);
        return $stmt->execute(['username' => $username, 'password' => $encriptedPassword]);
    }
}