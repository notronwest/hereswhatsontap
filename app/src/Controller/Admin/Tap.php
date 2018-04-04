<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/28/18
 * Time: 8:38 PM
 */

namespace App\Controller\Admin;

use App\BaseController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tap as TapEntity;


class Tap extends BaseController
{
    /**
     * @Route("/admin/taps", name="taps")
     */
    public function listTaps()
    {

        $Taps = $this->getDoctrine()
            ->getRepository(TapEntity::class)
            ->findBy(['location' => $this->getCurrentLocation()]);

        return $this->render("@App/admin/tap/list.html.twig",
            ['taps' => $Taps, 'currentLocation' => $this->getCurrentLocation()]);

    }

    /**
     * @Route("/admin/taps/edit/{tap_id}", name="editTap", defaults={"tap_id" = ""})
     */
    public function editTap($tap_id)
    {

        // if we have a valid tap id passed in then try and get the results

        $tap = $this->getTap($tap_id);

        return $this->render("@App/admin/tap/edittap.html.twig",
            ['tap' => $tap, 'location' => $this->getCurrentLocation()]);

    }

    /**
     * @Route("/admin/taps/save/", name="saveTap")
     */
    public function saveTap(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        // get the location
        $location = $entityManager->getRepository(\App\Entity\Location::class)
            ->find($request->request->get('location_id'));

        try {
            $tap = $this->getTap($request->request->get('tap_id'));
            $tap->setName($request->request->get('tap_name'));
            $tap->setLocation($location);

            $entityManager->persist($location);
            $entityManager->persist($tap);
            $entityManager->flush();

        } catch (\Exception $exception) {
            throw $exception;
        }

        // send them back to the listing
        if ($request->request->get('save')) {
            return $this->redirect($this->generateUrl( 'taps'));
        } else {
            return $this->editBeers();
        }
    }

    /**
     * @Route("/admin/tap/deleteConfirm/{tap_id}", name="deleteTapConfirm")
     */
    public function deleteTapConfirm($tap_id)
    {

        $tap = $this->getTap($tap_id);

        // TODO: Need error handling if the tapid isn't found

        return $this->render('@App/admin/tap/delete.html.twig',[
            'tap' => $tap
        ]);
    }

    /**
     * @Route("/admin/taps/editBeers/{tap_id}", name="editBeers")
     */
    public function editBeers()
    {
        return $this->render('@App/admin/tap/editbeers.html.twig');
    }

    /**
     * @Route("/admin/taps/save/beers", name="saveBeers")
     */
    public function saveBeers(Request $request)
    {
        return $this->index();
    }

    public function getTap($tap_id)
    {

        $tap = $this->getDoctrine()
            ->getRepository(TapEntity::class)
            ->find($tap_id);

        if($tap){
            return $tap[0];
        } else {
            return new TapEntity();
        }
    }
}