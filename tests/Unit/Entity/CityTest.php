<?php

namespace App\Tests\Unit\Entity;

use App\Entity\City;
use PHPUnit\Framework\TestCase;

class CityTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $city = new City();

        self::assertNull($city->getId());

        $city->setName('Test');
        self::assertEquals('Test', $city->getName());
    }
}
