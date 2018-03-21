<?php

namespace App\Repository;

use App\Entity\CustomerUserRoleType;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Symfony\Bridge\Doctrine\RegistryInterface;

/**
 * @method CustomerUserRoleType|null find($id, $lockMode = null, $lockVersion = null)
 * @method CustomerUserRoleType|null findOneBy(array $criteria, array $orderBy = null)
 * @method CustomerUserRoleType[]    findAll()
 * @method CustomerUserRoleType[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class CustomerUserRoleTypeRepository extends ServiceEntityRepository
{
    public function __construct(RegistryInterface $registry)
    {
        parent::__construct($registry, CustomerUserRoleType::class);
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
