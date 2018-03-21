<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/13/18
 * Time: 4:28 PM
 */

namespace App\Controller\Admin;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class Customer extends Controller
{

    /**
     * @Route("/admin/customer/profile", name="customer_profile")
     */
    public function profileAction(){
        return $this->render("admin/customer/profile.html.twig");
    }

    /**
     * @Route("/admin/customer/locations", name="customer_locations")
     */
    public function locationsAction(){
        return $this->render("admin/customer/locations.html.twig");
    }

    /**
     * @Route("/admin/customer/location/{location_id}", name="customer_location")
     */
    public function locationAction(){
        return $this->render("admin/customer/locations.html.twig");
    }

    /**
     * @Route("/admin/customer/taps", name="customer_taps");
     */
    public function tapsAction(){
        return $this->render("admin/customer/taps.html.twig");
    }

    /**
     * @Route("/admin/customer/tap/{tap_id}", name="customer_tap");
     */
    public function tapAction(){
        return $this->render("admin/customer/tap.html.twig");
    }

    /**
     * @Route("/admin/customer/beerlists", name="customer_beerlists");
     */
    public function beerlistsAction(){
        return $this->render("admin/customer/beerlists.html.twig");
    }

    /**
     * @Route("/admin/customer/beerlist/{beerlist_id}", name="customer_beerlist");
     */
    public function beerlistAction(){
        return $this->render("admin/customer/beerlist.html.twig");
    }
}