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
use Symfony\Component\HttpFoundation\Session\Storage\Handler\PdoSessionHandler;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

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
    public function startup(EntityManagerInterface $entityManager, PdoSessionHandler $sessionHandlerService, UserPasswordEncoderInterface $encoder){

        try {
            $sessionHandlerService->createTable();
        } catch (\PDOException $exception) {
            // the table could not be created for some reason
        }

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

        // set up customer user role type
        $CustomerUserRoleSearch = $this->getDoctrine()
            ->getRepository(CustomerUserRoleType::class)
            ->findBy([
                'constant' => 'customer_user_role.type.owner'
            ]);

        if( !$CustomerUserRoleSearch ) {
            $CustomerUserRoleType = new CustomerUserRoleType();
            $CustomerUserRoleType->setConstant('customer_user_role.type.owner');
            $entityManager->persist($CustomerUserRoleType);
            $entityManager->flush();
        } else {
            $CustomerUserRoleType = $CustomerUserRoleSearch[0];
        }

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
                $encoded = $encoder->encodePassword($User, $thisUser['password']);
                $User->setPassword($encoded);
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

        // add customer
        $CustomerSearch = $this->getDoctrine()
            ->getRepository(Customer::class)
            ->findBy(['name' => 'East Street Ale House']);

        if( !$CustomerSearch ){
            $Customer = new Customer();
            $Customer->setName('East Street Ale House');
            $Customer->setCustomerType('bar');
            // persist
            $entityManager->persist($Customer);
            $entityManager->flush();

        } else {
            $Customer = $CustomerSearch[0];
        }

        // assign this customer to sean
        $Sean = $this->getDoctrine()
            ->getRepository(User::class)
            ->findBy([
                'username' => 'skuusisaari'
            ]);

        if( $Sean ){
            $CustomerUserRoleCheck = $this->getDoctrine()
                ->getRepository(CustomerUserRole::class)
                ->findBy([
                    'customer' => $Customer,
                    'user' => $Sean[0],
                    'customerUserRoleType' => $CustomerUserRoleType
                ]);

            if( !$CustomerUserRoleCheck ) {
                $CustomerUserRole = new CustomerUserRole();
                $CustomerUserRole->setCustomer($Customer);
                $CustomerUserRole->setuser($Sean[0]);
                $CustomerUserRole->setCustomerUserRoleType($CustomerUserRoleType);
                $entityManager->persist($CustomerUserRole);
                $entityManager->flush();
            }
        }


        return $this->render("startup/startup.html.twig", [
            "NewUsers" => $NewUsers
        ]);
    }
}