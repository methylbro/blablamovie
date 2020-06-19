<?php

namespace App\Domain;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use App\Entity\User;
use App\Entity\FilmChoice;
use App\Form\FilmChoiceType;

class DeleteFilmChoice
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function __invoke(string $userUuid, string $imdbId): FilmChoice
    {
        $filmchoice = $this
            ->entityManager
            ->getRepository(FilmChoice::class)
            ->findOne($userUuid, $imdbId)
        ;

        if (!$filmchoice) {
            throw new \DomainException("Nothing to be deleted");
        }

        $this->entityManager->remove($filmchoice);
        $this->entityManager->flush();

        return $filmchoice;
    }
}