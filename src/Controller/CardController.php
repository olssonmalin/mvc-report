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
use App\Card\DeckTooSmallException;

class CardController extends AbstractController
{
    /**
     * @Route("/card", name="card", methods={"GET", "HEAD"})
     */
    public function card(): Response
    {
        $title = 'Card';

        return $this->render('card/card.html.twig', [
            'title' => $title,
        ]);
    }

    /**
     * @Route("/card/deck", name="deck")
     */
    public function deck(): Response
    {
        $title = 'Deck';
        $deck = new Deck(Card::class);

        return $this->render('card/card-deck.html.twig', [
            'title' => $title,
            'deck' => $deck->toString()
        ]);
    }

    /**
     * @Route("/card/deck2", name="deck2")
     */
    public function deck2(): Response
    {
        $title = 'Deck';
        $deck = new Deck2(Card::class);

        return $this->render('card/card-deck.html.twig', [
            'title' => $title,
            'deck' => $deck->toString()
        ]);
    }

    /**
     * @Route("/card/deck/shuffle", name="shuffle")
     */
    public function deckShuffle(SessionInterface $session): Response
    {
        $title = 'Shuffle';
        
        $session->set("deck", new Deck(Card::class));
        $deck = $session->get("deck");
        $deck->shuffle();

        return $this->render('card/card-deck.html.twig', [
            'title' => $title,
            'deck' => $deck->toString()
        ]);
    }


    /**
     * @Route("/card/deck/reset",
     * name="reset",
     * methods={"GET","POST", "HEAD"})
     */
    public function resetSessionDeck(SessionInterface $session): Response
    {
        $session->set("deck", new Deck(Card::class));
        return $this->redirectToRoute('card');
    }
}
