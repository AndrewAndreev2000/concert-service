<?php

namespace App\Tests\Unit\Handler;

use App\Entity\City;
use App\Entity\LocationRule;
use App\Entity\RedirectRule;
use App\Handler\LocationRuleHandler;
use App\Handler\RuleContext;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class LocationRuleHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $handler = new LocationRuleHandler();

        $request = Request::create('/concert/test');
        $request->attributes->set('_route', 'concert_view');
        $request->attributes->set('concertSlug', 'test');

        $redirectRule = new RedirectRule();
        $redirectRule->setRedirectUrl('moscow.concert-service/concert/test');

        $city = new City();

        $locationRule = new LocationRule();
        $locationRule->setCity($city);
        $locationRule->setRedirectRule($redirectRule);

        $context = new RuleContext($request);
        $context->setCity($city);

        self::assertTrue($handler->isApplicable($locationRule));
        self::assertNotNull($handler->handle($locationRule, $context));

        $otherCity = new City();

        $locationRule->setCity($otherCity);
        self::assertNull($handler->handle($locationRule, $context));
    }
}
