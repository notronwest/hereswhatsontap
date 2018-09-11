<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/28/18
 * Time: 8:38 PM
 */

namespace App\Controller\Admin;

use App\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Location as LocationEntity;
use App\Entity\Customer;


class Location extends BaseController
{

    /**
     * @Route("/admin/location", name="locations")
     */
    public function listLocations()
    {

        $customer = $this->sessionService->getCurrentCustomer();

        $locations = $this->getDoctrine()
            ->getRepository(LocationEntity::class)
            ->findBy(['customer' => $this->sessionService->getCurrentCustomer()]);

        return $this->render("@App/admin/location/list.html.twig", [
            'locations' => $locations,
            ]);

    }

    /**
     * @Route("/admin/location/edit/{location_id}", name="editLocation", defaults={"location_id" = ""})
     */
    public function editLocation($location_id)
    {

        // if we have a valid location id passed in then try and get the results
        $location = $this->getLocation($location_id);

        return $this->render("@App/admin/location/edit.html.twig", [
            'location'      => $location,
            'customer_id'   => $this->sessionService->getCurrentCustomer()->getID(),
        ]);

    }

    /**
     * @Route("/admin/location/save/", name="saveLocation")
     */
    public function saveLocation(Request $request)
    {
        $location_id = $request->request->get('location_id');
        $customer = $this->getCustomer($request->request->get('customer_id'));

        // default
        if (!$request->request->get('location_default'))
        {
            $request->request->set('location_default', 0);
        }

        $entityManager = $this->getDoctrine()->getManager();
        try {
            // do all of the saving and
            $location = $this->getLocation($location_id);

            $location->setName($request->request->get('location_name'));
            $location->setAddress($request->request->get('location_address'));
            $location->setAddress2($request->request->get('loation_address2'));
            $location->setCity($request->request->get('location_city'));
            $location->setState($request->request->get('location_state'));
            $location->setZip($request->request->get('location_zip'));
            $location->setPhone($request->request->get('location_phone'));
            $location->setDefault($request->request->get('location_default'));
            $location->setCustomer($customer);

            $oldDefault = $this->getDefaultLocation();
            // before saving this location handle defaulting
            if( $oldDefault->getID() != NULL && $oldDefault != $location ) {
                $oldDefault->setDefault(0);
                $entityManager->persist($oldDefault);
            }

            // save entity to DB
            $entityManager->persist($customer);
            $entityManager->persist($location);
            $entityManager->flush();



        } catch (\Exception $exception) {
            throw $exception;
        }

        // TODO: add message

        return $this->redirect($this->generateUrl('locations'));
    }

    /**
     * @Route("/admin/location/delete-confirm/{location_id}", name="deleteLocationConfirm")
     */
    public function deleteLocationConfirm($location_id)
    {

        return $this->render("@App/admin/location/delete.html.twig", [
            'location' => $this->getLocation($location_id)
        ]);
    }

    /**
     * @Route("/admin/location/delete/{location_id}", name="deleteLocation")
     */
    public function deleteLocation($location_id)
    {
        // TODO: Need to add some verification that this location is valid
        $location = $this->getLocation($location_id);

        $entityManager = $this->getDoctrine()
            ->getManager();
        $customer = $location->getCustomer();
        $entityManager->remove($location);
        $entityManager->persist($customer);
        $entityManager->flush();

        // TODO: add message
        return $this->redirect($this->generateUrl('locations'));
    }

    /**
     * @Route("/admin/location/current-list/{returnURL}", name="currentLocation", requirements={"returnURL"=".+"})
     */
    public function currentLocationList($returnURL)
    {
        $locations = $this->getDoctrine()
            ->getRepository(LocationEntity::class)
            ->findBy(['customer' => $this->sessionService->getCurrentCustomer()]);

        return $this->render("@App/admin/location/current_location_list.html.twig", [
            'locations' => $locations,
            'returnURL' => $returnURL,
            'currentLocation' => $this->getCurrentLocation(),
        ]);
    }

    /**
     * @Route("/admin/location/set-current/{location_id}/{returnURL}", name="setCurrentLocation", requirements={"returnURL"=".+"})
     */
    public function handleCurrentLocation($location_id, $returnURL)
    {
        $this->setCurrentLocation($this->getLocation($location_id));

        return $this->redirect($returnURL);

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

    function getCustomer($customer_id)
    {
        $customer = $this->getDoctrine()
            ->getManager()
            ->getRepository(Customer::class)
            ->find($customer_id);

        if (!$customer) {
            // need to do some error handling here
            $customer = new Customer();
        }

        return $customer;
    }
}
