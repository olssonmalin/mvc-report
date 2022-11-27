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

class CardJson extends AbstractController
{
    /**
     * Deck of cards
     *
     * @var Deck|Deck2
     */
    private $deck;

    /**
     * @Route("/card/api/deck", name="card-api-deck", methods={"GET", "HEAD"})
     */
    public function deckApi(): Response
    {
        $this->deck = new Deck(Card::class);

        $data = [
            'deck' => $this->deck->toString()
        ];

        // $response = new Response();
        // $response->setContent(json_encode($data));
        // $response->headers->set('Content-Type', 'application/json');

        // return $response;
        return $this->json($data);
    }

     /**
     * @Route("/card/api/deck/shuffle", name="shuffle-api")
     */
    public function deckShuffleApi(SessionInterface $session): Response
    {
        $this->deck = new Deck(Card::class);
        $this->deck->shuffle();
        $session->set("deck", $this->deck);
        $deck = $session->get("deck");

        $data = [
            'deck' => $deck->toString()
        ];

        // $response = new Response();
        // $response->setContent(json_encode($data));
        // $response->headers->set('Content-Type', 'application/json');

        // return $response;
        return $this->json($data);
        
    }
}
