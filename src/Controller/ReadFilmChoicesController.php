<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\ReadFilmChoices;

/**
 * lister les choix de film d'un utilisateur
 */
class ReadFilmChoicesController
{
    private ReadFilmChoices $readFilmChoices;

    public function __construct(ReadFilmChoices $readFilmChoices)
    {
        $this->readFilmChoices = $readFilmChoices;
    }

    public function __invoke(Request $request): Response
    {
    	$result = call_user_func(
            $this->readFilmChoices,
            $request->get('user_uuid')
        );

        return new JsonResponse($result);
    }
}