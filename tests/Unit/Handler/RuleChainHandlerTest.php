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

        $this->handlers = [$firstHandler, $secondHandler];
        $this->rules = new ArrayCollection([new LocationRule(), new DateTimeRule()]);
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
            ->willReturn($this->rules);

        $this->handlers[0]->expects(self::once())
            ->method('isApplicable')
            ->willReturn(true);

        $this->handlers[0]->expects(self::once())
            ->method('handle')
            ->with($this->rules[0], $ruleContext)
            ->willReturn(null);


        self::assertEquals(null, $this->handler->process($redirectRule, $ruleContext));
    }
}
