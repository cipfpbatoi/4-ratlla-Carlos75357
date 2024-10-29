<?php

namespace Tests;

use Joc4enRatlla\Models\Board;
use Joc4enRatlla\Models\Game;
use Joc4enRatlla\Models\Player;
use PHPUnit\Framework\TestCase;

class GameTest extends TestCase
{
    private $game;

    protected function setUp(): void
    {
        $player1 = new Player("Jugador 1", 1);
        $player2 = new Player("Jugador 2", 2);
        $this->game = new Game($player1, $player2);
    }

    public function testInitialSetup()
    {
        $this->assertNotNull($this->game->getBoard());
        $this->assertCount(2, $this->game->getPlayers());
        $this->assertNull($this->game->getWinner());
    }

    public function testPlayValidMove()
    {
        $this->game->play(1); // Jugador 1 juega en columna 1
        $this->assertEquals(1, $this->game->getBoard()->getSlots()[5][1]); // Verifica la posición
    }

    public function testDetectWinner()
    {
        // Simula una serie de movimientos que resulten en una victoria
        $this->game->play(1);
        $this->game->play(2);
        $this->game->play(1);
        $this->game->play(2);
        $this->game->play(1);
        $this->game->play(2);
        $this->game->play(1); // Jugador 1 gana

        $this->assertNotNull($this->game->getWinner());
        $this->assertEquals("Jugador 1", $this->game->getWinner()->getName());
    }

}
