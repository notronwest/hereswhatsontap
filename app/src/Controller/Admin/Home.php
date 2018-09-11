<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/4/18
 * Time: 6:27 PM
 */

namespace App\Controller\Admin;

use App\Service\BeerService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;


class Home extends Controller
{

    private $beerService;
    public function __construct(BeerService $beerService)
    {
        $this->beerService = $beerService;
    }

    /**
     * @Route("/admin/", name="admin")
     **/
    public function indexAction(){
        return $this->render('admin/home.html.twig', [
            'beerData' => $this->beerService->searchForBeer('Long Trail Ale')
        ]);
    }
}