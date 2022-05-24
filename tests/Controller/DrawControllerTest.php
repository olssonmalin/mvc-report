<?php

namespace App\Card;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DrawControllerTest extends WebTestCase
{
    public function testRouteDrawOne(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/card/deck/draw');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Draw');
    }

    public function testDrawMany(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/card/deck/draw/5');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Draw');
    }
}
