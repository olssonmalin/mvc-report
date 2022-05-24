<?php

// namespace App\Tests\Controller;
namespace App\Card;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardControllerTest extends WebTestCase
{
    public function testRouteCard(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Card');
    }

    public function testRouteDeck(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Deck');
    }

    public function testRouteDeckShuffle(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/shuffle');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Shuffle');
    }

    public function testRouteResetDeck(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/reset');
        $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Card');
    }
}
