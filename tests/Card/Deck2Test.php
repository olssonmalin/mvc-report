<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * testcalss for Deck class
 */
class Deck2ObjectTest extends TestCase
{
    /**
     * Confirms that Deck object created
     */
    public function testDeck2ObjectCreate()
    {
        $deck = new Deck2(Card::class);
        $this->assertInstanceOf("\App\Card\Deck2", $deck);
    }

    /**
     * Confirm that full deck of 54 cards
     */
    public function testDeck2Count()
    {   
        $deck = new Deck2(Card::class);
        $this->assertInstanceOf("\App\Card\Deck2", $deck);

        $excNumber = 54;

        $this->assertEquals($deck->getLen(), $excNumber);
    }
}