<?php

namespace App\Card;

interface CardInterface
{

    public function getValue();

    public function getSuit();

    public function asString();
}
