<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * testcalss for Deck class
 */
class DeckObjectTest extends TestCase
{
    /**
     * Confirms that Deck object created
     */
    public function testDeckObjectCreate()
    {
        $deck = new Deck(Card::class);
        $this->assertInstanceOf("\App\Card\Deck", $deck);
    }

    /**
     * Confirms correct number of cards in full deck
     */
    public function testDeckCardAmountFull()
    {
        $deck = new Deck(Card::class);
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $excpectedNumber = 52;
        $this->assertEquals($deck->getLen(), $excpectedNumber);
    }

    /**
     * Confirms one card get drawn
     */
    public function testDeckDrawNoArg()
    {
        $deck = new Deck(Card::class);
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $excpectedNumber = 1;
        $this->assertEquals(count($deck->draw()), $excpectedNumber);
    }

    /**
     * Confirms that correct number of cards gets drawn
     */
    public function testDeckDrawWithArg()
    {
        $deck = new Deck(Card::class);
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $number = 5;
        $this->assertEquals(count($deck->draw(5)), $number);
    }

    /**
     * Confirms that draw returns cards
     */
    public function testDeckDraw()
    {
        $deck = new Deck(Card::class);
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $array = $deck->draw(5);
        $this->assertIsArray($array);
        $this->assertInstanceOf("\App\Card\Card", $array[0]);

    }

    /**
     * Confirms that draw raises Exception when no more cards in deck
     */
    public function testDeckDrawException()
    {
        $deck = new Deck(Card::class);
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $allCards = $deck->draw(52);

        $this->expectException("\App\Card\DeckTooSmallException");
        $deck->draw(1);
    }

    /**
     * Confirms that getLastDrawn returns the correct array
     */
    public function testDeckGetLastDrawn()
    {
        $deck = new Deck(Card::class);
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $drawn = $deck->draw(5);

        $this->assertEquals($deck->getLastDrawn(), $drawn);
    }

    /**
     * Confirms that deck gets shuffled
     */
    public function testDeckShuffle()
    {
        $deck = new Deck(Card::class);
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $shuffledDeck = new Deck(Card::class);
        $shuffledDeck->shuffle();

        $this->assertNotEquals($shuffledDeck, $deck);
    }

    /**
     * Confirm that toString method returns an array of arrays containing
     * keys for value and suit
     */
    public function testDeckToString()
    {
        $deck = new Deck(Card::class);
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $this->assertIsArray($deck->toString());
        $this->assertIsArray($deck->toString()[0]);
        $this->assertArrayHasKey('value', $deck->toString()[0]);
        $this->assertArrayHasKey('suit', $deck->toString()[0]);
    }

    /**
     * Confirm that getDeck returns an Array of Card-objects
     */
    public function testDeckGetDeck()
    {
        $deck = new Deck(Card::class);
        $this->assertInstanceOf("\App\Card\Deck", $deck);

        $this->assertIsArray($deck->getDeck());
        foreach ($deck->getDeck() as &$card)
        {
            $this->assertInstanceOf("\App\Card\Card", $card);
        }
    }

    
} 