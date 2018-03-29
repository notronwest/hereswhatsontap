<?php

namespace App\Repository;

use App\Entity\Tap;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Tap|null find($id, $lockMode = null, $lockVersion = null)
 * @method Tap|null findOneBy(array $criteria, array $orderBy = null)
 * @method Tap[]    findAll()
 * @method Tap[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class TapRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Tap::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('t')
            ->where('t.something = :value')->setParameter('value', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    public function findByCustomer($Customer){
        return $this->createQueryBuilder('t')
        ->where('t.customer = :customer')->setParameter('customer', $Customer)
        ->getQuery()
        ->getResult();
    }
}
