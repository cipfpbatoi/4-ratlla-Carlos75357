<?php
namespace Joc4enRatlla\Controllers;

use Joc4enRatlla\Exceptions\IllegalMoveException;
use Joc4enRatlla\Models\Player;
use Joc4enRatlla\Models\Game;
use Joc4enRatlla\Services\Logger;

/**
 * Controlador para el juego.
 */
class GameController
{
    /**
     * El juego.
     * @var Game
     */
    private Game $game;

// Request és l'array $_POST

/**
 * Constructor de la clase GameController.
 *
 * @param array|null $request
 */
public function __construct($request=null)
{
    if (!isset($_SESSION['game'])) {
        $jugador1 = new Player($request['name'], $request['color']);
        $jugador2 = new Player('La máquina', '#808080', true);
        $this->game = new Game($jugador1, $jugador2);
        $this->game->save();
    } else {
        $this->game = Game::restore();
    }

    // Inicialització del joc
    $this->play($request);
}

    /**
     * Gestiona el juego.
     * 
     * @param array $request parámetros de la petición HTTP.
     * 
     * @return void
     */
public function play(Array $request)  
{
    $mensajeError = '';
    // Gestió del joc

    if (isset($request['reset'])) {
        $this->game->reset();
        $this->game->save();
        Logger::getLogger()->info('Se ha reiniciado el juego');
    }

    if (isset($request['exit'])) {
        Logger::getLogger()->info('Se ha salido del juego');
        unset($_SESSION['game']);
        session_destroy();
        header('Location: index.php');
        exit;
    }

    if (isset($request['save'])) {
        $this->game->save();
    }

    if ($this->game->getBoard()->isFull()) {
        $mensajeError = 'El tablero ya esta lleno. Por favor, elija una columna diferente';
    } else {
        if (!$this->game->getWinner() && isset($request['columna']) && !$this->game->getPlayerO()->getIsAutomatic()) { // Solo jugar si no hay un ganador
            try {
                $this->game->play($request['columna']);
            } catch (IllegalMoveException $e) {
                $mensajeError = $e->getMessage();
            }
        }

        if ($this->game->getPlayerO()->getIsAutomatic() && ! $this->game->getWinner()) {
            $this->game->playAutomatic();
        }
    }

    $board = $this->game->getBoard();
    $players = $this->game->getPlayers();
    $winner = $this->game->getWinner();
    $scores = $this->game->getScores();

    loadView('index',compact('board','players','winner','scores','mensajeError'));
}
}

