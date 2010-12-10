<?php

namespace Application\ChiaBundle\Entity;

/**
 * Application\ChiaBundle\Entity\Category
 */
class Category
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     */
    private $name;

    /**
     * @var Project
     */
    private $projects;

    /**
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * Get name
     *
     * @return string $name
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Add projects
     *
     * @param Project $projects
     */
    public function addProjects($projects)
    {
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
}
