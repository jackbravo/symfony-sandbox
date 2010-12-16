<?php

namespace Application\ChiaBundle\Entity;

use Bundle\DoctrineUserBundle\Entity\Group as BaseGroup;

/**
 * Application\ChiaBundle\Entity\Group
 */
class Group extends BaseGroup
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @prePersist
     */
    public function doStuffOnPrePersist()
    {
        // Add your code here
    }

    /**
     * @preUpdate
     */
    public function doStuffOnPreUpdate()
    {
        // Add your code here
    }
}
