<?php

namespace App\Domain;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\FormFactoryInterface;
use App\Entity\User;
use App\Form\UserType;

class CreateUser
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

	public function __invoke(Array $data): User
	{
        $form = $this->formFactory->create(UserType::class);
        $form->submit($data);

        if (!$form->isValid()) {
        	throw new \DomainException(
        		(string) $form->getErrors(true, false)
        	);
        }

        $user = $form->getData();

        $this->entityManager->persist($user);
        $this->entityManager->flush();

        return $user;
	}
}