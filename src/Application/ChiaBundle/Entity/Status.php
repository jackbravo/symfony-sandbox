<?php

namespace Application\ChiaBundle\Entity;

/**
 * Application\ChiaBundle\Entity\Status
 */
class Status
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
     * @var smallint $weight
     */
    private $weight;

    /**
     * @var smallint $value
     */
    private $value;

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
     * Set weight
     *
     * @param smallint $weight
     */
    public function setWeight($weight)
    {
        $this->weight = $weight;
    }

    /**
     * Get weight
     *
     * @return smallint $weight
     */
    public function getWeight()
    {
        return $this->weight;
    }

    /**
     * Set value
     *
     * @param smallint $value
     */
    public function setValue($value)
    {
        $this->value = $value;
    }

    /**
     * Get value
     *
     * @return smallint $value
     */
    public function getValue()
    {
        return $this->value;
    }

    /**
     * Add projects
     *
     * @param Project $projects
     */
    public function addProjects(\Project $projects)
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