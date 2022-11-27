<?php

namespace App\Card;

interface PlayerInterface
{
    /**
     * Gets players current hand of cards
     *
     * @return array<Card>
     */
    public function getHand();

    /**
     * Adds card(s) to players hand
     *
     * @param array<Card> $cards
     * @return void
     */
    public function addCard(array $cards);

    /**
     * Gets players score
     * @return int
     */
    public function getScore();
}
