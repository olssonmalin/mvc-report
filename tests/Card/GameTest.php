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

        $this->assertEquals($game->getPlayer(), $game->getCurrentPlayer());
    }

    /**
     * Confirms that current player changes to Bank when stand is used
     */
    public function testGameStandChangeCurrentPlayer()
    {
        $game = new Game(Deck::class, Player::class, Card::class);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $game->stand();

        $this->assertEquals($game->getBank(), $game->getCurrentPlayer());
    }

    /**
     * confirms that getPlayer returns a Player-object
     */
    public function testGameGetPlayer()
    {
        $game = new Game(Deck::class, Player::class, Card::class);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $this->assertInstanceOf("\App\Card\Player", $game->getPlayer());
    }

    /**
     * confirms that getPlayer returns a Player-object
     */
    public function testGameGetBank()
    {
        $game = new Game(Deck::class, Player::class, Card::class);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $this->assertInstanceOf("\App\Card\Player", $game->getBank());
    }

    /**
     * Test hit method adds card to player
     * (Not good test since it's depending on other classes methods)
     */
    public function testGameHit()
    {
        $game = new Game(Deck::class, Player::class, Card::class);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $game->hit();

        $this->assertEquals(count($game->getPlayer()->getHand()), 1);
    }

    /**
     * PlayerWon returns true when player score is more than bank score
     */
    public function testGamePlayerWonMoreThanBank()
    {
        $game = new Game(Deck::class, Player::class, Card::class);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $game->hit();
        $this->assertTrue($game->playerWon());
    }

    /**
     * PlayerWon returns False when player score is more than 21
     */
    public function testGamePlayerWonMoreThan21()
    {
        $game = new Game(Deck::class, Player::class, Card::class);
        $this->assertInstanceOf("\App\Card\Game", $game);

        for ($i = 0; $i < 9; $i++) {
            $game->hit();
        }

        $this->assertFalse($game->playerWon());
    }

    /**
     * Confirms bank player has cards after playBank
     */
    public function testGamePlayBank()
    {
        $game = new Game(Deck::class, Player::class, Card::class);
        $this->assertInstanceOf("\App\Card\Game", $game);

        $game->stand();

        $bankHand = $game->getBank()->getHand();

        $this->assertTrue(count($bankHand) > 1);
    }
}