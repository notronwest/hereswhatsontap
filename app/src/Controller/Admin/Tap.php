<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/28/18
 * Time: 8:38 PM
 */

namespace App\Controller\Admin\Tap;

use App\Controller\BaseController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Tap as TapEntity;


class Tap extends BaseController
{

    /**
     * @Route("/admin/taps", name="taps")
     */
    public function indexAction()
    {

        $Taps = $this->getDoctrine()
            ->getRepository(TapEntity::class)
            ->getTaps($this->getCurrentCustomer());

        return $this->render("@App/admin/tap/taps.html.twig",
            [ 'taps' => $Taps ]);

    }

    /**
     * @Route("/admin/taps/edit/{tap_id)", name="editTap")
     */
    public function editAction()
    {
        return $this->render("@App/admin/tap/edittap.html.twig");

    }
}