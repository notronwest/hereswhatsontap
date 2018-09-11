<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BreweryBeerRepository")
 * @ORM\Table(name="brewery_beer",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="brewery_beer_unique",
 *                columns={"beer_id", "brewery_id"}
 *               )
 *            }
 *     )
 */
class BreweryBeer extends BaseORMEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="brewery_beer_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="float", name="brewery_beer_price")
     */
    protected $price;

    /**
     * @ORM\Column(type="boolean", name="brewery_beer_display")
     */
    protected $display = 1;

    /**
     * @ORM\Column(type="string", name="brewery_beer_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="string", name="brewery_beer_addedbyname", length=255)
     */
    protected $addedbyname;

    /**
     * @ORM\Column(type="datetime", name="brewery_beer_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="brewery_beer_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="string", name="brewery_beer_modifiedbyname", length=255)
     */
    protected $modifiedbyname;

    /**
     * @ORM\Column(type="datetime", name="brewery_beer_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="boolean", name="brewery_beer_active")
     */
    protected $active;

    /**
     * @ManyToOne(targetEntity="Glass", fetch="LAZY")
     * @JoinColumn(name="glass_id",referencedColumnName="glass_id")
     */
    protected $glass;

    /**
     * @ManyToOne(targetEntity="Beer", fetch="LAZY")
     * @JoinColumn(name="beer_id",referencedColumnName="beer_id")
     */
    protected $beer;

    /**
     * @ManyToOne(targetEntity="Brewery", fetch="LAZY")
     * @JoinColumn(name="brewery_id",referencedColumnName="brewery_id")
     */
    protected $brewery;

    /**
     * @return mixed
     */
    public function getDisplay()
    {
        return $this->display;
    }

    /**
     * @param mixed $display
     */
    public function setDisplay($display): void
    {
        $this->display = $display;
    }

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
    public function getBrewery()
    {
        return $this->brewery;
    }

    /**
     * @param mixed $brewery
     */
    public function setBrewery($brewery): void
    {
        $this->brewery = $brewery;
    }



}
