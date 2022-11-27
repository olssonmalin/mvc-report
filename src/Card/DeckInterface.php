<?php

namespace App\Card;

interface DeckInterface
{
    /**
     * Get Deck of cards
     *
     * @return array<Card>
     */
    public function getDeck();

    /**
     * To get cards values and suits in array
     *
     * @return array<int,array<string,string>>
     */
    public function toString();

    /**
     * Shuffles deck
     *
     * @return void
     */
    public function shuffle();

    /**
     * Gets number of cards in deck
     *
     * @return integer
     */
    public function getLen();

    /**
     * Returns last drawn cards
     *
     * @return array<Card>
     */
    public function getLastDrawn();

     /**
     * Draws given number of cards from deck
     *
     * @return array<Card>
     */
    public function draw();
}
