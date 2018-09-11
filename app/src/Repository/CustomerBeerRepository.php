<?php

namespace App\Repository;

use App\Entity\CustomerBeer;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CustomerBeer|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerBeer|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerBeer[]    findAll()
 * @method CustomerBeer[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerBeerRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomerBeer::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('c')
            ->where('c.something = :value')->setParameter('value', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
