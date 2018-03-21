<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BeerListBeerRepository")
 * @ORM\Table(name="beer_list_beer",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="beer_list_beer_unique",
 *                columns={"beer_id", "beer_list_id"}
 *               )
 *            }
 *     )
 */
class BeerListBeer extends BaseORMEntity
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="beer_list_beer_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="float", name="beer_list_beer_price")
     */
    protected $price;

    /**
     * @ORM\Column(type="string", name="beer_list_beer_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="datetime", name="beer_list_beer_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="beer_list_beer_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="datetime", name="beer_list_beer_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="boolean", name="beer_list_beer_active")
     */
    protected $active;

    /**
     * @ManyToOne(targetEntity="Glass", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="glass_id",referencedColumnName="glass_id")
     */
    protected $glass;

    /**
     * @ManyToOne(targetEntity="Beer", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="beer_id",referencedColumnName="beer_id")
     */
    protected $beer;

    /**
     * @ManyToOne(targetEntity="BeerList", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="beer_list_id",referencedColumnName="beer_list_id")
     */
    protected $beerlist;

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
    public function getBeerlist()
    {
        return $this->beerlist;
    }

    /**
     * @param mixed $beerlist
     */
    public function setBeerlist($beerlist): void
    {
        $this->beerlist = $beerlist;
    }



}
