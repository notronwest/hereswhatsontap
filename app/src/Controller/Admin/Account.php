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

class Account extends Controller
{

    /**
     * @Route("/admin/account/profile", name="profile")
     */
    public function profileAction(){
        return $this->render("admin/account/profile.html.twig");
    }

    /**
     * @Route("/admin/account/credentials", name="credentials")
     */
    public function credentialsAction(){
        return $this->render("admin/account/credentials.html.twig");
    }

    /**
     * @Route("/admin/account/security", name="security")
     */
    public function securityAction(){
        return $this->render("admin/account/security.html.twig");
    }
}