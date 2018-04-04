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


class Location extends BaseController
{

    /**
     * @Route("/admin/locations", name="locations")
     */
    public function listLocations()
    {

        $Locations = $this->getDoctrine()
            ->getRepository(LocationEntity::class)
            ->findBy(['customer' => $this->getCurrentCustomer()]);

        return $this->render("@App/admin/location/list.html.twig",
            ['locations' => $Locations]);

    }

    /**
     * @Route("/admin/locations/edit/{location_id}", name="editLocation", defaults={"location_id" = ""})
     */
    public function editLocation($location_id)
    {

        // if we have a valid location id passed in then try and get the results

        $location = $this->getLocation($location_id);

        return $this->render("@App/admin/location/edit.html.twig",
            ['location' => $location]);

    }

    /**
     * @Route("/admin/locations/save/", name="saveLocation")
     */
    public function saveLocation(Request $request)
    {
        $location_id = $request->request->get('location_id');

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
            $location->setCustomer($this->getCurrentCustomer());

            $oldDefault = $this->getDefaultLocation();
            // before saving this location handle defaulting
            if( $oldDefault->getID() != NULL && $oldDefault != $location ) {
                $oldDefault->setDefault(0);
                $entityManager->persist($oldDefault);
            }

            // save entity to DB
            $entityManager->persist($location);
            $entityManager->flush();



        } catch (\Exception $exception) {
            throw $exception;
        }

        // TODO: add message

        return $this->redirect($this->generateUrl('locations'));
    }

    /**
     * @Route("/admin/location/deleteConfirm/{location_id}", name="deleteLocationConfirm")
     */
    public function deleteLocationConfirm($location_id)
    {

        return $this->render("@App/admin/location/delete.html.twig", [
            'location' => $this->getLocation($location_id)
        ]);
    }

    /**
     * @Route("/admin/location/deleteLocation/{location_id}", name="deleteLocation")
     */
    public function deleteLocation($location_id)
    {
        // TODO: Need to add some verification that this location is valid
        $location = $this->getLocation($location_id);

        $entityManager = $this->getDoctrine()
            ->getManager();
        $entityManager->remove($location);
        $entityManager->flush();

        // TODO: add message
        return $this->redirect($this->generateUrl('locations'));
    }

    function getLocation($location_id)
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

}