<?php

namespace App\Tests\Unit\Entity;

use App\Entity\Concert;
use App\Entity\RedirectRule;
use App\Entity\Rule;
use PHPUnit\Framework\TestCase;

class RedirectRuleTest extends TestCase
{
    public function testGettersAndSetters(): void
    {
        $redirectRule = new RedirectRule();
        $redirectRule->setRedirectUrl('https://example.com');
        self::assertEquals('https://example.com', $redirectRule->getRedirectUrl());

        $concert = new Concert();
        $redirectRule->setConcert($concert);
        self::assertSame($concert, $redirectRule->getConcert());
    }

    public function testAddAndRemoveRule(): void
    {
        $redirectRule = new RedirectRule();
        $rule = self::getMockForAbstractClass(Rule::class);

        $redirectRule->addRule($rule);
        self::assertTrue($redirectRule->getRules()->contains($rule));
        self::assertSame($redirectRule, $rule->getRedirectRule());

        $redirectRule->removeRule($rule);
        self::assertFalse($redirectRule->getRules()->contains($rule));
    }
}
