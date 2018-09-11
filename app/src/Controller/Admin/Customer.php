<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/13/18
 * Time: 4:28 PM
 */

namespace App\Controller\Admin;


use App\BaseController;
use App\Entity\CustomerBeer;
use App\Entity\Glass;
use App\Entity\Tap;
use App\Entity\Beer;
use App\Entity\Customer as CustomerEntity;
use App\Entity\Location as LocationEntity;
use App\Service\BeerService;
use App\Service\CustomerBeerService;
use App\Service\SessionService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class Customer
 * @package App\Controller\Admin
 * @Route("/admin/customer")
 */
class Customer extends BaseController
{

    private $customerBeerService;
    private $beerService;
    public function __construct(CustomerBeerService $customerBeerService, BeerService $beerService, SessionService $sessionService)
    {
        parent::__construct($sessionService);
        $this->customerBeerService  = $customerBeerService;
        $this->beerService          = $beerService;
    }

    /**
     * @Route("/profile", name="customer_profile")
     */
    public function profileAction(){
        return $this->render("admin/customer/profile.html.twig");
    }

    /**
     * @Route("/beer/list", name="customerBeers")
     */
    public function beers(){

        $beers = $this->customerBeerService->getBeers();
        return $this->render("@App/admin/customer/beers.html.twig", [
            'beers' => $beers,
            'currentLocation' => $this->sessionService->getCurrentLocation(),
            'numberOfLocations' => $this->sessionService->getLocationCount(),
        ]);
    }

    /**
     * @Route("/beer/edit/{uniqueID}", name="editBeer")
     */
    public function edit($uniqueID)
    {
        // get all of the glasses
        $glasses = $this->getDoctrine()
            ->getRepository(Glass::class)
            ->findAll();

        $taps = $this->getDoctrine()
            ->getRepository(Tap::class)
            ->findBy([
                'location' => $this->sessionService->getCurrentLocation(),
            ]);


        // first see if we have a customer beer id
        $customerBeerEntity = $this->getDoctrine()
            ->getRepository(CustomerBeer::class)
            ->find($uniqueID);


        if( !$customerBeerEntity ) {
            // must be an APIID -- try and see if this beer exists
            $beer = $this->getDoctrine()
                ->getRepository(\App\Entity\Beer::class)
                ->findBy([
                    'APIID' => $uniqueID,
                ]);

            // if it isn't saved yet build the object to work with
            if (!$beer) {
                $beer = $this->beerService->getByAPIID($uniqueID);
            } else {
                $beer = $beer[0];
            }

            // see if this beer exists for this customer
            $customerBeerEntity = $this->getDoctrine()
                ->getRepository(CustomerBeer::class)
                ->findBy([
                    'beer' => $beer,
                    'customer' => $this->sessionService->getCurrentCustomer(),
                ]);

            // if we still don't have a valid entity, create a new one
            if (!$customerBeerEntity) {
                $customerBeerEntity = new CustomerBeer();
                $customerBeerEntity->setBeer($beer);
                $customerBeerEntity->setCustomer($this->sessionService->getCurrentCustomer());
            }
        }
        // send to edit screen
        return $this->render('@App/admin/customer/beer.html.twig', [
            'customerBeer'          => $customerBeerEntity,
            'glasses'               => $glasses,
            'taps'                  => $taps,
            'numberOfLocations'     => $this->sessionService->getLocationCount(),
        ]);
    }

    /**
     * @Route("/beer/save", name="customerBeerSave")
     */
    public function save(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();
        // get the fields from te form
        $customerBeerID = $request->request->get('customer_beer_id');
        $beer_id        = $request->request->get('beer_id');
        $tap_id         = $request->request->get('customer_beer_tap');
        $glass_id       = $request->request->get('customer_beer_glass');
        $price          = $request->request->get('customer_beer_price');
        $tapDate        = $request->request->get('customer_beer_tapdate');

        // TODO ERROR CHECK ALL VARIABLES
        $beer = $this->getDoctrine()
            ->getRepository(Beer::class)
            ->find($beer_id);
        $tap = $this->getDoctrine()
            ->getRepository(Tap::class)
            ->find($tap_id);
        $glass = $this->getDoctrine()
            ->getRepository(Glass::class)
            ->find($glass_id);
        $customer = $this->getCustomerEntity($this->sessionService->getCurrentCustomer()->getID());
        $location = $this->getLocation($this->sessionService->getCurrentLocation()->getID());


        if( strlen($customerBeerID) ) {
            $customerBeer = $this->getDoctrine()
                ->getRepository(CustomerBeer::class)
                ->find($customerBeerID);
        } else {
            $customerBeer = new CustomerBeer();
        }

        if($tap){
            $tap = $tap[0];
        }

        $customerBeer->setCustomer($customer);
        $customerBeer->setBeer($beer);
        $customerBeer->setGlass($glass);
        $customerBeer->getLocation($location);
        $customerBeer->setPrice($price);
        $customerBeer->setTap($tap);
        $customerBeer->setTapdate(date_create_from_format('m/d/Y', $tapDate));

        $entityManager->persist($beer);
        $entityManager->persist($location);
        $entityManager->persist($customer);
        $entityManager->persist($tap);
        $entityManager->persist($glass);
        $entityManager->persist($customerBeer);

        $entityManager->flush();


        // TODO add message
        return $this->redirectToRoute('customerBeers');
    }

    private function getLocation($location_id)
    {
        $location = $this->getDoctrine()
            ->getManager()
            ->getRepository(LocationEntity::class)
            ->find($location_id);

        if (!$location) {
            // need to do some error handling here
            $location = new LocationEntity();
        }

        return $location;
    }

    function getCustomerEntity($customer_id)
    {
        $customer = $this->getDoctrine()
            ->getManager()
            ->getRepository(CustomerEntity::class)
            ->find($customer_id);

        if (!$customer) {
            // need to do some error handling here
            $customer = new CustomerEntity();
        }

        return $customer;
    }

}