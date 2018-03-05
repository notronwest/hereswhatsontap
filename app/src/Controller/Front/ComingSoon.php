<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/4/18
 * Time: 8:12 PM
 */

namespace App\Controller\Front;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ComingSoon extends Controller
{

    /**
     * @Route("/", name="home")
     */
    public function indexAction(){
        return $this->render('front/coming_soon.html.twig');
    }
}