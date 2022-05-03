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

class Draw extends AbstractController
{

     /**
     * @Route("/card/deck/draw", name="draw")
     */
    public function deckDraw(SessionInterface $session): Response
    {
        
        return $this->deckDrawNumber(1, $session);
    }

    /**
     * @Route("/card/deck/draw/{number}", 
     * name="draw-number", 
     * methods={"GET", "HEAD"})
     */
    public function deckDrawNumber(int $number, SessionInterface $session): Response
    {
        $title = 'Draw';
        $session->set("deck", $session->get("deck") ?? new Deck(Card::class));
        $deck = $session->get("deck");
        $deck->shuffle();
        try {
            $deckPart = $deck->draw($number);
        } catch (DeckTooSmallException $e) {
            $deckPart = $deck->getLastDrawn();
            $this->addFlash("warning", "Not enough cards in the deck.");
        }

        return $this->render('card/card-draw.html.twig', [
            'title' => $title,
            'deck' => $deckPart ?? [],
            'length' => $deck->getLen()
        ]);
    }

     /**
     * @Route(
     *      "/card",
     *      name="form-draw-process",
     *      methods={"POST"}
     * )
     */
    public function drawProcess(Request $request): Response
    {
        $number  = $request->request->get('number');

        return $this->redirectToRoute('draw-number', [
            'number' => $number
        ]);
    }

}