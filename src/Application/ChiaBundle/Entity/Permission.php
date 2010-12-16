<?php

namespace Application\ChiaBundle\Entity;

use Bundle\DoctrineUserBundle\Entity\Permission as BasePermission;

/**
 * Application\ChiaBundle\Entity\Permission
 */
class Permission extends BasePermission
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
