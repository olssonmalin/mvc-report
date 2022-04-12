<?php

namespace App\Card;
use App\Card\Deck;
/**
 * Showing off a standard class with methods and properties.
 */
class Player
{
    private $hand;

    public function __construct(int $cards, Deck $deck)
    {
        $this->hand = $deck->draw($cards);
    }

    public function getHand()
    {
        return $this->hand;
    }
}
