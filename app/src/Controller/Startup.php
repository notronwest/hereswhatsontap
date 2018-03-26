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

        // add new users
        foreach ($NewUsers as &$thisUser){
            // see if the first user exists
            $UserSearch = $this->getDoctrine()
                ->getRepository(User::class)
                ->findBy(['username' => $thisUser['username']]);


            if (!$UserSearch) {
                // build a new user
                $User = new User();
                $User->setusername($thisUser['username']);
                $User->setPassword($thisUser['password']);
                // persist
                $entityManager->persist($User);
                $entityManager->flush();

            } else {
                $User = $UserSearch[0];
            }

            if( $User ){
                $Contact = $this->getDoctrine()
                    ->getRepository(Contact::class)
                    ->findBy([
                        'user' => $User
                    ]);

                if( !$Contact ){
                    // build the new contact
                    $Contact = new Contact();
                    $Contact->setFirstname($thisUser['firstName']);
                    $Contact->setLastName($thisUser['lastName']);
                    $Contact->setNickname('');
                    $Contact->setAddress('');
                    $Contact->setAddress2('');
                    $Contact->setCity('');
                    $Contact->setState('');
                    $Contact->setZip('');
                    $Contact->setPhone('');
                    $Contact->setEmail('');
                    $Contact->setuser($User);
                    // persist
                    $entityManager->persist($Contact);
                    $entityManager->flush();
                }
            }

        }


        return $this->render("startup/startup.html.twig", [
            "NewUsers" => $NewUsers
        ]);
    }
}