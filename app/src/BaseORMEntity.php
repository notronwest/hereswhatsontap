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
        $this->active = 1;
    }

    // probably needs to be moved to a more base class
    public function getNow(){
        return new DateTime('now');
    }

    public function getID()
    {
        return $this->id;
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
    public function getAddedbyname()
    {
        return $this->addedbyname;
    }

    /**
     * @param mixed $addedbyname
     */
    public function setAddedbyname($addedbyname): void
    {
        $this->addedbyname = $addedbyname;
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
    public function getModifiedbyName()
    {
        return $this->modifiedbyname;
    }

    /**
     * @param mixed $modifiedbyname
     */
    public function setModifiedbyname($modifiedbyname): void
    {
        $this->modifiedbyname = $modifiedbyname;
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