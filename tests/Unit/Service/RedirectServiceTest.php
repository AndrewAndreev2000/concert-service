<?php

namespace App\Tests\Unit\Service;

use App\Service\RedirectorInterface;
use App\Service\RedirectService;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;

class RedirectServiceTest extends TestCase
{
    private RedirectService $redirectService;

    private RedirectorInterface $redirector;

    #[\Override]
    protected function setUp(): void
    {
        $this->redirector = self::createMock(RedirectorInterface::class);
        $this->redirectService = new RedirectService($this->redirector);
    }

    public function testGetRedirectUrlWithNotNullResult()
    {
        $request = new Request;

        $this->redirector->expects(self::once())
            ->method('isApplicable')
            ->with($request)
            ->willReturn(true);

        $this->redirector->expects(self::once())
            ->method('getRedirectUrl')
            ->with($request)
            ->willReturn('test');

        self::assertEquals('test', $this->redirectService->getRedirectUrl($request));
    }

    public function testGetRedirectUrlWithNullResult()
    {
        $request = new Request;

        $this->redirector->expects(self::once())
            ->method('isApplicable')
            ->with($request)
            ->willReturn(false);

        self::assertNull($this->redirectService->getRedirectUrl($request));
    }
}
