<?php

namespace App\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass="App\Repository\SessionRepository")
 * @ORM\Table(name="sessions")
 */
class Session
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="IDENTITY")
     * @ORM\Column(type="string", name="sess_id", length=128)
     */
    private $id;

    /**
     * @ORM\Column(name="sess_data", type="blob")
     */
    private $sess_data;

    /**
     * @ORM\Column(name="sess_time", type="integer")
     */
    private $sess_time;

    /**
     * @ORM\Column(name="sess_lifetime", type="bigint")
     */
    private $sess_lifetime;
}
