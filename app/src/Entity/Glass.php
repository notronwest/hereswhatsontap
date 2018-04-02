<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;


/**
 * @ORM\Entity(repositoryClass="App\Repository\GlassRepository")
 * @ORM\Table(name="glass",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="glass_unique",
 *                columns={"glass_name"}
 *               )
 *            }
 *     )
 */
class Glass extends BaseORMEntity
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="glass_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="glass_name", length=500)
     */
    protected $name;

    /**
     * @ORM\Column(type="string", name="glass_imgurl", length=500, nullable=true)
     */
    protected $imgURL;

    /**
     * @ORM\Column(type="string", name="glass_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="string", name="glass_addedbyname", length=255)
     */
    protected $addedbyname;

    /**
     * @ORM\Column(type="datetime", name="glass_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="glass_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="string", name="glass_modifiedbyname", length=255)
     */
    protected $modifiedbyname;

    /**
     * @ORM\Column(type="datetime", name="glass_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="boolean", name="glass_active")
     */
    protected $active;

    /**
     * @ORM\Column(type="string", name="glass_apiid", length=255, nullable=true)
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
    public function getImgURL()
    {
        return $this->imgURL;
    }

    /**
     * @param mixed $imgURL
     */
    public function setImgURL($imgURL): void
    {
        $this->imgURL = $imgURL;
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
