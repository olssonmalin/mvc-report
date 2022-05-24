<?php

namespace App\Card;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class DealControllerTest extends WebTestCase
{
    public function testRouteDeal(): void
    {
        $client = static::createClient();
        $client->request('GET', '/card/deck/deal/2/3');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Deal');
    }
}
