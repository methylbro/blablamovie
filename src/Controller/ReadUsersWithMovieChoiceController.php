<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\ReadUsersWithMovieChoice;

/**
 * retourner le meilleur Movie selon l'ensemble des utilisateurs
 */
class ReadUsersWithMovieChoiceController
{
	private ReadUsersWithMovieChoice $readUsersWithMovieChoice;

	public function __construct(ReadUsersWithMovieChoice $readUsersWithMovieChoice)
	{
		$this->readUsersWithMovieChoice = $readUsersWithMovieChoice;
	}

    public function __invoke(Request $request): Response
    {
    	$users = call_user_func($this->readUsersWithMovieChoice);

        return new JsonResponse($users);
    }
}