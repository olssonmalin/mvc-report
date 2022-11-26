<?php

namespace App\Card;

/**
 * Showing off a standard class with methods and properties.
 */
class Deck implements DeckInterface
{
    /**
     * Array holding card objects
     *
     * @var array<Card>
     */
    protected $deck = [];

    /**
     * array holding suits for deck
     *
     * @var array<string>
     */
    private $suits = ["&spades;", "&clubs;", "&hearts;", "&diams;"];

    /**
     * Last drawn card
     *
     * @var array<Card>
     */
    private $lastDrawn = [];

    /**
     * Constructs a deck of cards
     *
     * @param Card $card
     */
    public function __construct(Card $card)
    {
        foreach ($this->suits as &$suit) {
            for ($i = 2; $i <= 14; $i++) {
                $card = new $card($suit, $i);
                array_push($this->deck, $card);
            }
        }
    }

    /**
     * Gets deck of cards
     *
     * @return array<Card>
     */
    public function getDeck(): array
    {
        return $this->deck;
    }

    /**
     * To get cards values and suits in array
     *
     * @return array<int,array<string,string>>
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

    /**
     * Returns last drawn cards
     *
     * @return array<Card>
     */
    public function getLastDrawn(): array
    {
        return $this->lastDrawn;
    }

    /**
     * Draws given number of cards from deck
     *
     * @param integer $num
     * @return array<Card>
     */
    public function draw(int $num = 1)
    {
        if ($this->getLen() < $num) {
            throw new DeckTooSmallException("Not enough cards in deck");
        }

        $deckPart = array_splice($this->deck, 0, $num);
        $this->lastDrawn = $deckPart;
        return $deckPart;
    }
}
