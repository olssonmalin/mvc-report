<?php

namespace App\Card;

class Game
{   
    private $player;
    private $bank;
    private $deck;
    private $currentPlayer;

    public function __construct($deck, $player, $card)
    {
        $this->player = new $player;
        $this->bank = new $player;
        $this->deck = new $deck($card);
        $this->currentPlayer = $this->player;
    }

    public function hit()
    {   
        $this->deck->shuffle();
        $card = $this->deck->draw();
        $this->currentPlayer->addCard($card);
    }

    public function stand()
    {
        if ($this->currentPlayer !== $this->bank) {
            $this->currentPlayer = $this->bank;
            $this->playBank();
        }
    }

    public function playBank()
    {
        while ($this->bank->getScore() < 17) {
            $this->hit();
        }
    }

    public function playerWon(): bool
    {
        return $this->bank->getScore() > 21 || $this->bank->getScore() < $this->player->getScore() && $this->player->getScore() <= 21;
        
    }

    public function getPlayer()
    {
        return $this->player;
    }

    public function getBank()
    {
        return $this->bank;
    }


}