<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * Test class for Player class
 */
class TestPlayerObject extends TestCase
{
    /**
     * Confirms instance of card is created
     *
     */
    public function testPlayerObjectInstance()
    {
        $player = new Player();

        $this->assertInstanceOf("\App\Card\Player", $player);
    }

    /**
     * Confirms GetHand returns an empty array
     *
     */
    public function testGetHandEmpty()
    {
        $player = new Player();
        
        $this->assertInstanceOf("\App\Card\Player", $player);
        $this->assertIsArray($player->getHand());
        $this->assertEquals(count($player->getHand()), 0);
    }

    /**
     * Confirms addCard adds a card to hand
     */
    public function testAddCard()
    {
        $player = new Player();
        $this->assertInstanceOf("\App\Card\Player", $player);

        $player->addCard();

        $this->assertEquals(count($player->getHand()), 1);
    }

    /**
     * Confirm that getScore returns 0 when no card is added to hand
     */
    public function testGetScoreZero()
    {
        $player = new Player();
        $this->assertInstanceOf("\App\Card\Player", $player);


        $this->assertEquals($player->getScore(), 0);
    }

    /**
     * Confirm that getScore returns correct score when card is added to hand
     */
    public function testGetScore()
    {
        $player = new Player();
        $this->assertInstanceOf("\App\Card\Player", $player);

        $score = 14;
        $card = new Card("&hearts;", 14);
        $player->addCard([$card]);

        $this->assertEquals($player->getScore(), 14);
    }
}