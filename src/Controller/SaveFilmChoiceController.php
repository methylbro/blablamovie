<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\SaveFilmChoice;

/**
 * enregistrer le choix d'un film d'un utilisateur 
 */
class SaveFilmChoiceController
{
    private SaveFilmChoice $saveFilmChoice;

    public function __construct(SaveFilmChoice $saveFilmChoice)
    {
        $this->saveFilmChoice = $saveFilmChoice;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $filmchoice = call_user_func_array(
                $this->saveFilmChoice,
                [
                    $request->get('user_uuid'),
                    $request->getContent(),
                ]
            );
        } catch (\DomainException $e) {
            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse($filmchoice);
    }
}