<?php

namespace App\Tests\Functional\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class ConcertControllerTest extends WebTestCase
{
    public function testView(): void
    {
        $client = self::createClient();
        $client->request('GET', '/concert/test-slug');

        self::assertResponseIsSuccessful();
    }
}
