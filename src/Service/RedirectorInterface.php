<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

interface RedirectorInterface
{
    public function isApplicable(Request $request): bool;

    public function getRedirectUrl(Request $request): ?string;
}
