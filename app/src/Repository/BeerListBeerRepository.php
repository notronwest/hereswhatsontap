<?php

namespace App\Repository;

use App\Entity\BeerListBeer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BeerListBeer|null find($id, $lockMode = null, $lockVersion = null)
 * @method BeerListBeer|null findOneBy(array $criteria, array $orderBy = null)
 * @method BeerListBeer[]    findAll()
 * @method BeerListBeer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeerListBeerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BeerListBeer::class);
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
