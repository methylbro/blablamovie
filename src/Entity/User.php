<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Ramsey\Uuid\UuidInterface;
use Ramsey\Uuid\Doctrine\UuidGenerator;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user")
 * @UniqueEntity(fields="email")
 */
class User
{
    use CreationDatetime;

    /**
     * @ORM\Id
     * @ORM\Column(type="string", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UuidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     * @Assert\Email
     */
    public $email;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    public $pseudo = null;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    public $birthday = null;

    public function __construct()
    {
        $this->createdAt = new \DateTime(); 
    }

    public function getId()
    {
        return $this->id;
    }
}
