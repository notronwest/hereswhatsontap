<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\Repository\UserRepository")
 * @ORM\Table(name="user",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="user_unique",
 *                columns={"user_username"}
 *               )
 *            }
 *     )
 */
class User extends BaseORMEntity
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="user_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="user_username", length=64)
     */
    protected $username;

    /**
     * @ORM\Column(type="string", name="user_password", length=255)
     */
    protected $password;

    /**
     * @ORM\Column(type="string", name="user_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="datetime", name="user_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="datetime", name="user_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="string", name="user_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="boolean", name="user_active")
     */
    protected $active;

    /**
     * @return mixed
     */
    public function getusername()
    {
        return $this->username;
    }

    /**
     * @param mixed $username
     */
    public function setusername($username): void
    {
        $this->username = $username;
    }

    /**
     * @return mixed
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * @param mixed $password
     */
    public function setPassword($password): void
    {
        $this->password = $password;
    }


}
