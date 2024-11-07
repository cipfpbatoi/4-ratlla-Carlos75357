<?php
session_start();
require_once $_SERVER['DOCUMENT_ROOT'] . '/../vendor/autoload.php';
require_once $_SERVER['DOCUMENT_ROOT'] . '/../Helpers/functions.php';

use Joc4enRatlla\Controllers\GameController;
use Joc4enRatlla\Controllers\LoginController;
use Joc4enRatlla\Models\UserDB;
use Joc4enRatlla\Services\Connector;

$dbConfiguration = require $_SERVER['DOCUMENT_ROOT'] . '/../App/config/connection.php';
$connection = new Connector($dbConfiguration);

if (!isset($_SESSION['user_id'])) {
    $user = new UserDB($connection->getConnection());
    $loginController = new LoginController($user);
    $error = '';
    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $username = $_POST['username'];
        $password = $_POST['password'];

        if ($loginController->login($username, $password)) {
            header('Location: index.php');
            exit;
        }

        $error = 'Usuari o contrasenya incorrectes';
    }
    loadView('login', ['error' => $error]);
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $gameController = new GameController($_POST, $connection->getConnection()); 
} else {
    loadView('jugador');
}