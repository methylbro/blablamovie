<?php

namespace App\Domain;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use App\Entity\User;
use App\Entity\MovieChoice;
use App\Form\MovieChoiceType;

class SaveMovieChoice
{
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
		$user = $this->entityManager->getRepository(User::class)->findOneById($userUuid);

		$moviechoice = new MovieChoice();
		$moviechoice->user = $user;
		$moviechoice->imdbId = $imdbId;

        $this->entityManager->persist($moviechoice);
        $this->entityManager->flush();

        return $moviechoice;
	}
}