<?php

namespace App\Card;

interface CardInterface
{
    /**
     * Get value of card
     *
     * @return int
     */
    public function getValue();

    /**
     * get suit of card
     *
     * @return string
     */
    public function getSuit();

    /**
     * Coverts value as string
     *
     * @return string
     */
    public function asString();
}
