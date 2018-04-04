<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/29/18
 * Time: 9:24 PM
 */

namespace App;


use App\Entity\Customer;
use App\Entity\Location;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class BaseController extends Controller
{
    public $entityManager;
    public $session;
    public $currentUser;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session, TokenStorageInterface $tokenStorage)
    {
        $this->entityManager = $entityManager;
        $this->session = $session;
        $this->currentUser = $tokenStorage->getToken()->getUser();
        $this->getCurrentCustomer();
        $this->getCurrentLocation();
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
}