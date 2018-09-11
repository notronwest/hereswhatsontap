<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 4/12/18
 * Time: 10:13 PM
 */

namespace App\Service;

use App\Entity\Glass;
use Doctrine\ORM\EntityManagerInterface;
class GlassService
{

    private $entityManager;
    private $beerDatabaseService;

    public function __construct(EntityManagerInterface $entityManager, BeerDatabaseService $beerDatabaseService)
    {
        $this->entityManager = $entityManager;
        $this->beerDatabaseService = $beerDatabaseService;
    }

    public function loadEntityFromAPI($glass)
    {
        $glassEntity = new Glass();
        $glassEntity->setName($glass['name']);
        $glassEntity->setAPIID($glass['id']);

        return $glassEntity;
    }

    public function save($glassEntity)
    {
        $this->entityManager->persist($glassEntity);
        $this->entityManager->flush();

        return $glassEntity;
    }

    public function getByAPIID($APIID)
    {
        // check the database first
        $glass = $this->entityManager
            ->getRepository(Glass::class)
            ->findBy(['APIID'=>$APIID]);

        if( !$glass ) {
            $glassAPIObject= $this->beerDatabaseService->getGlassByID($APIID);
            // if we have a valid glass object
            if ($glassAPIObject) {
                $glassEntity = $this->loadEntityFromAPI($glassAPIObject);
                    $glass = $this->save($glassEntity);
            }
        }
        return $glass;
    }
}