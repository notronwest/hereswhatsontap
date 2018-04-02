<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/31/18
 * Time: 5:42 PM
 */

namespace App;

use App\Entity\Tap;
use Symfony\Bridge\Doctrine\RegistryInterface;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

class BaseRepository extends ServiceEntityRepository
{
     public function __construct(RegistryInterface $registry, $entityName = Tap::class )
     {
         parent::__construct($registry, $entityName);
     }

     public function find($id, $lockMode = NULL, $lockVersion = NULL)
     {
         $entity = $this->createQueryBuilder('e')
             ->where('e.id= :id')->setParameter('id', $id)
             ->getQuery()
             ->getResult()
         ;

         if(!$entity){
             // get a new one
             $entity = new Tap();
         }
         return $entity;
     }
}