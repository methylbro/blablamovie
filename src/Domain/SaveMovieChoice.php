<?php

namespace App\Domain;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use App\Entity\User;
use App\Entity\MovieChoice;
use App\Form\MovieChoiceType;

class SaveMovieChoice
{
    const MovieChoiceLimit = 3;

    private EntityManagerInterface $entityManager;
    private FormFactoryInterface $formFactory;

    public function __construct(
        EntityManagerInterface $entityManager,
        FormFactoryInterface $formFactory
    ) {
        $this->entityManager = $entityManager;
        $this->formFactory = $formFactory;
    }

    public function __invoke(string $userUuid, string $imdbId): MovieChoice
    {
        $this->checkHasNotReachMovieChoiceLimit();

        $moviechoice = new MovieChoice();
        $moviechoice->imdbId = $imdbId;
        $moviechoice->user = $this
            ->entityManager
            ->getRepository(User::class)
            ->findOneById($userUuid)
        ;

        $this->entityManager->persist($moviechoice);
        $this->entityManager->flush();

        return $moviechoice;
    }

    /**
     * Chaque utilisateur peut choisir jusqu'à 3 films.
     */
    private function checkHasNotReachMovieChoiceLimit()
    {
        $count = $this
            ->entityManager
            ->getRepository(MovieChoice::class)
            ->countByUserUuid($userUuid)
        ;

        if (self::MovieChoiceLimit <= $count) {
            throw new \DomainException(
                sprintf("Made already %d choices", $count)
            );
        }
    }
}