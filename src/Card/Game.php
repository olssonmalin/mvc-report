<?php

namespace App\Card;
use App\Card\CardInterface;
use App\Card\DeckInterface;
use App\Card\PlayerInterface;


class Game
{
    /**
     * Player object
     *
     * @var PlayerInterface
     */
    private PlayerInterface $player;

    /**
     * Bank object
     *
     * @var PlayerInterface
     */
    private PlayerInterface $bank;

    /**
     * Deck object
     *
     * @var DeckInterface
     */
    private DeckInterface $deck;

    /**
     * Player object of the current player (player or bank)
     *
     * @var PlayerInterface
     */
    private PlayerInterface $currentPlayer;


    /**
     * Constructs game (21) object
     *
     * @param DeckInterface $deck
     * @param PlayerInterface $player
     * @param CardInterface $card
     */
    public function __construct(DeckInterface $deck, PlayerInterface $player, PlayerInterface $bank)
    {
        // $this->player = new $player();
        // $this->bank = new $player();
        // $this->deck = new $deck($card);

        $this->player = $player;
        $this->bank = $bank;
        $this->deck = $deck;
        $this->currentPlayer = $this->player;
    }

    /**
     * Deals a card to the current player (player or bank)
     *
     * @return void
     */
    public function hit(): void
    {
        $this->deck->shuffle();
        $card = $this->deck->draw();
        $this->currentPlayer->addCard($card);
    }

    /**
     * Stops dealing for current player
     * Switch current player if the current player is player and not bank
     *
     * @return void
     */
    public function stand(): void
    {
        if ($this->currentPlayer !== $this->bank) {
            $this->currentPlayer = $this->bank;
            $this->playBank();
        }
    }

    /**
     * Automatically plays for bank player
     *
     * @return void
     */
    public function playBank(): void
    {
        while ($this->bank->getScore() < 17) {
            $this->hit();
        }
    }

    /**
     * Cahcks if the player won or not
     *
     * @return boolean
     */
    public function playerWon(): bool
    {
        return $this->bank->getScore() > 21 || $this->bank->getScore() < $this->player->getScore() && $this->player->getScore() <= 21;
    }

    /**
     * Gets player object
     *
     * @return PlayerInterface
     */
    public function getPlayer(): PlayerInterface
    {
        return $this->player;
    }

    /**
     * Gets bank player object
     *
     * @return PlayerInterface
     */
    public function getBank(): PlayerInterface
    {
        return $this->bank;
    }

    /**
     * Gets currentplayer player object
     *
     * @return PlayerInterface
     */
    public function getCurrentPlayer(): PlayerInterface
    {
        return $this->currentPlayer;
    }
}
