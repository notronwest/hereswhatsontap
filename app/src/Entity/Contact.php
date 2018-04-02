<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;


/**
 * @ORM\Entity(repositoryClass="App\Repository\ContactRepository")
 * @ORM\Table(name="contact",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="contact_unique",
 *                columns={"user_id"}
 *               )
 *            }
 *     )
 */
class Contact extends BaseORMEntity
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="contact_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="contact_firstname", length=255)
     */
    protected $firstname;

    /**
     * @ORM\Column(type="string", name="contact_lastname", length=255)
     */
    protected $lastname;

    /**
     * @ORM\Column(type="string", name="contact_nickname", length=255, nullable=true)
     */
    protected $nickname;

    /**
     * @ORM\Column(type="string", name="contact_phone", length=10, nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", name="contact_email", length=255, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", name="contact_address", length=1000, nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(type="string", name="contact_address2", length=1000, nullable=true)
     */
    protected $address2;

    /**
     * @ORM\Column(type="string", name="contact_city", length=255, nullable=true)
     */
    protected $city;

    /**
     * @ORM\Column(type="string", name="contact_state", length=36, nullable=true)
     */
    protected $state;

    /**
     * @ORM\Column(type="string", name="contact_zip", length=9, nullable=true)
     */
    protected $zip;

    /**
     * @ORM\Column(type="string", name="contact_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="string", name="contact_addedbyname", length=255)
     */
    protected $addedbyname;

    /**
     * @ORM\Column(type="datetime", name="contact_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="contact_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="string", name="contact_modifiedbyname", length=255)
     */
    protected $modifiedbyname;

    /**
     * @ORM\Column(type="datetime", name="contact_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="boolean", name="contact_active")
     */
    protected $active;

    /**
     * @ManyToOne(targetEntity="user", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="user_id",referencedColumnName="user_id")
     */
    protected $user;

    /**
     * @return mixed
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * @param mixed $firstname
     */
    public function setFirstname($firstname): void
    {
        $this->firstname = $firstname;
    }

    /**
     * @return mixed
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * @param mixed $lastname
     */
    public function setLastname($lastname): void
    {
        $this->lastname = $lastname;
    }

    /**
     * @return mixed
     */
    public function getNickname()
    {
        return $this->nickname;
    }

    /**
     * @param mixed $nickname
     */
    public function setNickname($nickname): void
    {
        $this->nickname = $nickname;
    }

    /**
     * @return mixed
     */
    public function getPhone()
    {
        return $this->phone;
    }

    /**
     * @param mixed $phone
     */
    public function setPhone($phone): void
    {
        $this->phone = $phone;
    }

    /**
     * @return mixed
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @param mixed $email
     */
    public function setEmail($email): void
    {
        $this->email = $email;
    }

    /**
     * @return mixed
     */
    public function getAddress()
    {
        return $this->address;
    }

    /**
     * @param mixed $address
     */
    public function setAddress($address): void
    {
        $this->address = $address;
    }

    /**
     * @return mixed
     */
    public function getAddress2()
    {
        return $this->address2;
    }

    /**
     * @param mixed $address2
     */
    public function setAddress2($address2): void
    {
        $this->address2 = $address2;
    }

    /**
     * @return mixed
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * @param mixed $city
     */
    public function setCity($city): void
    {
        $this->city = $city;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state): void
    {
        $this->state = $state;
    }

    /**
     * @return mixed
     */
    public function getZip()
    {
        return $this->zip;
    }

    /**
     * @param mixed $zip
     */
    public function setZip($zip): void
    {
        $this->zip = $zip;
    }

    /**
     * @return mixed
     */
    public function getuser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setuser($user): void
    {
        $this->user = $user;
    }


    public function getFullName()
    {
        return $this->getFirstname().' '.$this->getLastname();
    }

}
