<?php

namespace App\Card;

interface PlayerInterface
{

    public function getHand();

    public function addCards(array $cards);

    public function getScore();
}