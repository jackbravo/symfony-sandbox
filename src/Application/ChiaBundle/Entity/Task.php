<?php

namespace Application\ChiaBundle\Entity;

/**
 * Application\ChiaBundle\Entity\Task
 */
class Task
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $task
     */
    private $task;

    /**
     * @var boolean $done
     */
    private $done;

    /**
     * @var datetime $due_date
     */
    private $due_date;

    /**
     * @var datetime $created_at
     */
    private $created_at;

    /**
     * @var datetime $updated_at
     */
    private $updated_at;

    /**
     * @var Application\ChiaBundle\Entity\Project
     */
    private $project;

    /**
     * @var Application\ChiaBundle\Entity\TaskCategory
     */
    private $category;

    /**
     * @var Application\ChiaBundle\Entity\User
     */
    private $owner;

    /**
     * @var Application\ChiaBundle\Entity\User
     */
    private $created_by;

    public function __construct()
    {
        $this->done = false;
    }

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
     * Set task
     *
     * @param string $task
     */
    public function setTask($task)
    {
        $this->task = $task;
    }

    /**
     * Get task
     *
     * @return string $task
     */
    public function getTask()
    {
        return $this->task;
    }

    /**
     * Set done
     *
     * @param boolean $done
     */
    public function setDone($done)
    {
        $this->done = $done;
    }

    /**
     * Get done
     *
     * @return boolean $done
     */
    public function getDone()
    {
        return $this->done;
    }

    /**
     * Set due_date
     *
     * @param datetime $due_date
     */
    public function setDueDate($due_date)
    {
        $this->due_date = $due_date;
    }

    /**
     * Get due_date
     *
     * @return datetime $due_date
     */
    public function getDueDate()
    {
        return $this->due_date;
    }

    /**
     * Set created_at
     *
     * @param datetime $createdAt
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    }

    /**
     * Get created_at
     *
     * @return datetime $createdAt
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updated_at
     *
     * @param datetime $updatedAt
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    }

    /**
     * Get updated_at
     *
     * @return datetime $updatedAt
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set project
     *
     * @param Application\ChiaBundle\Entity\Project $project
     */
    public function setProject(\Application\ChiaBundle\Entity\Project $project)
    {
        $this->project = $project;
    }

    /**
     * Get project
     *
     * @return Application\ChiaBundle\Entity\Project $project
     */
    public function getProject()
    {
        return $this->project;
    }

    /**
     * Set category
     *
     * @param Application\ChiaBundle\Entity\TaskCategory $category
     */
    public function setCategory(\Application\ChiaBundle\Entity\TaskCategory $category)
    {
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return Application\ChiaBundle\Entity\TaskCategory $category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set owner
     *
     * @param Application\ChiaBundle\Entity\User $owner
     */
    public function setOwner(\Application\ChiaBundle\Entity\User $owner)
    {
        $this->owner = $owner;
    }

    /**
     * Get owner
     *
     * @return Application\ChiaBundle\Entity\User $owner
     */
    public function getOwner()
    {
        return $this->owner;
    }

    /**
     * Set created_by
     *
     * @param Application\ChiaBundle\Entity\User $created_by
     */
    public function setCreatedBy(\Application\ChiaBundle\Entity\User $created_by)
    {
        $this->created_by = $created_by;
    }

    /**
     * Get created_by
     *
     * @return Application\ChiaBundle\Entity\User $created_by
     */
    public function getCreatedBy()
    {
        return $this->created_by;
    }

    /**
     * @prePersist
     */
    public function doStuffOnPrePersist()
    {
        $this->created_at = $this->updated_at = new \DateTime();
    }

    /**
     * @preUpdate
     */
    public function doStuffOnPreUpdate()
    {
        $this->updated_at = new \DateTime();
    }
}
