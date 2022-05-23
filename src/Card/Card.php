<?php

namespace App\Card;

use App\Card\Card;

/**
 * Showing off a standard class with methods and properties.
 */
class Card
{
    /**
     * Holds cards suit
     *
     * @var string
     */
    private $suit;

    /**
     * Holds cards value
     *
     * @var integer
     */
    private int $value;

   /**
    * Covered cards as string
    *
    *@var array
    */
    private $JDKA = [
        0 => "JOKER",
        10 => "10", 
        11 => "J",
        12 => "D",
        13 => "K",
        14 => "A"
    ];

    /**
     * Creates card, sets value and suit
     *
     * @param string $suit
     * @param integer $value
     */
    public function __construct(string $suit, int $value)
    {
        $this->value = $value;
        $this->suit = $suit;
    }

    /**
     * Gets card value
     *
     * @return int
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Get cards suit
     *
     * @return string
     */
    public function getSuit()
    {
        return $this->suit;
    }

    /**
     * Converts value to string
     *
     * @return string
     */
    public function asString(): string
    {

       if (array_key_exists($this->value, $this->JDKA)) {
           return $this->JDKA[$this->value];
       }

        return "$this->value";
    }
}
