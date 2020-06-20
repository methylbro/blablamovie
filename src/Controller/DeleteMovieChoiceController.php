<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\DeleteMovieChoice;

/**
 * supprimer le choix d'un Movie d'un utilisateur
 */
class DeleteMovieChoiceController
{
    private DeleteMovieChoice $deleteMovieChoice;

    public function __construct(DeleteMovieChoice $deleteMovieChoice) 
    {
        $this->deleteMovieChoice = $deleteMovieChoice;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $movieChoice = call_user_func_array(
                $this->deleteMovieChoice,
                [
                    $request->get('user_uuid'),
                    $request->get('imdbId'),
                ]
            );
        } catch (\DomainException $e) {
            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse($movieChoice);
    }
}