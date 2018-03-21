<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/17/18
 * Time: 2:59 PM
 */

namespace App\Controller;

use Doctrine\DBAL\Connection;
use Doctrine\ORM\EntityManagerInterface;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Customer;
use App\Entity\User;
use App\Entity\Contact;
use App\Entity\CustomerUserRole;
use App\Entity\CustomerUserRoleType;
use App\Entity\Location;
use App\Entity\Beer;

class Startup extends Controller
{

    /**
     * @Route("/test")
     */
    public function testAction(Connection $connection){
        $users = $connection->fetchAll('SELECT * FROM users');

        return $this->render("startup/startup.html/twig", [
            "NewUser" => $users
        ]);
    }

    /**
     * @Route("/startup", name="startup")
     */
    public function startup(EntityManagerInterface $entityManager){

        $AllUsers = [];

        $NewUsers = [
            [
                'firstName'=>'Ron',
                'lastName'=>'West',
                'username'=>'notronwest',
                'password'=>'password'
            ],
            [
                'firstName'=>'Sean',
                'lastName'=>'Kuusisaari',
                'username'=>'skuusisaari',
                'password'=>'password'
            ]
        ];

        foreach ($NewUsers as &$thisUser){
            // see if the first user exists
            $User = $this->getDoctrine()
                ->getRepository(Beer::class)
                ->findAll();
                //->findBy(['username' => $thisUser['username']]);

            if (!$User) {
                // build a new user
                $User = new User();
                $User->setAddeddate(new \DateTime());
            }
        }


        return $this->render("startup/startup.html.twig", [
            "NewUsers" => $NewUsers
        ]);
    }
}