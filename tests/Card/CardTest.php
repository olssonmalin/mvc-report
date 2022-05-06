<?php

namespace App\Card;

use PHPUnit\Framework\TestCase;

/**
 * testcalss for Card class
 */
class CardObjectTest extends TestCase
{

    /**
     * Confirms instance of card is created
     *
     * @return void
     */
    public function testCreateCard()
    {   
        $suit = "&hearts;";
        $value = 10;
        $card = new Card($suit, $value);
        $this->assertInstanceOf("\App\Card\Card", $card);
    }

    /**
     * Confirms getSuit returns correct suit of card
     *
     * @return void
     */
    public function testCardGetSuit()
    {
        $suit = "&hearts;";
        $value = 10;
        $card = new Card($suit, $value);
        $this->assertInstanceOf("\App\Card\Card", $card);
        
        $this->assertEquals($card->getSuit(), $suit);
    }

    /**
     * Confirms getValue returns correct value of card
     *
     * @return void
     */
    public function testCardGetValue()
    {
        $suit = "&hearts;";
        $value = 10;
        $card = new Card($suit, $value);
        $this->assertInstanceOf("\App\Card\Card", $card);
        
        $this->assertEquals($card->getValue(), $value);
    }

    /**
     * Confirms asString returs Joker when value is 0
     */
    public function testCardStringJoker()
    {
        $suit = "joker";
        $value = 0;
        $card = new Card($suit, $value);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $string = "JOKER";

        $this->assertEquals($card->asString(), $string);
    }

    /**
     * Confirms asString returns "J" when value is 11
     */
    public function testCardStringJack()
    {
        $suit = "&hearts;";
        $value = 11;
        $card = new Card($suit, $value);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $string = "J";

        $this->assertEquals($card->asString(), $string);
    }

    /**
     * Confirms asString returns "D" when value is 12
     */
    public function testCardStringQueen()
    {
        $suit = "&hearts;";
        $value = 12;
        $card = new Card($suit, $value);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $string = "D";

        $this->assertEquals($card->asString(), $string);
    }

    /**
     * Confirms asString returns "K" when value is 13
     */
    public function testCardStringKing()
    {
        $suit = "&hearts;";
        $value = 13;
        $card = new Card($suit, $value);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $string = "K";

        $this->assertEquals($card->asString(), $string);
    }

    /**
     * Confirms asString returns "A" when value is 14
     */
    public function testCardStringAce()
    {
        $suit = "&hearts;";
        $value = 14;
        $card = new Card($suit, $value);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $string = "A";

        $this->assertEquals($card->asString(), $string);
    }

     /**
     * Confirms asString returns number as string
     */
    public function testCardStringNumber()
    {
        $suit = "&hearts;";
        $value = random_int(2, 10);
        $card = new Card($suit, $value);
        $this->assertInstanceOf("\App\Card\Card", $card);

        $string = strval($value);

        $this->assertEquals($card->asString(), $string);
    }
}


