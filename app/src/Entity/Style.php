<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\Repository\StyleRepository")
 * @ORM\Table(name="style",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="style_unique",
 *                columns={"style_name"}
 *               )
 *            }
 *     )
 */
class Style extends BaseORMEntity
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="style_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="style_name", length=500)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", name="style_description", length=2000, nullable=true)
     */
    protected $description;

    /**
     * @ORM\Column(type="string", name="style_category", length=500, nullable=true)
     */
    protected $category;

    /**
     * @ORM\Column(type="integer", name="style_ibumin", nullable=true)
     */
    protected $ibumin;

    /**
     * @ORM\Column(type="integer", name="style_ibumax", nullable=true)
     */
    protected $ibumax;

    /**
     * @ORM\Column(type="integer", name="style_abvmin", nullable=true)
     */
    protected $abvmin;

    /**
     * @ORM\Column(type="integer", name="style_abvmax", nullable=true)
     */
    protected $abvmax;

    /**
     * @ORM\Column(type="integer", name="style_srmmin", nullable=true)
     */
    protected $srmmin;

    /**
     * @ORM\Column(type="integer", name="style_srmmax", nullable=true)
     */
    protected $srmmax;

    /**
     * @ORM\Column(type="integer", name="style_ogmin", nullable=true)
     */
    protected $ogmin;

    /**
     * @ORM\Column(type="integer", name="style_ogmax", nullable=true)
     */
    protected $ogmax;

    /**
     * @ORM\Column(type="integer", name="style_fgmin", nullable=true)
     */
    protected $fgmin;

    /**
     * @ORM\Column(type="integer", name="style_fgmax", nullable=true)
     */
    protected $fgmax;

    /**
     * @ORM\Column(type="string", name="style_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="string", name="style_addedbyname", length=255)
     */
    protected $addedbyname;

    /**
     * @ORM\Column(type="datetime", name="style_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="style_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="string", name="style_modifiedbyname", length=255)
     */
    protected $modifiedbyname;

    /**
     * @ORM\Column(type="datetime", name="style_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="boolean", name="style_active")
     */
    protected $active;

    /**
     * @ORM\Column(type="string", name="style_apiid", length=255, nullable=true)
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
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * @param mixed $category
     */
    public function setCategory($category): void
    {
        $this->category = $category;
    }

    /**
     * @return mixed
     */
    public function getIbumin()
    {
        return $this->ibumin;
    }

    /**
     * @param mixed $ibumin
     */
    public function setIbumin($ibumin): void
    {
        $this->ibumin = $ibumin;
    }

    /**
     * @return mixed
     */
    public function getIbumax()
    {
        return $this->ibumax;
    }

    /**
     * @param mixed $ibumax
     */
    public function setIbumax($ibumax): void
    {
        $this->ibumax = $ibumax;
    }

    /**
     * @return mixed
     */
    public function getAbvmin()
    {
        return $this->abvmin;
    }

    /**
     * @param mixed $abvmin
     */
    public function setAbvmin($abvmin): void
    {
        $this->abvmin = $abvmin;
    }

    /**
     * @return mixed
     */
    public function getAbvmax()
    {
        return $this->abvmax;
    }

    /**
     * @param mixed $abvmax
     */
    public function setAbvmax($abvmax): void
    {
        $this->abvmax = $abvmax;
    }

    /**
     * @return mixed
     */
    public function getSrmmin()
    {
        return $this->srmmin;
    }

    /**
     * @param mixed $srmmin
     */
    public function setSrmmin($srmmin): void
    {
        $this->srmmin = $srmmin;
    }

    /**
     * @return mixed
     */
    public function getSrmmax()
    {
        return $this->srmmax;
    }

    /**
     * @param mixed $srmmax
     */
    public function setSrmmax($srmmax): void
    {
        $this->srmmax = $srmmax;
    }

    /**
     * @return mixed
     */
    public function getOgmin()
    {
        return $this->ogmin;
    }

    /**
     * @param mixed $ogmin
     */
    public function setOgmin($ogmin): void
    {
        $this->ogmin = $ogmin;
    }

    /**
     * @return mixed
     */
    public function getOgmax()
    {
        return $this->ogmax;
    }

    /**
     * @param mixed $ogmax
     */
    public function setOgmax($ogmax): void
    {
        $this->ogmax = $ogmax;
    }

    /**
     * @return mixed
     */
    public function getFgmin()
    {
        return $this->fgmin;
    }

    /**
     * @param mixed $fgmin
     */
    public function setFgmin($fgmin): void
    {
        $this->fgmin = $fgmin;
    }

    /**
     * @return mixed
     */
    public function getFgmax()
    {
        return $this->fgmax;
    }

    /**
     * @param mixed $fgmax
     */
    public function setFgmax($fgmax): void
    {
        $this->fgmax = $fgmax;
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
