<?php

namespace App\Card;

use App\Card\Deck;

/**
 * Showing off a standard class with methods and properties.
 */
class Player implements PlayerInterface
{
    /**
     * Holds hand of cards
     *
     * @var array<Card>
     */
    private $hand = [];

    /**
     * Holds current score for player
     *
     * @var integer
     */
    private $score = 0;

    /**
     * Constructs object
     */
    public function __construct()
    {
    }

    /**
     * Gets players current hand of cards
     *
     * @return array<Card>
     */
    public function getHand(): array
    {
        return $this->hand;
    }

    /**
     * Adds card(s) to players hand
     *
     * @param array<Card> $cards
     * @return void
     */
    public function addCard(array $cards = [new Card("joker", 0)]): void
    {
        foreach ($cards as &$card) {
            array_push($this->hand, $card);
            $this->score += $card->getValue();
        }
    }

    /**
     * Gets players score
     * @return int
     */
    public function getScore(): int
    {
        return $this->score;
    }
}
