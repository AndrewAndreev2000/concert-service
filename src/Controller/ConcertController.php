<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class ConcertController
{
    #[Route('/concert/{concertSlug}', name: 'concert_view', defaults: ['concertSlug' => null])]
    public function viewAction(): JsonResponse
    {
        return new JsonResponse([
            'data' => [/* some data */],
        ], 200);
    }
}
