<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\ReadUsersWithFilmChoice;

/**
 * retourner le meilleur film selon l'ensemble des utilisateurs
 */
class ReadUsersWithFilmChoiceController
{
	private ReadUsersWithFilmChoice $readUsersWithFilmChoice;

	public function __construct(ReadUsersWithFilmChoice $readUsersWithFilmChoice)
	{
		$this->readUsersWithFilmChoice = $readUsersWithFilmChoice;
	}

    public function __invoke(Request $request): Response
    {
    	$users = call_user_func($this->readUsersWithFilmChoice);

        return new JsonResponse($users);
    }
}