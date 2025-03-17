<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Region;
use App\Entity\Country;
use PHPUnit\Framework\TestCase;

class RegionTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $region = new Region();

        self::assertNull($region->getId());

        $region->setName('Moscow Oblast');
        self::assertEquals('Moscow Oblast', $region->getName());

        $country = new Country();
        $region->setCountry($country);
        self::assertSame($country, $region->getCountry());
    }
}
