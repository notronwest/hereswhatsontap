<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BeerRepository")
 * @ORM\Table(name="beer",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="beer_unique",
 *                columns={"beer_name"}
 *               )
 *            }
 *     )
 */
class Beer
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="beer_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="beer_name", length=500)
     */
    protected $name;

    /**
     * @ORM\Column(type="integer", name="beer_abv", length=10)
     */
    protected $abv;

    /**
     * @ORM\Column(type="integer", name="beer_ibu", length=10)
     */
    protected $ibu;

    /**
     * @ORM\Column(type="boolean", name="beer_organic")
     */
    protected $organic;

    /**
     * @ORM\Column(type="string", name="beer_year", length=4)
     */
    protected $year;

    /**
     * @ORM\Column(type="float", name="beer_price")
     */
    protected $price;

    /**
     * @ORM\Column(type="datetime", name="beer_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="beer_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="datetime", name="beer_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="string", name="beer_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="boolean", name="beer_active")
     */
    protected $active;

    /**
     * @ManyToOne(targetEntity="Style", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="style_id",referencedColumnName="style_id")
     */
    protected $style;

    /**
     * @ManyToOne(targetEntity="Glass", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="glass_id",referencedColumnName="glass_id")
     */
    protected $glass;

    /**
     * @ORM\Column(type="string", name="beer_apiid", length=255)
     */
    protected $APIID;

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
    public function getAbv()
    {
        return $this->abv;
    }

    /**
     * @param mixed $abv
     */
    public function setAbv($abv): void
    {
        $this->abv = $abv;
    }

    /**
     * @return mixed
     */
    public function getIbu()
    {
        return $this->ibu;
    }

    /**
     * @param mixed $ibu
     */
    public function setIbu($ibu): void
    {
        $this->ibu = $ibu;
    }

    /**
     * @return mixed
     */
    public function getOrganic()
    {
        return $this->organic;
    }

    /**
     * @param mixed $organic
     */
    public function setOrganic($organic): void
    {
        $this->organic = $organic;
    }

    /**
     * @return mixed
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * @param mixed $year
     */
    public function setYear($year): void
    {
        $this->year = $year;
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
    public function getStyle()
    {
        return $this->style;
    }

    /**
     * @param mixed $style
     */
    public function setStyle($style): void
    {
        $this->style = $style;
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
    public function getAPIID()
    {
        return $this->APIID;
    }

    /**
     * @param mixed $APIID
     */
    public function setAPIID($APIID): void
    {
        $this->APIID = $APIID;
    }


}
