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
            ->findBy(['customer'=>$this->getCurrentCustomer()]);

        return $this->render("list.html.twig",
            ['taps' => $Taps]);

    }

    /**
     * @Route("/admin/taps/edit/{tap_id}", name="editTap", defaults={"tap_id" = ""})
     */
    public function editTap($tap_id)
    {

        // if we have a valid tap id passed in then try and get the results

        $tap = $this->getDoctrine()
            ->getRepository(TapEntity::class)
            ->find($tap_id);

        if($tap){
            $tap = $tap[0];
        } else {
            $tap = new TapEntity();
        }

        return $this->render("@App/admin/tap/edittap.html.twig",
            ['tap' => $tap]);

    }

    /**
     * @Route("/admin/taps/save/", name="saveTap")
     */
    public function saveTap(Request $request)
    {
        $tap_id = $request->request->get('tap_id');

        $entityManager = $this->getDoctrine()->getManager();
        try{
            // do all of the saving and
            $tap = $this->getDoctrine()
                ->getRepository(TapEntity::class)
                ->find($tap_id);
            $tap->setName($request->request->get('tap_name'));
            $tap->setCustomer($this->getCurrentCustomer());
            $entityManager->persist($tap);
            $entityManager->flush();

        } catch ( \Exception $exception ){
            throw $exception;
        }


        // send them back to the listing
        if( $request->request->get('save') ){
            return $this->listTaps();
        } else {
            return $this->editBeers();
        }
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
}