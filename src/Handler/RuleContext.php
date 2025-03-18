<?php

namespace App\Handler;

use Symfony\Component\HttpFoundation\Request;

class RuleContext
{
    protected ?string $timezone = null;
    protected ?string $concertSlug;

    public function __construct(
        private readonly Request $request,
    ) {
        $this->concertSlug = $this->request->attributes->get('concertSlug');
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function setTimezone(?string $timezone): static
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getConcertSlug(): ?string
    {
        return $this->concertSlug;
    }

    public function setConcertSlug(?string $concertSlug): static
    {
        $this->concertSlug = $concertSlug;

        return $this;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}
