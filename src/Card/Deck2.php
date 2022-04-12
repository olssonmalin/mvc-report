<?php

namespace App\Card;
use App\Card\Deck;
use App\Card\Card;

/**
 * Showing off a standard class with methods and properties.
 */
class Deck2 extends Deck
{

    public function __construct()
    {
        parent::__construct();
        for ($i = 0; $i < 2; $i++) {
            $card = new Card("&#9734;", 0);
            array_push($this->deck, $card);
        }
    }

}