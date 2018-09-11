<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 4/11/18
 * Time: 11:34 PM
 */

namespace App\Service;

use App\Entity\CustomerBeer;
use Doctrine\ORM\EntityManagerInterface;

class CustomerBeerService
{
    private $entityManager;
    private $beerDatabaseService;
    private $breweryService;
    private $sessionService;

    public function __construct(EntityManagerInterface $entityManager, BeerDatabaseService $beerDatabaseService, BreweryService $breweryService, SessionService $sessionService)
    {
        $this->entityManager            = $entityManager;
        $this->beerDatabaseService      = $beerDatabaseService;
        $this->breweryService           = $breweryService;
        $this->sessionService           = $sessionService;
    }

    public function getBeers()
    {
        return $this->entityManager
            ->getRepository(CustomerBeer::class)
            ->findBy([
                'customer' => $this->sessionService->getCurrentCustomer(),
            ]);
    }
}