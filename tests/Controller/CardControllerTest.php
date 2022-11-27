<?php

// namespace App\Tests\Controller;
namespace App\Card;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardControllerTest extends WebTestCase
{   
    /**
     * test card route
     *
     * @return void
     */
    public function testRouteCard(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Card');
    }

    /**
     * test deck route
     *
     * @return void
     */
    public function testRouteDeck(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Deck');
    }

    /**
     * test shuffle deck route
     *
     * @return void
     */
    public function testRouteDeckShuffle(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/shuffle');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Shuffle');
    }

    /**
     * test reset deck route
     *
     * @return void
     */
    public function testRouteResetDeck(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/reset');
        $client->followRedirect();

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Card');
    }
}
