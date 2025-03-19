<?php

namespace App\Tests\Unit\Entity;

use App\Entity\LocationRule;
use App\Entity\City;
use PHPUnit\Framework\TestCase;

class LocationRuleTest extends TestCase
{
    public function testAddAndRemoveCity(): void
    {
        $locationRule = new LocationRule();
        $city = new City();

        $locationRule->setCity($city);
        self::assertNotNull($locationRule->getCity());
    }
}
