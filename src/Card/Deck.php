<?php

namespace App\Card;

/**
 * Showing off a standard class with methods and properties.
 */
class Deck
{
    protected $deck = [];
    private $suits = ["&spades;", "&clubs;", "&hearts;", "&diams;"];
    private $lastDrawn = [];

    public function __construct()
    {
        foreach ($this->suits as &$s) {
            for($i = 2; $i <= 14; $i++) {
                $card = new Card($s, $i);
                array_push($this->deck, $card);
            }
        }
    }
    
    public function getDeck(): array
    {
        return $this->deck;
    }

    public function toString(): array
    {   
        $deck = [];
        foreach ($this->deck as &$card) {
            array_push($deck, ['value' => $card->asString(),'suit' => $card->getSuit()]);
        }
        return $deck;
    }

    public function shuffle(): void
    {
        shuffle($this->deck);
    }

    public function getLen(): int
    {
        return count($this->deck);
    }

    public function getLastDrawn()
    {
        return $this->lastDrawn;
    }

    public function draw(int $num = 1)
    {
        $deckPart = [];
        if ($this->getLen() < $num) {
            throw new DeckTooSmallException("Not enough cards in deck");
        }
        for ($i =0; $i < $num; $i++)
        {
            array_push($deckPart, ['value' => $this->deck[0]->asString(), 'suit' => $this->deck[0]->getSuit()]);
            array_splice($this->deck, 0, 1);
        }
        $this->lastDrawn = $deckPart;
        return $deckPart;
    }
}
