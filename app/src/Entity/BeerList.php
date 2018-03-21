<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;


/**
 * @ORM\Entity(repositoryClass="App\Repository\BeerListRepository")
 * @ORM\Table(name="beer_list",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="beer_list_unique",
 *                columns={"beer_list_name", "customer_id"}
 *               )
 *            }
 *     )
 */
class BeerList extends BaseORMEntity
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="integer", name="beer_list_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="beer_list_name", length=500)
     */
    protected $name;

    /**
     * @ORM\Column(type="datetime", name="beer_list_startdate")
     */
    protected $startdate;

    /**
     * @ORM\Column(type="datetime", name="beer_list_enddate")
     */
    protected $enddate;

    /**
     * @ORM\Column(type="string", name="beer_list_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="datetime", name="beer_list_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="beer_list_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="datetime", name="beer_list_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="boolean", name="beer_list_active")
     */
    protected $active;

    /**
     * @ManyToOne(targetEntity="Tap", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="tap_id",referencedColumnName="tap_id")
     */
    protected $tap;

    /**
     * @ManyToOne(targetEntity="Customer", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="customer_id",referencedColumnName="customer_id")
     */
    protected $customer;

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
    public function getEnddate()
    {
        return $this->enddate;
    }

    /**
     * @param mixed $enddate
     */
    public function setEnddate($enddate): void
    {
        $this->enddate = $enddate;
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


}
