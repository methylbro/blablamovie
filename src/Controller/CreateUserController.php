<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\CreateUser;

/**
 * Créer un utilisateur 
 * (pseudo, email unique, date de naissance, date de création en base de données)
 */
class CreateUserController
{
    private CreateUser $createUser;

    public function __construct(CreateUser $createUser)
    {
        $this->createUser = $createUser;
    }

    public function __invoke(Request $request): JsonResponse
    {
        try {
            $user = $this->createUser->__invoke(
                json_decode($request->getContent())
            );
        } catch (\DomainException $e) {
            return new JsonResponse(
                $e->getMessage(),
                JsonResponse::HTTP_BAD_REQUEST
            );
        }

        return new JsonResponse($user);
    }
}