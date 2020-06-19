<?php

namespace App\Repository;

use App\Entity\FilmChoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class FilmChoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, FilmChoice::class);
    }

    public function findOne($userId, $imdbId)
    {
        $query = $this->getEntityManager()->createQuery(
<<<DQL
            SELECT f
            FROM App\Entity\FilmChoice f
            WHERE f.user = :user
              AND f.imdbId = :imdbId
 DQL);
        $query
            ->setParameter('user', $userId)
            ->setParameter('imdbId', $imdbId)
        ;
 
        return $query->getResult();
    }

    public function findBestFilms()
    {
        $query = $this->getEntityManager()->createQuery(
<<<DQL
            SELECT f.imdbId, COUNT(f.imdbId) as total
            FROM App\Entity\FilmChoice f
            GROUP BY f.imdbId
            ORDER BY total DESC
 DQL);
        return $query->getResult();
    }

    public function findByUserId($userId)
    {
        $query = $this->getEntityManager()->createQuery(
<<<DQL
            SELECT f.imdbId, f.createdAt
            FROM App\Entity\FilmChoice f
            WHERE f.user = :user
 DQL);
        $query->setParameter('user', $userId);
 
        return $query->getResult();
    }
}
