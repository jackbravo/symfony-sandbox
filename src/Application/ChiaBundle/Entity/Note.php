<?php

namespace Application\ChiaBundle\Entity;

/**
 * Application\ChiaBundle\Entity\Note
 */
class Note
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $verb
     */
    private $verb;

    /**
     * @var string $changes
     */
    private $changes;

    /**
     * @var string $note
     */
    private $note;

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
     * Get id
     *
     * @return integer $id
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set changes
     *
     * @param string $changes
     */
    public function setChanges($changes)
    {
        $this->changes = $changes;
    }

    /**
     * Get changes
     *
     * @return string $changes
     */
    public function getChanges()
    {
        return $this->changes;
    }

    /**
     * Set note
     *
     * @param string $note
     */
    public function setNote($note)
    {
        $this->note = $note;
    }

    /**
     * Get note
     *
     * @return string $note
     */
    public function getNote()
    {
        return $this->note;
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
     * Set verb
     *
     * @param string $verb
     */
    public function setVerb($verb)
    {
        $this->verb = $verb;
    }

    /**
     * Get verb
     *
     * @return string $verb
     */
    public function getVerb()
    {
        return $this->verb;
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
