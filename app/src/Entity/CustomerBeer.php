<?php

namespace App\Entity;

use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerBeerRepository")
 * @ORM\Table(name="customer_beer",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="customer_beer_unique",
 *                columns={"customer_id","beer_id"}
 *               )
 *            }
 *     )
 */
class CustomerBeer extends BaseORMEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="customer_beer_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="float", name="customer_beer_price", nullable=true)
     */
    protected $price;

    /**
     * @ORM\Column(type="datetime", name="customer_beer_tapdate")
     */
    protected $tapdate;

    /**
     * @ORM\Column(type="datetime", name="customer_beer_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="customer_beer_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="string", name="customer_beer_addedbyname", length=255)
     */
    protected $addedbyname;

    /**
     * @ORM\Column(type="datetime", name="customer_beer_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="string", name="customer_beer_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="string", name="customer_beer_modifiedbyname", length=255)
     */
    protected $modifiedbyname;

    /**
     * @ORM\Column(type="boolean", name="customer_beer_active")
     */
    protected $active;

    /**
     * @ManyToOne(targetEntity="Customer", inversedBy="beers", cascade={"persist","remove"})
     * @JoinColumn(name="customer_id",referencedColumnName="customer_id")
    */
    protected $customer;

    /**
     * @ORM\ManyToOne(targetEntity="Location", inversedBy="beers", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="location_id", referencedColumnName="location_id")
     */
    protected $location;

    /**
     * @ORM\ManyToOne(targetEntity="Tap", inversedBy="beers", cascade={"persist", "remove"})
     * @ORM\JoinColumn(name="tap_id", referencedColumnName="tap_id", nullable=true)
     */
    protected $tap;

    /**
     * @ORM\ManyToOne(targetEntity="Beer")
     * @ORM\JoinColumn(name="beer_id", referencedColumnName="beer_id")
     */
    protected $beer;

    /**
     * @ManyToOne(targetEntity="Glass", fetch="LAZY")
     * @JoinColumn(name="glass_id",referencedColumnName="glass_id")
     */
    protected $glass;

    /**
     * @return mixed
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * @param mixed $price
     */
    public function setPrice($price): void
    {
        $this->price = $price;
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

    /**
     * @return mixed
     */
    public function getTap()
    {
        return $this->tap;
    }

    /**
     * @param mixed $tap
     */
    public function setTap($tap): void
    {
        $this->tap = $tap;
    }

    /**
     * @return mixed
     */
    public function getBeer()
    {
        return $this->beer;
    }

    /**
     * @param mixed $beer
     */
    public function setBeer($beer): void
    {
        $this->beer = $beer;
    }

    /**
     * @return mixed
     */
    public function getGlass()
    {
        return $this->glass;
    }

    /**
     * @param mixed $glass
     */
    public function setGlass($glass): void
    {
        $this->glass = $glass;
    }

    /**
     * @return mixed
     */
    public function getTapdate()
    {
        return $this->tapdate;
    }

    /**
     * @param mixed $tapdate
     */
    public function setTapdate($tapdate): void
    {
        $this->tapdate = $tapdate;
    }


}
