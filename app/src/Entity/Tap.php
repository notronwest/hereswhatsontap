<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\BaseRepository")
 * @ORM\Table(name="tap")
 */
class Tap extends BaseORMEntity
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="tap_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="tap_name", length=500)
     */
    protected $name;

    /**
     * @ORM\Column(type="datetime", name="tap_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="tap_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="string", name="tap_addedbyname", length=255)
     */
    protected $addedbyname;

    /**
     * @ORM\Column(type="datetime", name="tap_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="string", name="tap_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="string", name="tap_modifiedbyname", length=255)
     */
    protected $modifiedbyname;

    /**
     * @ORM\Column(type="boolean", name="tap_active")
     */
    protected $active;

    /**
     * @ManyToOne(targetEntity="Customer", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="customer_id",referencedColumnName="customer_id")
     */
    protected $customer;

    /**
     * @ManyToOne(targetEntity="Location", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="location_id",referencedColumnName="location_id")
     */
    protected $location;

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

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location): void
    {
        $this->location = $location;
    }
}
