<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\ReadBestMovie;

/**
 * retourner le meilleur Movie selon l'ensemble des utilisateurs
 */
class ReadBestMovieController
{
    private ReadBestMovie $readBestMovie;

    public function __construct(ReadBestMovie $readBestMovie) 
    {
        $this->readBestMovie = $readBestMovie;
    }

    public function __invoke(): JsonResponse
    {
        $result = call_user_func($this->readBestMovie);

        return new JsonResponse($result);
    }
}