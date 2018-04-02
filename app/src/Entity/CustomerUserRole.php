<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Doctrine\ORM\Mapping\ManyToOne as ManyToOne;
use Doctrine\ORM\Mapping\JoinColumn as JoinColumn;

/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomerUserRoleRepository")
 * @ORM\Table(name="customer_user_role",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="customer_user_role_unique",
 *                columns={"customer_id", "user_id", "customer_user_role_type_id"}
 *               )
 *            }
 *     )
 */
class CustomerUserRole extends BaseORMEntity
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="customer_user_role_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="datetime", name="customer_user_role_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="customer_user_role_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="string", name="customer_user_role_addedbyname", length=255)
     */
    protected $addedbyname;

    /**
     * @ORM\Column(type="datetime", name="customer_user_role_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="string", name="customer_user_role_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="string", name="customer_user_role_modifiedbyname", length=255)
     */
    protected $modifiedbyname;

    /**
     * @ORM\Column(type="boolean", name="customer_user_role_active")
     */
    protected $active;

    /**
     * @ManyToOne(targetEntity="user", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="user_id",referencedColumnName="user_id")
     */
    protected $user;

    /**
     * @ManyToOne(targetEntity="Customer", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="customer_id",referencedColumnName="customer_id")
     */
    protected $customer;

    /**
     * @ManyToOne(targetEntity="CustomerUserRoleType", cascade={"all"}, fetch="LAZY")
     * @JoinColumn(name="customer_user_role_type_id",referencedColumnName="customer_user_role_type_id")
     */
    protected $customerUserRoleType;

    /**
     * @return mixed
     */
    public function getuser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setuser($user): void
    {
        $this->user = $user;
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
    public function getCustomerUserRoleType()
    {
        return $this->customeruserRoleType;
    }

    /**
     * @param mixed $customerUserRoleType
     */
    public function setCustomerUserRoleType($customerUserRoleType): void
    {
        $this->customerUserRoleType = $customerUserRoleType;
    }


}
