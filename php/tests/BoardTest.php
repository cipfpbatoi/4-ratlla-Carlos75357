<?php

namespace Tests;

use Joc4enRatlla\Models\Board;
use PHPUnit\Framework\TestCase;

class BoardTest extends TestCase
{
    public function testInitialSetup()
    {
        $board = new Board();
        $slots = $board->getSlots();

        // Verifica que todos los slots estén inicializados a 0
        foreach ($slots as $row) {
            foreach ($row as $slot) {
                $this->assertEquals(0, $slot);
            }
        }
    }

    public function testValidMove()
    {
        $board = new Board();
        $board->setMovementOnBoard(1, 1); // Jugador 1 en columna 1
        $this->assertTrue($board->isValidMove(1)); // La columna debe ser válida
    }

    public function testFullBoard()
    {
        $board = new Board();
        for ($i = 1; $i <= Board::COLUMNS; $i++) {
            for ($j = 1; $j <= Board::FILES; $j++) {
                $board->setMovementOnBoard($i, 1); // Rellenamos con el jugador 1
            }
        }

        $this->assertTrue($board->isFull()); // La tabla debería estar llena
    }

}
