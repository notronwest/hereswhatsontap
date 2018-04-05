<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 4/4/18
 * Time: 10:35 PM
 */

namespace App\Controller\Admin;

use App\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tap as TapEntity;
use App\Entity\Beer as BeerEntity;

class Beer extends BaseController
{
    /**
     * @Route("/admin/beer/{tap_id}", name="listBeers")
     */
    public function list($tap_id)
    {
        return $this->render('@App/admin/beer/list.html.twig', [
            'tap' => $this->getTap($tap_id),
        ]);
    }

    /**
     * @Route("/admin/beer/edit/{tap_id}/{beer_id}", name="editBeer", defaults={"beer_id" = ""})
     */
    public function edit($tap_id, $beer_id)
    {
        $beer = $this->getBeer($beer_id);
        return $this->render('@App/admin/beer/edit.html.twig', [
            'tap_id' => $tap_id,
            'beer_id' => $beer,
        ]);
    }


    /**
     * @Route("/admin/beer/save", name="saveBeer")
     */
    public function save(Request $request)
    {
        return $this->redirect($this->generateUrl('listBeers',[
            'tap_id' => $request->request->get('tap_id'),
        ]));
    }

    /**
     * @Route("/admin/beer/save-tap-beers", name="saveTapBeers")
     */
    public function saveTapBeers(Request $request)
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

    public function getBeer($beer_id)
    {

        $beer = $this->getDoctrine()
            ->getRepository(BeerEntity::class)
            ->find($beer_id);

        if($beer){
            return $beer[0];
        } else {
            return new BeerEntity();
        }
    }
}