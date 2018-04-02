<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/29/18
 * Time: 9:24 PM
 */

namespace App;


use App\Entity\Customer;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\User;

class BaseController extends Controller
{
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public $entityManager;

    public function getCurrentCustomer()
    {

        try {
            $customer = $this->entityManager->getRepository(User::class)
                ->getCustomer($this->getUser());

            if (!$customer) {
                return new Customer();
            } else {
                return $customer[0];
            }

        } catch ( \Exception $exception){
            throw $exception;
        }

    }

}