<?php

namespace App\Tests\Unit\Handler;

use App\Entity\DateTimeRule;
use App\Entity\LocationRule;
use App\Entity\RedirectRule;
use App\Entity\Rule;
use App\Handler\RuleChainHandler;
use App\Handler\RuleContext;
use App\Handler\RuleHandlerInterface;
use Doctrine\Common\Collections\ArrayCollection;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class RuleChainHandlerTest extends TestCase
{
    private RuleChainHandler $handler;

    /** @var RuleHandlerInterface[]|\PHPUnit\Framework\MockObject\MockObject[] */
    private $handlers = [];

    /** @var Rule[]|\PHPUnit\Framework\MockObject\MockObject[] */
    private $rules = [];

    #[\Override]
    protected function setUp(): void
    {
        $firstHandler = self::createMock(RuleHandlerInterface::class);
        $secondHandler = self::createMock(RuleHandlerInterface::class);
        $locationRule = self::createMock(LocationRule::class);
        $dateTimeRule = self::createMock(DateTimeRule::class);

        $this->handlers = [$firstHandler, $secondHandler];
        $this->rules = [$locationRule, $dateTimeRule];
        $this->handler = new RuleChainHandler($this->handlers);
    }

    public function testProcess(): void
    {
        $request = new Request;
        $request->attributes->set('concertSlug', 'test');

        $ruleContext = new RuleContext($request);
        $redirectRule = self::createMock(RedirectRule::class);


        $redirectRule->expects(self::once())
            ->method('getRules')
            ->willReturn(new ArrayCollection([new LocationRule(), new DateTimeRule()]));

        $this->handlers[0]->expects(self::once())
            ->method('isApplicable')
            ->willReturn(true);

        $this->handlers[0]->expects(self::once())
            ->method('handle')
            ->willReturn(true);

        self::assertEquals(null, $this->handler->process($redirectRule, $ruleContext));
    }
}
