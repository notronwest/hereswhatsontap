<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;
use Doctrine\Common\Collections\ArrayCollection;

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
     * @ORM\Column(type="integer", name="tap_numberoftaps")
     */
    protected $numberOfTaps;

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
     * @ORM\ManyToOne(targetEntity="Location", inversedBy="taps", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="location_id", referencedColumnName="location_id", nullable=true)
     */
    protected $location;

    /**
     * @ORM\OneToMany(targetEntity="CustomerBeer", mappedBy="tap")
     */
    protected $beers;

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
    public function getNumberOfTaps()
    {
        return $this->numberOfTaps;
    }

    /**
     * @param mixed $numberOfTaps
     */
    public function setNumberOfTaps($numberOfTaps): void
    {
        $this->numberOfTaps = $numberOfTaps;
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
     * @param Location $location
     */
    public function setLocation(Location $location)
    {
        $this->location = $location;
    }

    /**
     * @return ArrayCollection
     */
    public function getBeers()
    {
        return $this->beers;
    }

    /**
     * @param Beer $beer
     */
    public function addBeer($beer)
    {
        if( !$this->beers ){
            $this->beers = new ArrayCollection();
        }

        if( !$this->beers->contains($beer) ){
            $this->beers->add($beer);
        }
    }
}
