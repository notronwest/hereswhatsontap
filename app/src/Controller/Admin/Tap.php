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
     * @Route("/admin/tap", name="taps")
     */
    public function listTaps()
    {

        $Taps = $this->getDoctrine()
            ->getRepository(TapEntity::class)
            ->findBy(['location' => $this->sessionService->getCurrentLocation()]);

        return $this->render("@App/admin/tap/list.html.twig", [
            'taps' => $Taps,
            'currentLocation' => $this->sessionService->getCurrentLocation(),
        ]);

    }

    /**
     * @Route("/admin/tap/edit/{tap_id}", name="editTap", defaults={"tap_id" = ""})
     */
    public function editTap($tap_id)
    {

        // if we have a valid tap id passed in then try and get the results

        $tap = $this->getTapByID($tap_id);

        return $this->render("@App/admin/tap/edit.html.twig", [
            'tap' => $tap,
            'location' => $this->sessionService->getCurrentLocation(),
        ]);

    }

    /**
     * @Route("/admin/tap/save", name="saveTap")
     */
    public function saveTap(Request $request)
    {
        $entityManager = $this->getDoctrine()->getManager();

        // get the location
        $location = $this->getDoctrine()
            ->getRepository(\App\Entity\Location::class)
            ->find($request->request->get('location_id'));

        try {
            $tap = $this->getTapByID($request->request->get('tap_id'));
            $tap->setName($request->request->get('tap_name'));
            $tap->setNumberOfTaps($request->request->get('tap_numberoftaps'));
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
            return $this->redirect($this->generateUrl('listBeers', [
                'tap_id' => $tap->getID(),
            ]));
        }
    }

    /**
     * @Route("/admin/tap/delete-confirm/{tap_id}", name="deleteTapConfirm")
     */
    public function deleteTapConfirm($tap_id)
    {

        $tap = $this->getTapByID($tap_id);

        // TODO: Need error handling if the tapid isn't found

        return $this->render('@App/admin/tap/delete.html.twig',[
            'tap' => $tap
        ]);
    }

    public function getTapByID($tap_id)
    {

        $tap = $this->getDoctrine()
            ->getRepository(TapEntity::class)
            ->find($tap_id);

        if(!$tap){
            return new TapEntity();
        } else if (is_array($tap) ){
            return $tap[0];
        } else {
            return $tap;
        }
    }

}