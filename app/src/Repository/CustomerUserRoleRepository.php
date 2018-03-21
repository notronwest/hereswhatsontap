<?php

namespace App\Repository;

use App\Entity\CustomerUserRole;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CustomerUserRole|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerUserRole|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerUserRole[]    findAll()
 * @method CustomerUserRole[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerUserRoleRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomerUserRole::class);
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
