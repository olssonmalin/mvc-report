<?php

namespace App\Card;

/**
 * Showing off a standard class with methods and properties.
 */
class Deck
{
    /**
     * Array holding card objects
     *
     * @var array
     */
    protected $deck = [];

    /**
     * array holding suits for deck
     *
     * @var array
     */
    private $suits = ["&spades;", "&clubs;", "&hearts;", "&diams;"];
    private $lastDrawn = [];

    public function __construct($card)
    {
        foreach ($this->suits as &$suit) {
            for ($i = 2; $i <= 14; $i++) {
                $card = new $card($suit, $i);
                array_push($this->deck, $card);
            }
        }
    }

    /**
     * Gets card deck
     *
     * @return array
     */
    public function getDeck(): array
    {
        return $this->deck;
    }

    /**
     * To get cards values and suits in array
     *
     * @return array
     */
    public function toString(): array
    {
        $deck = [];
        foreach ($this->deck as &$card) {
            array_push($deck, ['value' => $card->asString(),'suit' => $card->getSuit()]);
        }
        return $deck;
    }

    /**
     * Shuffles deck
     *
     * @return void
     */
    public function shuffle(): void
    {
        shuffle($this->deck);
    }

    /**
     * Gets number of cards in deck
     *
     * @return integer
     */
    public function getLen(): int
    {
        return count($this->deck);
    }

    public function getLastDrawn()
    {
        return $this->lastDrawn;
    }

    /**
     * Draws given number of cards from deck
     *
     * @param integer $num
     * @return array
     */
    public function draw(int $num = 1)
    {
        $deckPart = [];
        if ($this->getLen() < $num) {
            throw new DeckTooSmallException("Not enough cards in deck");
        }
        for ($i = 0; $i < $num; $i++) {
            // array_push($deckPart, ['value' => $this->deck[0]->asString(), 'suit' => $this->deck[0]->getSuit()]);
            array_push($deckPart, $this->deck[0]);

            array_splice($this->deck, 0, 1);
        }
        $this->lastDrawn = $deckPart;
        return $deckPart;
    }
}
