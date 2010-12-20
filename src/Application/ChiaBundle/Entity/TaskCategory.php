<?php

namespace Application\ChiaBundle\Entity;

/**
 * Application\ChiaBundle\Entity\TaskCategory
 */
class TaskCategory
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
     * @var Task
     */
    private $tasks;

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
     * Add task
     *
     * @param Task $task
     */
    public function addTask($task)
    {
        $this->tasks[] = $task;
    }

    /**
     * Get tasks
     *
     * @return Doctrine\Common\Collections\Collection $tasks
     */
    public function getTasks()
    {
        return $this->tasks;
    }
}
