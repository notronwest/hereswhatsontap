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
use App\Entity\Brewery;
use App\Entity\Glass;

class BreweryService
{

    private $entityManager;
    private $beerDatabaseService;

    public function __construct(EntityManagerInterface $entityManager, BeerDatabaseService $beerDatabaseService)
    {
        $this->entityManager = $entityManager;
        $this->beerDatabaseService = $beerDatabaseService;
    }

    public function save($breweryEntity)
    {
        $this->entityManager->persist($breweryEntity);
        $this->entityManager->flush();

        return $breweryEntity;
    }

    public function searchForBreweries($name, $searchAPI=false)
    {
        // see if this brewery exists in the database already
        $breweries = $this->entityManager
            ->getRepository(Brewery::class)
            ->findBy(['name' => $name]);

        if (!$breweries || $searchAPI) {
            $breweriesFromAPI = $this->beerDatabaseService->searchForBrewery($name);
            foreach ($breweriesFromAPI as &$brewery)
            {
                $breweryEntity = $this->loadEntityFromAPI($brewery);
                if( !in_array($breweryEntity, $breweries) ) {
                    array_push($breweries, $breweryEntity);
                }
            }
        }
        return $breweries;
    }

    public function getByAPIID($APIID)
    {
        // make sure its not in the db already
        $brewery = $this->entityManager
            ->getRepository(Brewery::class)
            ->findBy(['APIID'=>$APIID]);

        if( !$brewery ) {
            // get tbe brewery from the API
            $breweryAPIObject = $this->beerDatabaseService->getBreweryByID($APIID);

            if ($breweryAPIObject) {
                $brewery = $this->loadEntityFromAPI($breweryAPIObject);
                // TODO exception handle
            }
        } else {
            $brewery = $brewery[0];
        }

        return $brewery;

    }

    public function loadEntityFromAPI($brewery)
    {
        if( is_array($brewery) && !array_key_exists('id', $brewery)  ){
            $brewery = $brewery[0];
        }
        $breweryEntity = new Brewery();
        $breweryEntity->setName($brewery['name']);
        if( array_key_exists('description', $brewery) ) {
            $breweryEntity->setDescription($brewery['description']);
        }
        if( array_key_exists('website', $brewery) ) {
            $breweryEntity->setWebsite($brewery['website']);
        }
        if( array_key_exists('established', $brewery) ) {
            $breweryEntity->setYear($brewery['established']);
        }
        if( array_key_exists( 'images', $brewery) ){
            $breweryEntity->setImages(json_encode($brewery['images']));
        }
        $breweryEntity->setAPIID($brewery['id']);

        return $breweryEntity;
    }

    private function saveBreweries($breweries)
    {
        foreach($breweries as &$brewery){
            // see if the brewery already exits
            $savedBrewery = $this->entityManager
                ->getRepository( Brewery::class)
                ->findBy(['APIID'=>$brewery['id']]);

            if(!$savedBrewery){
                $this->save($savedBrewery);
            }

        }
    }
}