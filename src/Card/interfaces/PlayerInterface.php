<?php

namespace App\Card;

interface PlayerInterface
{

    public function getHand();

    public function addCard(array $cards);

    public function getScore();
}