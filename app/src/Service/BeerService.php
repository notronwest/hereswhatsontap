<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 4/9/18
 * Time: 7:33 AM
 */

namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use App\Entity\Beer;

class BeerService
{

    private $entityManager;
    private $beerDatabaseService;
    private $breweryService;

    public function __construct(EntityManagerInterface $entityManager, BeerDatabaseService $beerDatabaseService, BreweryService $breweryService)
    {
        $this->entityManager = $entityManager;
        $this->beerDatabaseService = $beerDatabaseService;
        $this->breweryService = $breweryService;
    }

    public function searchForBeer($name, $searchAPI = false)
    {

        // see if this brewery exists in the database already
        $beers = $this->entityManager
            ->getRepository(Beer::class)
            ->findBy(['name' => $name]);

        if (!$beers || $searchAPI) {
            $beersFromAPI = $this->beerDatabaseService->searchForBeer($name);
            // load these into entities
            foreach ($beersFromAPI as &$beer) {
                // get brewery for beer
                $brewery = $this->beerDatabaseService->getBreweryForBeer($beer);
                $beerEntity = $this->loadEntityFromAPI($beer, $this->breweryService->loadEntityFromAPI($brewery));
                if (!in_array($beerEntity, $beers)) {
                    array_push($beers, $beerEntity);
                }
            }

        }
        return $beers;
    }

    public function loadEntityFromAPI($beer, $brewery)
    {
        $beerEntity = new Beer();
        $beerEntity->setName($beer['name']);
        $beerEntity->setAPIID($beer['id']);
        if( array_key_exists('abv', $beer) ) {
            $beerEntity->setAbv($beer['abv']);
        }
        if( array_key_exists('ibu', $beer) ){
            $beerEntity->setIbu(($beer['ibu']));
        }
        $beerEntity->setBrewery($brewery);

        return $beerEntity;
    }

    public function save($beerEntity, $breweryEntity)
    {
        // TODO should check glass data here ...
        $beerEntity->setBrewery($breweryEntity);
        $this->entityManager->persist($breweryEntity);
        $this->entityManager->persist($beerEntity);

        $this->entityManager->flush();

        return $beerEntity;
    }

    public function getByAPIID($APIID)
    {
        // check the database first
        $beer = $this->entityManager
            ->getRepository(Beer::class)
            ->findBy(['APIID'=>$APIID]);

        if( !$beer ) {
            // get the beer from the brewery service
            $beerAPIObject= $this->beerDatabaseService->getBeerByID($APIID);
            // if we have a valid beer object
            if ($beerAPIObject) {
                // get the brewery for this beer
                $breweryAPIObject = $this->beerDatabaseService->getBreweryForBeer($beerAPIObject);
                if( $breweryAPIObject ) {
                    $breweryAPIObject = $breweryAPIObject[0];
                    $breweryEntity = $this->breweryService->getByAPIID($breweryAPIObject['id']);
                    $beerEntity = $this->loadEntityFromAPI($beerAPIObject, $breweryAPIObject);
                    $beer = $this->save($beerEntity, $breweryEntity);
                }
                // TODO exception handle
            }
        } else {
            $beer = $beer[0];
        }
        return $beer;

    }

    private function saveBeers($beers, $brewery)
    {
        // loop through each of the beers and see if they need to be saved
        foreach ($beers as &$beer) {
            // see if this beer exists in the DB
            $savedBeer = $this->entityManager
                ->getRepository(Beer::class)
                ->findBy(['APIID' => $beer['id']]);

            if (!$savedBeer) {
                $this->save($savedBeer);
            }
        }
    }

}