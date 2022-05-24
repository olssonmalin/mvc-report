<?php

namespace App\Card;

interface DeckInterface
{
    public function getDeck();

    public function toString();

    public function shuffle();

    public function getLen();

    public function getLastDrawn();

    public function draw();
}