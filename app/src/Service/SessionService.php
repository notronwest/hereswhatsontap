<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 4/11/18
 * Time: 11:37 PM
 */

namespace App\Service;


use App\Entity\Customer;
use App\Entity\Location;
use App\Entity\User;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class SessionService
{

    private $session;
    private $entityManager;
    private $currentUser;
    public function __construct(SessionInterface $session, EntityManagerInterface $entityManager, TokenStorageInterface $tokenStorage)
    {
        $this->session=$session;
        $this->entityManager=$entityManager;
        $this->currentUser = $tokenStorage->getToken()->getUser();
    }

    public function getCurrentCustomer()
    {
        if (!$this->session->has('currentCustomer')) {
            try {
                $customer = $this->entityManager->getRepository(User::class)
                    ->getCustomer($this->currentUser);

                if (!$customer) {
                    $this->session->set('currentCustomer', new Customer());
                } else {
                    $this->session->set('currentCustomer', $customer[0]);
                }

            } catch (\Exception $exception) {
                throw $exception;
            }

        }
        return $this->session->get('currentCustomer');

    }

    public function getCurrentCustomerEntity()
    {
        return $this->entityManager
            ->getRepository(Customer::class)
            ->find($this->getCurrentCustomer().getID());
    }

    public function getCurrentLocation()
    {

        if( !$this->session->get('currentLocation') ){
            $defaultLocation = $this->getDefaultLocation();

            if( $defaultLocation->getID() != NULL ){
                $this->session->set('currentLocation', $defaultLocation);
            }
        }
        return $this->session->get('currentLocation');

    }

    public function setCurrentLocation(Location $location)
    {
        $this->session->set('currentLocation', $location);
    }

    public function getDefaultLocation()
    {
        try {
            $location = $this->entityManager->getRepository(Location::class)
                ->findBy(['default' => 1, 'customer' => $this->getCurrentCustomer()]);

            if (!$location) {
                return new Customer();
            } else {
                return $location[0];
            }

        } catch ( \Exception $exception){
            throw $exception;
        }
    }

    public function getLocationCount()
    {
        return count($this->getLocations());
    }

    public function getLocations()
    {
        try{
            $locations = $this->entityManager
                ->getRepository(Location::class)
                ->findBy(['customer'=> $this->getCurrentCustomer()]);

            return $locations;

        } catch( \Exception $exception ){
            // TODO handle exceptions
        }
    }

    public function getCurrentLocationEntity()
    {
        return $this->entityManager
            ->getRepository(Location::class)
            ->find($this->getCurrentLocation().getID());
    }
}