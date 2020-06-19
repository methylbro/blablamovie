<?php

namespace App\Domain;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use App\Entity\User;
use App\Entity\FilmChoice;
use App\Form\FilmChoiceType;

class SaveFilmChoice
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

	public function __invoke(string $userUuid, string $imdbId): FilmChoice
	{
		$user = $this->entityManager->getRepository(User::class)->findOneById($userUuid);

		$filmchoice = new FilmChoice();
		$filmchoice->user = $user;
		$filmchoice->imdbId = $imdbId;

        $this->entityManager->persist($filmchoice);
        $this->entityManager->flush();

        return $filmchoice;
	}
}