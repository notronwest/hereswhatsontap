<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 4/13/18
 * Time: 8:04 AM
 */

namespace App\Service;


use App\Entity\Contact;
use Doctrine\ORM\EntityManagerInterface;

class ContactService
{
    private $entityManager;
    private $sessionService;
    public function __construct(EntityManagerInterface $entityManager, SessionService $sessionService)
    {
        $this->entityManager    = $entityManager;
        $this->sessionService   = $sessionService;
    }

    public function getContact($user)
    {
        $user = $this->entityManager
            ->getRepository(User::class)
            ->find('1');
    }
}