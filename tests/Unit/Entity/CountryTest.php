<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Country;
use App\Entity\Region;
use PHPUnit\Framework\TestCase;

class CountryTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $country = new Country();

        self::assertNull($country->getId());

        $country->setName('Test');
        self::assertEquals('Test', $country->getName());

        $country->setCode('RU');
        self::assertEquals('RU', $country->getCode());
    }

    public function testAddAndRemoveRegion(): void
    {
        $country = new Country();
        $region = new Region();

        $country->addRegion($region);
        self::assertTrue($country->getRegions()->contains($region));

        $country->removeRegion($region);
        self::assertFalse($country->getRegions()->contains($region));
    }
}
