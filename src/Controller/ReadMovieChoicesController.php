<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\ReadMovieChoices;

/**
 * lister les choix de Movie d'un utilisateur
 */
class ReadMovieChoicesController
{
    private ReadMovieChoices $readMovieChoices;

    public function __construct(ReadMovieChoices $readMovieChoices)
    {
        $this->readMovieChoices = $readMovieChoices;
    }

    public function __invoke(Request $request): Response
    {
    	$movieChoices = call_user_func(
            $this->readMovieChoices,
            $request->get('user_uuid')
        );

        return new JsonResponse($movieChoices);
    }
}