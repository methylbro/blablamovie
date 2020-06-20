<?php

namespace App\Domain;

use App\Entity\MovieChoice;
use App\Repository\MovieChoiceRepository;

class ReadMovieChoices
{
    private MovieChoiceRepository $repository;

    public function __construct(MovieChoiceRepository $repository) {
        $this->repository = $repository;
    }

    public function __invoke(string $userUuid): Array
    {
        return $this->repository->findByUserId($userUuid);
    }
}