<?php

namespace App\Tests\Unit\Entity;

use App\Entity\City;
use App\Entity\Concert;
use App\Entity\RedirectRule;
use PHPUnit\Framework\TestCase;

class ConcertTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $concert = new Concert();

        self::assertNull($concert->getId());

        $concert->setName('Test');
        self::assertEquals('Test', $concert->getName());

        $concert->setSlug('Test');
        self::assertEquals('Test', $concert->getSlug());

        $city = new City();
        $concert->setCity($city);
        self::assertSame($city, $concert->getCity());
    }

    public function testAddAndRemoveRedirectRule(): void
    {
        $concert = new Concert();
        $redirectRule = new RedirectRule();

        $concert->addRedirectRule($redirectRule);
        self::assertTrue($concert->getRedirectRules()->contains($redirectRule));

        $concert->removeRedirectRule($redirectRule);
        self::assertFalse($concert->getRedirectRules()->contains($redirectRule));
    }
}
