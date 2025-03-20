<?php

namespace App\Tests\Unit\Service;

use App\Entity\RedirectRule;
use App\Handler\RuleChainHandler;
use App\Handler\RuleContext;
use App\Repository\RedirectRuleRepository;
use App\Service\ConcertRedirector;
use Doctrine\Persistence\ManagerRegistry;
use phpDocumentor\Reflection\Types\Self_;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;

class ConcertRedirectorTest extends TestCase
{
    private ManagerRegistry $doctrine;
    private RuleChainHandler $ruleChainHandler;
    private ParameterBag $requestAttributes;
    private ConcertRedirector $concertRedirector;

    #[\Override]
    protected function setUp(): void
    {
        $this->doctrine = self::createMock(ManagerRegistry::class);
        $this->ruleChainHandler = self::createMock(RuleChainHandler::class);
        $this->requestAttributes = self::createMock(ParameterBag::class);
        $this->concertRedirector = new ConcertRedirector($this->doctrine, $this->ruleChainHandler);
    }

    public function testIsApplicable()
    {
        $request = new Request();

        self::assertFalse($this->concertRedirector->isApplicable($request));

        $request->attributes->set('concertSlug', 'test');

        self::assertTrue($this->concertRedirector->isApplicable($request));
    }
}
