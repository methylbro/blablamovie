<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\SaveMovieChoice;

/**
 * enregistrer le choix d'un Movie d'un utilisateur 
 */
class SaveMovieChoiceController
{
    private SaveMovieChoice $saveMovieChoice;

    public function __construct(SaveMovieChoice $saveMovieChoice)
    {
        $this->saveMovieChoice = $saveMovieChoice;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $moviechoice = call_user_func_array(
                $this->saveMovieChoice,
                [
                    'abcd1-abcd1',//$request->get('user_uuid'),
                    'film4',//$request->getContent(),
                ]
            );
        } catch (\DomainException $e) {
            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse($moviechoice);
    }
}