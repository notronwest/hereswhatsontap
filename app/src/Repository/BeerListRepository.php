<?php

namespace App\Repository;

use App\Entity\BeerList;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method BeerList|null find($id, $lockMode = null, $lockVersion = null)
 * @method BeerList|null findOneBy(array $criteria, array $orderBy = null)
 * @method BeerList[]    findAll()
 * @method BeerList[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class BeerListRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, BeerList::class);
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
