<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\FilmChoiceRepository")
 * @ORM\Table(name="filmchoice")
 */
class FilmChoice
{
    use CreationDatetime;

    /**
     * @ORM\Id
     * @ORM\ManyToOne(targetEntity="App\Entity\User")
     * @ORM\JoinColumn(name="user", referencedColumnName="id")
     * @ORM\JoinColumn(nullable=false)
     */
    public User $user;

    /**
     * @ORM\Id
     * @ORM\Column(type="string", length=255)
     */
    public string $imdbId;

    public function __construct()
    {
        $this->createdAt = new \DateTime(); 
    }
}
