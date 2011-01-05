<?php

namespace Application\ChiaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Bundle\FOS\UserBundle\Entity\User as BaseUser;

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

    /**
     * @var Application\ChiaBundle\Entity\Note
     */
    private $notes;

    public function __construct($algorithm)
    {
        $this->projects = new ArrayCollection();
        $this->notes = new ArrayCollection();
        parent::__construct($algorithm);
    }

    /**
     * Add projects
     *
     * @param Application\ChiaBundle\Entity\Project $projects
     */
    public function addProjects(\Application\ChiaBundle\Entity\Project $projects)
    {
        $projects->setOwner($this);
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
     * Add notes
     *
     * @param Application\ChiaBundle\Entity\Note $notes
     */
    public function addNotes(\Application\ChiaBundle\Entity\Note $notes)
    {
        $notes->setCreatedBy($this);
        $this->notes[] = $notes;
    }

    /**
     * Get notes
     *
     * @return Doctrine\Common\Collections\Collection $notes
     */
    public function getNotes()
    {
        return $this->notes;
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

    public function __toString()
    {
        return $this->getUsername();
    }
}
