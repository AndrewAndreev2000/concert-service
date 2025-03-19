<?php

namespace App\Service;

use Symfony\Component\HttpFoundation\Request;

class RedirectService
{
    public function __construct(
        private RedirectorInterface $redirector,
    )
    {
    }

    public function getRedirectUrl(Request $request): ?string
    {
        $redirector = $this->redirector;

        if ($redirector->isApplicable($request)) {
            $url = $redirector->getRedirectUrl($request);

            if (null !== $url) {
                return $url;
            }
        }

        return null;
    }
}
