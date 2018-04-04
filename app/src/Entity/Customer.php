<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerRepository")
 * @ORM\Table(name="customer",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="customer_unique",
 *                columns={"customer_name"}
 *               )
 *            }
 *     )
 */
class Customer extends BaseORMEntity
{
    public function __construct()
    {
        parent::__construct();
        $this->locations = new ArrayCollection();
        $this->startdate = new \DateTime();
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="customer_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="customer_name", length=255)
     */
    protected $name;

    /**
     * @ORM\Column(type="datetime", name="customer_startdate")
     */
    protected $startdate;

    /**
     * @ORM\Column(type="datetime", name="customer_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="customer_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="string", name="customer_addedbyname", length=255)
     */
    protected $addedbyname;

    /**
     * @ORM\Column(type="datetime", name="customer_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="string", name="customer_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="string", name="customer_modifiedbyname", length=255)
     */
    protected $modifiedbyname;

    /**
     * @ORM\Column(type="boolean", name="customer_active")
     */
    protected $active;

    /**
     * @ORM\Column(type="integer", name="customer_type_id", length=36)
     */
    protected $customerType;

    /**
     * @ORM\OneToMany(targetEntity="Location", mappedBy="customer")
     */
    protected $locations;

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
    public function getStartdate()
    {
        return $this->startdate;
    }

    /**
     * @param mixed $startdate
     */
    public function setStartdate($startdate): void
    {
        $this->startdate = $startdate;
    }

    /**
     * @return mixed
     */
    public function getCustomerType()
    {
        return $this->customerType;
    }

    /**
     * @param mixed $customerType
     */
    public function setCustomerType($customerType): void
    {
        $this->customerType = $customerType;
    }

    /**
     * @return ArrayCollection
     */
    public function getLocations()
    {
        return $this->locations;
    }

    /**
     * @param Location $location
     */
    public function addLocation($location)
    {
        if( !$this->locations ){
            $this->locations = new ArrayCollection();
        }

        if( !$this->locations->contains($location) ){
            $this->locations->add($location);
        }
    }


}
