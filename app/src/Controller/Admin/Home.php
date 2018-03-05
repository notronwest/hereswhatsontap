<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/4/18
 * Time: 6:27 PM
 */

namespace App\Controller\Admin;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class Home extends Controller
{

    /**
     * @Route("/admin/", name="admin")
     **/
    public function indexAction(){
        return $this->render('admin/home.html.twig');
    }
}