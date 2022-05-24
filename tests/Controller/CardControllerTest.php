<?php

// namespace App\Tests\Controller;
namespace App\Card;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class CardControllerTest extends WebTestCase
{
    public function testRouteCard(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/card');

        $this->assertResponseIsSuccessful();
        $this->assertSelectorTextContains('h1', 'Card');
    }
}
