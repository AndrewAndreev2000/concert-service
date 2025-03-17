<?php

namespace App\Tests\Unit\Entity;

use App\Entity\City;
use App\Entity\Region;
use App\Entity\Country;
use PHPUnit\Framework\TestCase;

class RegionTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $region = new Region();

        self::assertNull($region->getId());

        $region->setName('Test');
        self::assertEquals('Test', $region->getName());

        $country = new Country();
        $region->setCountry($country);
        self::assertSame($country, $region->getCountry());
    }

    public function testAddAndRemoveCity(): void
    {
        $region = new Region();
        $city = new City();

        $region->addCity($city);
        self::assertTrue($region->getCities()->contains($city));

        $region->removeCity($city);
        self::assertFalse($region->getCities()->contains($city));
    }
}
