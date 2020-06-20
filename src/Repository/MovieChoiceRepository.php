<?php

namespace App\Repository;

use App\Entity\MovieChoice;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MovieChoiceRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MovieChoice::class);
    }

    public function findOne($UserUuid, $imdbId)
    {
        $query = $this->getEntityManager()->createQuery(
<<<DQL
            SELECT f
            FROM App\Entity\MovieChoice f
            WHERE f.user = :user
              AND f.imdbId = :imdbId
 DQL);
        $query
            ->setParameter('user', $UserUuid)
            ->setParameter('imdbId', $imdbId)
        ;
 
        return $query->getResult();
    }

    public function findBestMovies()
    {
        $query = $this->getEntityManager()->createQuery(
<<<DQL
            SELECT f.imdbId, COUNT(f.imdbId) as total
            FROM App\Entity\MovieChoice f
            GROUP BY f.imdbId
            ORDER BY total DESC
 DQL);
        return $query->getResult();
    }

    public function findByUserUuid($UserUuid)
    {
        $query = $this->getEntityManager()->createQuery(
<<<DQL
            SELECT f.imdbId, f.createdAt
            FROM App\Entity\MovieChoice f
            WHERE f.user = :user
 DQL);
        $query->setParameter('user', $UserUuid);
 
        return $query->getResult();
    }

    public function countByUserUuid($UserUuid)
    {
        $query = $this->getEntityManager()->createQuery(
<<<DQL
            SELECT count(f.imdbId)
            FROM App\Entity\MovieChoice f
            WHERE f.user = :user
            GROUP BY f.user
 DQL);
        $query->setParameter('user', $UserUuid);

        try {
            $result = (int) $query->getSingleResult()[1];
        } catch (\Doctrine\ORM\NoResultException $e) {
            $result = 0;
        }

        return $result;
    }
}
