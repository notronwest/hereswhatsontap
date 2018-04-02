<?php

namespace App\Repository;

use App\Entity\TapBeer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method TapBeer|null find($id, $lockMode = null, $lockVersion = null)
 * @method TapBeer|null findOneBy(array $criteria, array $orderBy = null)
 * @method TapBeer[]    findAll()
 * @method TapBeer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TapBeerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, TapBeer::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('b')
            ->where('b.something = :value')->setParameter('value', $value)
            ->orderBy('b.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
