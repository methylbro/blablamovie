<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\JsonResponse;
use App\Domain\ReadBestFilm;

/**
 * retourner le meilleur film selon l'ensemble des utilisateurs
 */
class ReadBestFilmController
{
    private ReadBestFilm $readBestFilm;

    public function __construct(ReadBestFilm $readBestFilm) 
    {
        $this->readBestFilm = $readBestFilm;
    }

    public function __invoke(): JsonResponse
    {
        $result = call_user_func($this->readBestFilm);

        return new JsonResponse($result);
    }
}