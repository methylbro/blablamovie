<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use App\Domain\DeleteFilmChoice;

/**
 * supprimer le choix d'un film d'un utilisateur
 */
class DeleteFilmChoiceController
{
    private DeleteFilmChoice $deleteFilmChoice;

    public function __construct(DeleteFilmChoice $deleteFilmChoice) 
    {
        $this->deleteFilmChoice = $deleteFilmChoice;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $result = call_user_func_array(
                $this->deleteFilmChoice,
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

        return new JsonResponse($result);
    }
}