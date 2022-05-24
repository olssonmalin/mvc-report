<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{
    public function testRouteGame(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Game');
    }

    public function testRouteDoc(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/doc');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Documentation');
    }

    public function testRoute21(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/start');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', '21');
    }
}
