<?php

namespace App\Tests\Unit\Handler;

use App\Entity\City;
use App\Handler\RuleContext;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class RuleContextTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $request = self::getMockForAbstractClass(Request::class);
        $ruleContext = new RuleContext($request);

        $ruleContext->setTimezone('UTC');
        self::assertEquals('UTC', $ruleContext->getTimezone());

        $ruleContext->setConcertSlug('Test');
        self::assertEquals('Test', $ruleContext->getConcertSlug());

        $city = new City();
        $ruleContext->setCity($city);
        self::assertSame($city, $ruleContext->getCity());

        self::assertSame($request, $ruleContext->getRequest());
    }
}
