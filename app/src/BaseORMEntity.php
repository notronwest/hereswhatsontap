<?php
/**
 * Created by PhpStorm.
 * User: notronwest
 * Date: 3/18/18
 * Time: 6:07 PM
 */

namespace App;

use DateTime;


class BaseORMEntity
{
    use BaseORMTrait;

    public function __construct()
    {
        $this->addeddate = new DateTime('now');
        $this->modifieddate = new DateTime('now');
        $this->addedby = 'ANON0000000000000000000000000001';
        $this->modifiedby = 'ANON0000000000000000000000000001';
        $this->active = 1;
    }

    /**
     * @return mixed
     */
    public function getAddedby()
    {
        return $this->addedby;
    }

    /**
     * @param mixed $addedby
     */
    public function setAddedby($addedby): void
    {
        $this->addedby = $addedby;
    }

    /**
     * @return mixed
     */
    public function getAddeddate()
    {
        return $this->addeddate;
    }

    /**
     * @param mixed $addeddate
     */
    public function setAddeddate($addeddate): void
    {
        $this->addeddate = $addeddate;
    }

    /**
     * @return mixed
     */
    public function getModifieddate()
    {
        return $this->modifieddate;
    }

    /**
     * @param mixed $modifieddate
     */
    public function setModifieddate($modifieddate): void
    {
        $this->modifieddate = $modifieddate;
    }

    /**
     * @return mixed
     */
    public function getModifiedby()
    {
        return $this->modifiedby;
    }

    /**
     * @param mixed $modifiedby
     */
    public function setModifiedby($modifiedby): void
    {
        $this->modifiedby = $modifiedby;
    }

    /**
     * @return mixed
     */
    public function getActive()
    {
        return $this->active;
    }

    /**
     * @param mixed $active
     */
    public function setActive($active): void
    {
        $this->active = $active;
    }

}