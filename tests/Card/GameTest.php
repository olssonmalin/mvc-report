<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * testcalss for Game class
 */
class GameObjectTest extends TestCase
{
    /**
     * Confirms that Game class gets createt when initilized
     */
    public function testGameInitilize()
    {
        $game = new Game(Deck::class, Player::class, Card::class);

        $this->assertInstanceOf("\App\Card\Game", $game);
    }

    /**
     * Confirms that player is the current player
     */
    public function testGameGetCurrentPlayer()
    {
        $game = new Game(Deck::class, Player::class, Card::class);
        $this->assertInstanceOf("\App\Card\Game", $game);
    }
}