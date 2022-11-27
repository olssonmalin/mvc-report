<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Card\Deck;
use App\Card\Card;
use App\Card\Deck2;
use App\Card\Player;
use App\Card\Game;
use App\Card\DeckTooSmallException;

class GameController extends AbstractController
{
    /**
     * @Route("/game", name="game", methods={"GET", "HEAD"})
     */
    public function game(): Response
    {
        $title = 'Game';

        return $this->render('game/game.html.twig', [
            'title' => $title,
        ]);
    }

    /**
     * @Route("/game/doc", name="doc", methods={"GET", "HEAD"})
     */
    public function doc(): Response
    {
        $title = 'Documentation';

        return $this->render('game/doc.html.twig', [
            'title' => $title,
        ]);
    }

    /**
     * @Route("/game/start", name="startGame", methods={"GET", "HEAD"})
     */
    public function startGame(SessionInterface $session): Response
    {
        $deck = new Deck(Card::class);
        $player = new Player();
        $bank = new Player();

        $title = '21';
        $session->set("game", $session->get("game") ?? new Game($deck, $player, $bank));
        $game = $session->get("game");

        $gameOver = false;
        $playerhand = $game->getPlayer()->getHand();
        $bankHand = $game->getBank()->getHand();
        $playerScore = $game->getPlayer()->getScore();
        $bankScore = $game->getBank()->getScore();
        if ($game->getPlayer()->getScore() > 21) {
            $this->addFlash("warning", "Sorry you lost :(");
            $gameOver = true;
        }

        return $this->render('game/start.html.twig', [
            'title' => $title,
            'playerHand' => $playerhand,
            'bankHand' => $bankHand,
            'playerScore' => $playerScore,
            'bankScore' => $bankScore,
            'gameOver' => $gameOver
        ]);
    }

    /**
     * @Route("/game/stand", name="standGame", methods={"GET", "HEAD"})
     */
    public function standGame(SessionInterface $session): Response
    {
        $title = '21';
        $game = $session->get("game");

        $game->stand();

        $playerhand = $game->getPlayer()->getHand();
        $bankHand = $game->getBank()->getHand();
        $playerScore = $game->getPlayer()->getScore();
        $bankScore = $game->getBank()->getScore();

        $msgType = 'warning';
        $msg = "Sorry you lost :(";
        if ($game->playerWon()) {
            // $this->addFlash("success", "Congratulations! You won!");
            $msgType = "success";
            $msg = "Congratulations! You won!";
        }
        $this->addFlash($msgType, $msg);

        return $this->render('game/stand.html.twig', [
            'title' => $title,
            'playerHand' => $playerhand,
            'bankHand' => $bankHand,
            'playerScore' => $playerScore,
            'bankScore' => $bankScore
        ]);
    }

     /**
     * @Route("/game/reset", name="resetGame", methods={"GET", "HEAD"})
     */
    public function resetGame(SessionInterface $session): Response
    {
        $deck = new Deck(Card::class);
        $player = new Player();
        $bank = new Player();

        $session->set("game", new Game($deck, $player, $bank));
        return $this->redirectToRoute('startGame');
    }

     /**
     * @Route("/game/hit", name="hitGame", methods={"GET", "HEAD"})
     */
    public function hitGame(SessionInterface $session): Response
    {
        $game = $session->get("game");

        $game->hit();
        return $this->redirectToRoute('startGame');
    }
}
