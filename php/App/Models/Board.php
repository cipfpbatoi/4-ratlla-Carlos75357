<?php
namespace Joc4enRatlla\Models;

use Joc4enRatlla\Exceptions\IllegalMoveException;

/**
 * Class Board
 * @package Joc4enRatlla\Models
 */
class Board
{
    /**
     * Constant que define el número de filas de la graella
     */
    public const FILES = 6;
    /**
     * Constant que define el número de columnas de la graella
     */
    public const COLUMNS = 7;
    /**
     * Constant que define las direcciones a comprobar en la graella
     * @var array
     */
    public const DIRECTIONS = [
        [0, 1],   // Horizontal derecha
        [1, 0],   // Vertical abajo
        [1, 1],   // Diagonal abajo-derecha
        [1, -1]   // Diagonal abajo-izquierda
    ];

    /**
     * Array que contiene la graella
     * @var array
     */
    private array $slots;

    /**
     * Constructor de la clase Board
     */
    public function __construct() {
        $this->slots = self::initializeBoard();
    }

    /**
     * Devuelve el array de slots
     * @return array
     */
    public function getSlots(): array {
        return $this->slots;
    }

    /**
     * Establece el array de slots
     * @param array $slots
     */
    public function setSlots(array $slots): void {
        $this->slots = $slots;
    }

    /**
     * Inicializa la graella con valores vacíos
     * @return array
     */
    private static function initializeBoard(): array {
        $board = [];
        for ($i = 1; $i <= self::FILES; $i++) {
            for ($j = 1; $j <= self::COLUMNS; $j++) {
                $board[$i][$j] = 0;
            }
        }
        return $board;
    } //Inicialitza la graella amb valors buits
    
    /**
     * Realiza un movimento en la graella
     * @param int $column
     * @param int $jugador
     * @return array
     */
    public function setMovementOnBoard(int $column, int $jugador): array {
        if ($column < 1 || $column > self::COLUMNS) {
            throw new IllegalMoveException("Columna fuera de rango");
        }
        $row = -1;
        for ($i = self::FILES; $i > 0; $i--) {
            if ($this->slots[$i][$column] === 0) {
                $this->slots[$i][$column] = $jugador;
                $row = $i;
                break;
            }
        }
        return [$row, $column];
    }
    //Realitza un moviment en la graella

    /**
     * Comprova si hi ha un guanyador
     * @param array $coord
     * @return bool
     */
    public function checkWin(array $coord): bool {
        $x = $coord[0];
        $y = $coord[1];
        $jugador = $this->slots[$x][$y];

        foreach (self::DIRECTIONS as $direction) {
            $count = 1;

            $count += $this->comprovarDireccions($x, $y, $direction, $jugador);
            $count += $this->comprovarDireccions($x, $y, [-$direction[0], -$direction[1]], $jugador);
            if ($count >= 4) {
                return true;
            }
        }
        return false;
    } //Comprova si hi ha un guanyador

    /**
     * Comprova si el moviment és vàlid
     * @param int $column
     * @return bool
     */
    public function isValidMove(int $column): bool {
        return $this->slots[1][$column] === 0;
    } //Comprova si el moviment és vàlid

    /**
     * Comprova si la graella està plena
     * @return bool
     */
    public function isFull(): bool {
        for ($i = 1; $i < self::COLUMNS; $i++) {
            if ($this->slots[$i][$i] === 0) {
                return false;
            }
        }
        return true;
    }

    /**
     * Comprova si hi ha un guanyador en una direcció
     * @param int $x
     * @param int $y
     * @param array $direccions
     * @param int $jugador
     * @return int
     */
    private function comprovarDireccions(int $x, int $y, array $direccions, int $jugador): int {
        $direccioX = $direccions[0];
        $direccioY = $direccions[1];
        $count = 0;
    
        for ($i = 1; $i < 4; $i++) {
            $otrax = $x + $i * $direccioX;
            $otray = $y + $i * $direccioY;
    
            if ($otrax >= 1 && $otrax <= self::FILES && $otray >= 1 && $otray <= self::COLUMNS && $this->slots[$otrax][$otray] === $jugador) {
                $count++;
            } else {
                break;
            }
        }
        return $count;
    }
    
}

