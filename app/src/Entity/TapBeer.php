<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;


/**
 * @ORM\Entity(repositoryClass="TapBeerRepository")
 * @ORM\Table(name="tap_beer",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="tap_beer_unique",
 *                columns={"beer_id", "tap_id"}
 *               )
 *            }
 *     )
 */
class TapBeer extends BaseORMEntity
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="tap_beer_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="float", name="tap_beer_price")
     */
    protected $price;

    /**
     * @ORM\Column(type="string", name="tap_beer_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="string", name="tap_beer_addedbyname", length=255)
     */
    protected $addedbyname;

    /**
     * @ORM\Column(type="datetime", name="tap_beer_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="tap_beer_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="string", name="tap_beer_modifiedbyname", length=255)
     */
    protected $modifiedbyname;

    /**
     * @ORM\Column(type="datetime", name="tap_beer_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="boolean", name="tap_beer_active")
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
     * @ManyToOne(targetEntity="Tap", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="tap_id",referencedColumnName="tap_id")
     */
    protected $tap;

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



}
