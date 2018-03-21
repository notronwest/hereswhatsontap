<?php

namespace App\Repository;

use App\Entity\Glass;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method Glass|null find($id, $lockMode = null, $lockVersion = null)
 * @method Glass|null findOneBy(array $criteria, array $orderBy = null)
 * @method Glass[]    findAll()
 * @method Glass[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class GlassRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, Glass::class);
    }

    /*
    public function findBySomething($value)
    {
        return $this->createQueryBuilder('g')
            ->where('g.something = :value')->setParameter('value', $value)
            ->orderBy('g.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */
}
