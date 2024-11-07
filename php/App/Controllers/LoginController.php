<?php

namespace Joc4enRatlla\Controllers;

class LoginController {

    private $user;

    public function __construct($user) {
        $this->user = $user;
    }

    public function login ($username, $password) {
        $user = $this->user->getUserByUsername($username);

        if (!$user) {
            if ($this->user->createUser($username, $password)) {
                $user = $this->user->getUserByUsername($username);
            }
        }
        if ($user && password_verify($password, $user['contrasenya'])) {
            $_SESSION['user_id'] = $user['id'];
            $_SESSION['nom_usuari'] = $user['nom_usuari'];
            return true;
        }
    }
}