<?php

namespace App\Domain;

use App\Entity\User;
use App\Repository\FilmChoiceRepository;

class ReadUsersWithFilmChoice
{
    private FilmChoiceRepository $repository;

    public function __construct(FilmChoiceRepository $repository) {
        $this->repository = $repository;
    }

    public function __invoke(): Array
    {
        return $this->repository->findWithFilmChoice();
    }
}