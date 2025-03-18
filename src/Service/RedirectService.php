<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class RedirectService
{
    public function getRedirectUrl(Request $request): ?string
    {
        $concertSlug = $request->attributes->get('concertSlug');

        if (!$concertSlug) {
            return null;
        }

        return '';
    }
}
