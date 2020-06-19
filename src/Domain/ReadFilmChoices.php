<?php

namespace App\Domain;

use App\Entity\FilmChoice;
use App\Repository\FilmChoiceRepository;

class ReadFilmChoices
{
    private FilmChoiceRepository $repository;

    public function __construct(FilmChoiceRepository $repository) {
        $this->repository = $repository;
    }

    public function __invoke(string $userUuid): Array
    {
        return $this->repository->findByUserId($userUuid);
    }
}