<?php

namespace App\Domain;

use App\Entity\FilmChoice;
use App\Repository\FilmChoiceRepository;

class ReadBestFilm
{
    private FilmChoiceRepository $repository;

    public function __construct(FilmChoiceRepository $repository) {
        $this->repository = $repository;
    }

    public function __invoke(): Array
    {
        $result = $this->repository->findBestFilms();

        return $result;
    }
}