<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 4/4/18
 * Time: 10:35 PM
 */

namespace App\Controller\Admin;

use App\BaseController;
use App\Entity\TapBeer;
use App\Service\BeerService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tap as TapEntity;
use App\Entity\Beer as BeerEntity;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;

class Beer extends BaseController
{

    private $beerService;

    public function __construct(EntityManagerInterface $entityManager, SessionInterface $session, TokenStorageInterface $tokenStorage, BeerService $beerService)
    {
        parent::__construct($entityManager, $session, $tokenStorage);
        $this->beerService = $beerService;
    }

    /**
     * @Route("/admin/beer/{tap_id}", name="listBeers")
     */
    public function list($tap_id)
    {
        // get the beers for this tap
        $beers = $this->getDoctrine()
            ->getRepository(TapBeer::class)
            ->findBy(['tap' => $this->getTapByID($tap_id)]);

        $tap = $this->getTapByID($tap_id);

        return $this->render('@App/admin/beer/list.html.twig', [
            'tap'   => $tap,
            'beers' => $beers,
        ]);
    }

    /**
     * @Route("/admin/beer/edit/{tap_id}/{beer_id}", name="editBeer", defaults={"beer_id" = ""})
     */
    public function edit($tap_id, $beer_id)
    {

        return $this->render('@App/admin/beer/edit.html.twig', [
            'tap'   => $this->getTapByID($tap_id),
            'beer'  => $this->getBeer($beer_id),
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
     * @Route("/admin/beer/add-beer-to-tap/", name="addBeerToTap")
     */
    public function addBeerToTap(Request $request)
    {
        $tap_id = $request->request->get('tap_id');
        $beer_appid = $request->request->get('beer_appiid');

        $tap = $this->getTapByID($tap_id);
        $beer = $this->beerService->getByAPIID($beer_appid);

        if($tap && $beer){
            // see if this already exists
            $tapBeer = $this->getDoctrine()
                ->getRepository(TapBeer::class)
                ->findBy(['beer'=>$beer, 'tap'=>$tap]);

            if( !$tapBeer ){
                $tapBeer = new TapBeer();
                $tapBeer->setTap($tap);
                $tapBeer->setBeer($beer);
            }

        }
    }

    /**
     * @Route("/admin/beer/save-tap-beers", name="saveTapBeers")
     */
    public function saveTapBeers(Request $request)
    {
        return $this->index();
    }

    public function getTapByID($tap_id)
    {

        $tap = $this->getDoctrine()
            ->getRepository(TapEntity::class)
            ->find($tap_id);

        if(!$tap){
            return new TapEntity();
        } else if (is_array($tap) ) {
            return $tap[0];
        } else {
            return $tap;
        }
    }

    public function getBeer($beer_id)
    {

        $beer = $this->getDoctrine()
            ->getRepository(BeerEntity::class)
            ->find($beer_id);

        if(!$beer){
            return new BeerEntity();
        } else {
            return $beer[0];
        }
    }
}