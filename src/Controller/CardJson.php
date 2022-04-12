<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Card\Deck;
use App\Card\Deck2;
use App\Card\Player;
use App\Card\DeckTooSmallException;


class CardJson extends AbstractController
{   

    private $deck;

    /**
     * @Route("/card/api/deck", name="card-api-deck", methods={"GET", "HEAD"})
     */
    public function deckApi(): Response
    {
        $this->deck = new Deck();

        $data = [
            'deck' => $this->deck->toString()
        ];

        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }

     /**
     * @Route("/card/api/deck/shuffle", name="shuffle-api")
     */
    public function deckShuffleApi(SessionInterface $session): Response
    {   
        $this->deck = new Deck();
        $this->deck->shuffle();
        $session->set("deck", $this->deck);
        $deck = $session->get("deck");

        $data = [
            'deck' => $deck->toString()
        ];

        $response = new Response();
        $response->setContent(json_encode($data));
        $response->headers->set('Content-Type', 'application/json');

        return $response;
    }
}