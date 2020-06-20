<?php

namespace App\Domain;

use App\Entity\User;
use App\Repository\MovieChoiceRepository;

class ReadUsersWithMovieChoice
{
    private MovieChoiceRepository $repository;

    public function __construct(MovieChoiceRepository $repository) {
        $this->repository = $repository;
    }

    public function __invoke(): Array
    {
        return $this->repository->findWithMovieChoice();
    }
}