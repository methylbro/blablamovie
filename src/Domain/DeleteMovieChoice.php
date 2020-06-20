<?php

namespace App\Domain;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use App\Entity\User;
use App\Entity\MovieChoice;
use App\Form\MovieChoiceType;

class DeleteMovieChoice
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(string $userUuid, string $imdbId): MovieChoice
    {
        $moviechoice = $this
            ->entityManager
            ->getRepository(MovieChoice::class)
            ->findOne($userUuid, $imdbId)
        ;

        if (!$moviechoice) {
            throw new \DomainException("Nothing to be deleted");
        }

        $this->entityManager->remove($moviechoice);
        $this->entityManager->flush();

        return $moviechoice;
    }
}