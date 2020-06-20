<?php

namespace App\Domain;

use App\Entity\MovieChoice;
use App\Repository\MovieChoiceRepository;

class ReadBestMovie
{
    private MovieChoiceRepository $repository;

    public function __construct(MovieChoiceRepository $repository) {
        $this->repository = $repository;
    }

    public function __invoke(): Array
    {
        $result = $this->repository->findBestMovies();

        return $result;
    }
}