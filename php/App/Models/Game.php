<?php
namespace Joc4enRatlla\Models;

use Joc4enRatlla\Exceptions\IllegalMoveException;
use Joc4enRatlla\Models\Board;
use Joc4enRatlla\Models\Player;
use Joc4enRatlla\Services\Logger;

/**
 * Class Game
 * @package Joc4enRatlla\Models
 */
class Game
{
    /**
     * @var Board
     */
    private Board $board;
    /**
     * @var int
     */
    private int $nextPlayer;
    /**
     * @var array
     */
    private array $players;
    /**
     * @var ?Player
     */
    private ?Player $winner;
    /**
     * @var array
     */
    private array $scores = [1 => 0, 2 => 0];

    /**
     * Summary of logger
     * @var Logger
     */
    private Logger $logger;

    /**
     * Game constructor.
     * @param Player $jugador1
     * @param Player $jugador2
     */
    public function __construct( Player $jugador1, Player $jugador2) {
        $this->board = new Board();
        $this->nextPlayer = random_int(1, 2);
        $this->players = [1 => $jugador1,2 => $jugador2];
        $this->winner = null;

        Logger::getLogger()->info("Nueva partida iniciada entre {$jugador1->getName()} y {$jugador2->getName()}");
    }

    /**
     * @return Player
     */
    public function getPlayerO() {
        return $this->players[$this->getNextPlayer()];
    }

    /**
     * @return Board
     */
    public function getBoard(): Board {
        return $this->board;
    }

    /**
     * @param Board $board
     */
    public function setBoard(Board $board): void {
        $this->board = $board;
    }

    /**
     * @return int
     */
    public function getNextPlayer(): int {
        return $this->nextPlayer;
    }

    /**
     * @param int $nextPlayer
     */
    public function setNextPlayer(int $nextPlayer): void {
        $this->nextPlayer = $nextPlayer;
    }

    /**
     * @return array
     */
    public function getPlayers(): array {
        return $this->players;
    }

    /**
     * @param array $players
     */
    public function setPlayers(array $players): void {
        $this->players = $players;
    }

    /**
     * @return Player|null
     */
    public function getWinner(): ?Player {
        return $this->winner;
    }

    /**
     * @param bool $winner
     */
    public function setWinner(bool $winner): void {
        $this->winner = $winner;
    }

    /**
     * @return array
     */
    public function getScores(): array {
        return $this->scores;
    }

    /**
     * @param array $scores
     */
    public function setScores(array $scores): void {
        $this->scores = $scores;
    }

    /**
     * Reinicia el joc
     */
    public function reset(): void {
        $this->winner = null;
        $this->board = new Board();
        $this->nextPlayer = random_int(1, 2);
    }

    /**
     * Realitza un moviment
     * @param $columna
     * @throws \Exception
     */
    public function play($columna) {
        if (!$this->board->isValidMove($columna)) {
            throw new IllegalMoveException('Columna no valida');
        }
        Logger::getLogger()->info("El jugador {$this->nextPlayer} hace un movimiento en la columna {$columna}");

        $coord = $this->board->setMovementOnBoard($columna, $this->nextPlayer);
        if ($this->board->checkWin($coord)) {
            $this->winner = $this->players[$this->nextPlayer];
            $this->scores[$this->nextPlayer]++;
            Logger::getLogger()->info("El jugador {$this->nextPlayer} ha ganado la partida");
        } else {
            $this->nextPlayer = ($this->nextPlayer == 1) ? 2 : 1;
        }
        $this->save();
    }

    /**
     * Juga automat
     */
    public function playAutomatic(){
        $opponent = $this->nextPlayer === 1 ? 2 : 1;
        Logger::getLogger()->info("El jugador automático {$this->nextPlayer} hace un movimiento");
        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $tempBoard = clone($this->board);
                $coord = $tempBoard->setMovementOnBoard($col, $this->nextPlayer);

                if ($tempBoard->checkWin($coord)) {
                    $this->play($col);
                    return;
                }
            }
        }

        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $tempBoard = clone($this->board);
                $coord = $tempBoard->setMovementOnBoard($col, $opponent);
                if ($tempBoard->checkWin($coord )) {
                    $this->play($col);
                    return;
                }
            }
        }

        $possibles = array();
        for ($col = 1; $col <= Board::COLUMNS; $col++) {
            if ($this->board->isValidMove($col)) {
                $possibles[] = $col;
            }
        }
        if (count($possibles)>2) {
            $random = rand(-1,1);
        }
        $middle = (int) (count($possibles) / 2)+$random;
        $inthemiddle = $possibles[$middle];
        $this->play($inthemiddle);
    }

    /**
     * Guarda l'estat del joc a les sessions
     */
    public function save() {
        $_SESSION['game'] = serialize($this);
    }

    public function saveGame($db) {
        try {
            $user_id = $_SESSION['user_id'];
            $game = $_SESSION['game'];
    
            $sql = "INSERT INTO partides (usuari_id, game) VALUES (?, ?) ON DUPLICATE KEY UPDATE game = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$user_id, $game, $game]);
            Logger::getLogger()->info('Se ha guardado el juego');
        } catch (\Exception $e) {
            Logger::getLogger()->error('Error al guardar el juego: ' . $e->getMessage());
            throw $e;
        }
        
    }

    /**
     * Restaura l'estat del joc de les sessions
     * @return Game|null
     */
    public static function restore() {
        if (isset($_SESSION['game'])) {
            return unserialize($_SESSION['game'],[Game::class]);            
        }
        return null;
    }

    public static function restoreGame($db) {
        try {
            $user_id = $_SESSION['user_id'];
            $sql = "SELECT * FROM partides WHERE usuari_id = ?";
            $stmt = $db->prepare($sql);
            $stmt->execute([$user_id]);
            $game = $stmt->fetch();
            Logger::getLogger()->info('Se ha recuperado el juego');

            return unserialize($game['game'],[Game::class]);
        } catch (\Exception $e) {
            Logger::getLogger()->error('Error al recuperar el juego: ' . $e->getMessage());
            throw $e;
        }
    }

}
