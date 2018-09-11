<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 4/5/18
 * Time: 9:13 PM
 */

namespace App\Controller\Admin;


use App\BaseController;
use App\Entity\Brewery;
use App\Entity\Beer;
use App\Service\BeerService;
use App\Service\BreweryService;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class BeerDatabase extends BaseController
{

    private $beerService;
    private $breweryService;

    public function __construct(BeerService $beerService, BreweryService $breweryService)
    {
        $this->beerService      =   $beerService;
        $this->breweryService   =   $breweryService;
    }

    /**
     * @Route("/admin/beer-search/search-for-breweries/{name}/{doAPISearch}", name="searchForBreweries", defaults={"name"="", "doAPISearch"=false})
     */
    public function searchForBreweries(Request $request, $name, $doAPISearch)
    {
        $breweries = [];
        if (!$name) {
            // look in post
            if( $request->request->has('name')){
                $name = $request->request->get('name');
            }
        }

        if($name){
            $breweries = $this->breweryService->searchForBreweries($name);
        }

        return $this->render('@App/admin/beer_database/brewery.html.twig', [
            'breweries' => $breweries
        ]);
    }

    /**
     * @Route("/admin/beer-search/search-for-beers/{name}/{doAPISearch}", name="searchForBeers", defaults={"name"="", "doAPISearch"=false})
     */
    public function searchForBeers(Request $request, $name, $doAPISearch)
    {
        if (!$name) {
            // look in post
            if( $request->request->has('name')){
                $name = $request->request->get('name');
            }
        }
        $beers = $this->beerService->searchForBeer($name);
        return $this->render('@App/admin/beer_database/beer.html.twig', [
            'beers' => $beers,
            'name'  => $name,
        ]);
    }

    /**
     * @Route("/admin/beer-search/save-brewery/{APIID}", name="saveBrewery")
     */
    public function saveBrewery($APIID)
    {

        // get the brewery by APIID
        $brewery = $this->breweryService->getByAPIID($APIID);
        // save the brewery
        $this->breweryService->save($brewery);

        // TODO add message
        return $this->redirect($this->generateUrl('searchFoBreweries', ['name' => $brewery->getName()]));

    }


    /**
     * @Route("/admin/beer-search/save-beer/{APIID}", name="saveBeer")
     */
    public function saveBeer($APIID)
    {
        // get the beer by APPID
        $beer = $this->beerService->getByAPIID($APIID);
        // save the beer
        $this->beerService->save($beer, $beer->getBrewery());
        // TODO add message
        return $this->redirect($this->generateUrl('searchForBeers', ['name' => $beer->getName()]));

    }

}