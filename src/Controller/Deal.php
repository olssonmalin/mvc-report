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

class Deal extends AbstractController
{
     /**
     * @Route("/card/deck/deal/{players}/{cards}",
     * name="deal",
     * methods={"GET","POST", "HEAD"})
     */
    public function deckDeal(int $players, int $cards, SessionInterface $session): Response
    {
        $title = 'Deal';
        $session->set("deck", $session->get("deck") ?? new Deck(Card::class));
        $session->set("gameSet", $session->get("gameSet") ?? []);
        $deck = $session->get("deck");
        $deck->shuffle();
        try {
            $gameSet = [];
            for ($i = 0; $i < $players; $i++) {
                $player = new Player();
                $player->addCard($deck->draw($cards));
                array_push($gameSet, $player->getHand());
            }
        } catch (DeckTooSmallException $e) {
            $this->addFlash("warning", "Not enough cards in the deck.");
        }

        return $this->render('card/card-deal.html.twig', [
            'title' => $title,
            'game' => $gameSet,
            'length' => $deck->getLen()
        ]);
    }

     /**
     * @Route(
     *      "/card/deck/deal",
     *      name="form-deal",
     *      methods={"GET","HEAD"}
     * )
     */
    public function dealForm(): Response
    {
        $title = 'Deal';
        return $this->render('form/deal.html.twig', [
            'title' => $title
        ]);
    }

    /**
     * @Route(
     *      "/card/deck/deal",
     *      name="form-deal-process",
     *      methods={"POST"}
     * )
     */
    public function dealProcess(Request $request): Response
    {
        $players = $request->request->get('players');
        $cards  = $request->request->get('cards');


        return $this->redirectToRoute('deal', [
            'players' => $players,
            'cards' => $cards
        ]);
    }
}
