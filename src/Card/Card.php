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
     * Creates card, sets value and suit
     *
     * @param string $suit
     * @param integer $value
     */
    public function __construct(string $suit = "joker", int $value) {
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
     * @return void
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
        if ($this->value === 0) {
            return "JOKER";
        } elseif ($this->value === 11) {
            return "J";
        } elseif ($this->value === 12) {
            return "D";
        } elseif ($this->value === 13) {
            return "K";
        } elseif ($this->value === 14) {
            return "A";
        } 
        return "$this->value";
    }
}