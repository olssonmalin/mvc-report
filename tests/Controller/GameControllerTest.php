<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class GameControllerTest extends WebTestCase
{   
    /**
     * test game route
     *
     * @return void
     */
    public function testRouteGame(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Game');
    }

    /**
     * Test doc route
     *
     * @return void
     */
    public function testRouteDoc(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/doc');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Documentation');
    }

    /**
     * test start game route
     *
     * @return void
     */
    public function testRoute21(): void
    {
        $client = static::createClient();
        $client->request('GET', '/game/start');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', '21');
    }
}
