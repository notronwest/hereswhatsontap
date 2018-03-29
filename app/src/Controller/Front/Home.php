<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/4/18
 * Time: 5:05 PM
 */

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class Home extends Controller
{
    /**
     * @Route("/new")
     */
    public function indexAction()
    {
        return $this->render("front/home.html.twig");
    }


    /**
     * @Route("/pricing", name="pricing")
     */
    public function pricingAction()
    {
        return $this->render("front/pricing.html.twig");
    }

    /**
     * @Route("/about", name="about")
     */
    public function aboutAction()
    {
        return $this->render("front/about.html.twig");
    }

    /**
     * @Route("/contact", name="contact")
     */
    public function contactAction()
    {
        return $this->render("front/contact.html.twig");
    }

    /**
     * @Route("/termsofuse", name="terms-of-use")
     */
    public function termsofuseAction()
    {
        return $this->render("front/termsofuse.html.twig");
    }

    /**
     * @Route("/privacypolicy", name="privacy-policy")
     */
    public function privacypolicyAction()
    {
        return $this->render("front/privacypolicy.html.twig");
    }

}