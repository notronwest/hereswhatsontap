<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\Repository\LocationRepository")
 * @ORM\Table(name="location",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="location_unique",
 *                columns={"location_name", "customer_id"}
 *               )
 *            }
 *     )
 */
class Location extends BaseORMEntity
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="location_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="location_name", length=500)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", name="location_address", length=1000)
     */
    protected $address;

    /**
     * @ORM\Column(type="string", name="location_address2", length=1000)
     */
    protected $address2;

    /**
     * @ORM\Column(type="string", name="location_city", length=255)
     */
    protected $city;

    /**
     * @ORM\Column(type="string", name="location_state", length=255)
     */
    protected $state;

    /**
     * @ORM\Column(type="integer", name="location_zip", length=10)
     */
    protected $zip;

    /**
     * @ORM\Column(type="integer", name="location_phone", length=10)
     */
    protected $phone;

    /**
     * @ORM\Column(type="datetime", name="location_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="location_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="datetime", name="location_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="string", name="location_modifedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="boolean", name="location_active")
     */
    protected $active = 1;

    /**
     * @ManyToOne(targetEntity="Customer", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="customer_id",referencedColumnName="customer_id")
     */
    protected $customer;

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
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
    public function getCustomer()
    {
        return $this->customer;
    }

    /**
     * @param mixed $customer
     */
    public function setCustomer($customer): void
    {
        $this->customer = $customer;
    }


}
