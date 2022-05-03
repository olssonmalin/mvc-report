<?php

namespace App\Card;
use App\Card\Deck;
/**
 * Showing off a standard class with methods and properties.
 */
class Player
{
    private $hand= [];
    private $score = 0;

    public function __construct()
    {

    }

    public function getHand()
    {
        return $this->hand;
    }


    public function addCard($cards) 
    {   
        foreach ($cards as &$card) {
            array_push($this->hand, $card);
            $this->score += $card->getValue();
        }
    }

    public function getScore() {
        return $this->score;
    }
}
