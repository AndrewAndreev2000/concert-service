<?php

namespace App\Handler;

use App\Entity\City;
use Symfony\Component\HttpFoundation\Request;

class RuleContext
{
    protected ?string $timezone = null;
    protected ?string $concertSlug = null;

    protected ?City $city = null;

    public function __construct(
        private readonly Request $request,
    ) {
        $this->concertSlug = $this->request->attributes->get('concertSlug');
    }

    public function getTimezone(): ?string
    {
        return $this->timezone;
    }

    public function setTimezone(?string $timezone): self
    {
        $this->timezone = $timezone;

        return $this;
    }

    public function getConcertSlug(): ?string
    {
        return $this->concertSlug;
    }

    public function setConcertSlug(?string $concertSlug): self
    {
        $this->concertSlug = $concertSlug;

        return $this;
    }

    public function getCity(): ?City
    {
        return $this->city;
    }

    public function setCity(?City $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getRequest(): Request
    {
        return $this->request;
    }
}
