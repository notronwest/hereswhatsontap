<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BreweryRepository")
 * @ORM\Table(name="brewery",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="brewery_unique",
 *                columns={"brewery_name"}
 *               )
 *            }
 *     )
 */
class Brewery extends BaseORMEntity
{
    public function __construct()
    {
        parent::__construct();
        $this->beers = new ArrayCollection();
    }

    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="brewery_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="brewery_name", length=500)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", name="brewery_description", length=2000)
     */
    protected $description;

    /**
     * @ORM\Column(type="string", name="brewery_phone", length=10, nullable=true)
     */
    protected $phone;

    /**
     * @ORM\Column(type="string", name="brewery_email", length=255, nullable=true)
     */
    protected $email;

    /**
     * @ORM\Column(type="string", name="brewery_website", length=255, nullable=true)
     */
    protected $website;

    /**
     * @ORM\Column(type="string", name="brewery_address", length=1000, nullable=true)
     */
    protected $address;

    /**
     * @ORM\Column(type="string", name="brewery_address2", length=1000, nullable=true)
     */
    protected $address2;

    /**
     * @ORM\Column(type="string", name="brewery_city", length=255, nullable=true)
     */
    protected $city;

    /**
     * @ORM\Column(type="string", name="brewery_state", length=36, nullable=true)
     */
    protected $state;

    /**
     * @ORM\Column(type="string", name="brewery_zip", length=9, nullable=true)
     */
    protected $zip;

    /**
     * @ORM\Column(type="string", name="brewery_year", length=4, nullable=true)
     */
    protected $year;

    /**
     * @ORM\Column(type="string", name="brewery_images", length=2000)
     */
    protected $images;

    /**
     * @ORM\Column(type="datetime", name="brewery_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="brewery_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="string", name="brewery_addedbyname", length=255)
     */
    protected $addedbyname;

    /**
     * @ORM\Column(type="datetime", name="brewery_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="string", name="brewery_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="string", name="brewery_modifiedbyname", length=255)
     */
    protected $modifiedbyname;

    /**
     * @ORM\Column(type="boolean", name="brewery_active")
     */
    protected $active;

    /**
     * @ORM\Column(type="string", name="brewery_apiid", length=255, nullable=true)
     */
    protected $APIID;

    /**
     * @ORM\OneToMany(targetEntity="Beer", mappedBy="brewery")
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
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description): void
    {
        $this->description = $description;
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
    public function getWebsite()
    {
        return $this->website;
    }

    /**
     * @param mixed $website
     */
    public function setWebsite($website): void
    {
        $this->website = $website;
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
    public function getImages()
    {
        return $this->images;
    }

    /**
     * @param mixed $images
     */
    public function setImages($images): void
    {
        $this->images = $images;
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
