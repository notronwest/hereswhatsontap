<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 4/1/18
 * Time: 6:42 PM
 */

namespace App\EventListener;


use App\Entity\Contact;
use Doctrine\ORM\Event\LifecycleEventArgs;
use Symfony\Component\Security\Core\Security;
use DateTime;
use App\Entity\User;

class BaseORMEventListener
{

    private $security;

    public function __construct(Security $security)
    {
        $this->security = $security;
    }


    public function prePersist(LifecycleEventArgs $lifecycleEventArgs){
        $this->updateStamps($lifecycleEventArgs);
    }

    public function preUpdate(LifecycleEventArgs $lifecycleEventArgs){
        $this->updateStamps($lifecycleEventArgs);
    }

    public function updateStamps(LifecycleEventArgs $lifecycleEventArgs)
    {
        if( is_a($this->security->getToken()->getUser(), User::class ) ) {
            $currentUser = $this->security->getToken()->getUser();
            $entityManager = $lifecycleEventArgs->getEntityManager()->getRepository(Contact::class);
            $contact = $entityManager->findBy(['user' => $currentUser]);
            if( $contact ){
                $fullName = $contact[0]->getFullName();
            } else {
                $fullName = 'Authorized Web User';
            }

            $user_id = $currentUser->getID();
        } else {
            $user_id = 'ANON0000000000000000000000000001';
            $fullName = 'Anonymous Web User';
        }

        $entity = $lifecycleEventArgs->getEntity();

        if( !$entity->getAddeddate() ){
            // set the created date
            $entity->setAddeddate(new DateTime('now'));
            // set the user who is creating this
            $entity->setAddedby($user_id);
            $entity->setAddedbyname($fullName);
        }

        // reset the modified date
        $entity->setModifieddate(new DateTime('now'));
        // reset the user who is modifying it
        $entity->setModifiedby($user_id);
        $entity->setModifiedbyname($fullName);

    }

}