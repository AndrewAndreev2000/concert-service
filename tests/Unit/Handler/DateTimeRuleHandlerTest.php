<?php

namespace App\Tests\Unit\Handler;

use App\Entity\DateTimeRule;
use App\Entity\RedirectRule;
use App\Handler\DateTimeRuleHandler;
use App\Handler\RuleContext;
use DateTime;
use DateTimeZone;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class DateTimeRuleHandlerTest extends TestCase
{
    public function testHandle(): void
    {
        $handler = new DateTimeRuleHandler();

        $request = Request::create('/concert/test');
        $request->attributes->set('_route', 'concert_view');
        $request->attributes->set('concertSlug', 'test');

        $redirectRule = new RedirectRule();
        $redirectRule->setRedirectUrl('january');

        $dateTimeRule = new DateTimeRule();
        $dateTimeRule->setStartDateTime(new DateTime('2025-01-01 00:00:00', new DateTimeZone('UTC')));
        $dateTimeRule->setEndDateTime(new DateTime('2105-01-24 00:00:00', new DateTimeZone('UTC')));
        $dateTimeRule->setRedirectRule($redirectRule);

        $context = new RuleContext($request);
        $context->setTimezone('Europe/Moscow');

        self::assertNotNull($handler->handle($dateTimeRule, $context));

        $dateTimeRule->setStartDateTime(new DateTime('2025-01-01 00:00:00', new DateTimeZone('UTC')));
        $dateTimeRule->setEndDateTime(new DateTime('2025-01-24 00:00:00', new DateTimeZone('UTC')));
        self::assertNull($handler->handle($dateTimeRule, $context));
    }
}
