<?php

namespace Application\ChiaBundle\Entity;

use Bundle\DoctrineUserBundle\Entity\User as BaseUser;

/**
 * Application\ChiaBundle\Entity\User
 */
class User extends BaseUser
{
    /**
     * @var integer $id
     */
    protected $id;

    /**
     * @var Application\ChiaBundle\Entity\Project
     */
    private $projects;

    public function __construct()
    {
        $this->projects = new ArrayCollection();
    }

    /**
     * Add projects
     *
     * @param Application\ChiaBundle\Entity\Project $projects
     */
    public function addProjects(\Application\ChiaBundle\Entity\Project $projects)
    {
        $projects->setProject($this);
        $this->projects[] = $projects;
    }

    /**
     * Get projects
     *
     * @return Doctrine\Common\Collections\Collection $projects
     */
    public function getProjects()
    {
        return $this->projects;
    }

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
