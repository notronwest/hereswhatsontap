<?php

namespace App\Entity;


use App\BaseORMEntity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\ORM\Mapping\UniqueConstraint as UniqueConstraint;
use Doctrine\ORM\Query\Expr\Base;


/**
 * @ORM\Entity(repositoryClass="App\Repository\CustomeruserRoleTypeRepository")
 * @ORM\Table(name="customer_user_role_type",
 *            uniqueConstraints =
 *            {
 *              @UniqueConstraint(
 *                name="customer_user_role_type_unique",
 *                columns={"customer_user_role_type_constant"}
 *               )
 *            }
 *     )
 */
class CustomeruserRoleType extends BaseORMEntity
{


    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="UUID")
     * @ORM\Column(type="guid", name="customer_user_role_type_id")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", name="customer_user_role_type_constant", length=50)
     */
    protected $constant;

    /**
     * @ORM\Column(type="datetime", name="customer_user_role_type_addeddate")
     */
    protected $addeddate;

    /**
     * @ORM\Column(type="string", name="customer_user_role_type_addedby", length=36)
     */
    protected $addedby;

    /**
     * @ORM\Column(type="string", name="customer_user_role_type_modifiedby", length=36)
     */
    protected $modifiedby;

    /**
     * @ORM\Column(type="datetime", name="customer_user_role_type_modifieddate")
     */
    protected $modifieddate;

    /**
     * @ORM\Column(type="boolean", name="customer_user_role_type_active")
     */
    protected $active;

    /**
     * @return mixed
     */
    public function getConstant()
    {
        return $this->constant;
    }

    /**
     * @param mixed $constant
     */
    public function setConstant($constant): void
    {
        $this->constant = $constant;
    }


}
