<?php

namespace Application\ChiaBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Application\ChiaBundle\Entity\Note;
use Application\ChiaBundle\Entity\Task;

/**
 * Application\ChiaBundle\Entity\Project
 */
class Project
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
     * @var smallint $status
     */
    private $status;

    /**
     * @var Category
     */
    private $category;

    /**
     * @var decimal $price
     */
    private $price;

    /**
     * @var smallint $price_type
     */
    private $price_type;

    static $price_types = array(
        0 => "Fixed Price",
        1 => "Per hour",
        2 => "Per Month",
        3 => "Per Year",
    );

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var date $estimated_start_date
     */
    private $estimated_start_date;

    /**
     * @var date $estimated_start_date
     */
    private $original_estimated_start_date;

    /**
     * @var datetime $created_at
     */
    private $created_at;

    /**
     * @var datetime $updated_at
     */
    private $updated_at;

    /**
     * @var Contact
     */
    private $contact;

    /**
     * @var Application\ChiaBundle\Entity\User
     */
    private $owner;

    /**
     * @var Application\ChiaBundle\Entity\Note
     */
    private $notes;

    /**
     * @var Application\ChiaBundle\Entity\Task
     */
    private $tasks;

    public function __construct()
    {
        $this->notes = new ArrayCollection();
        $this->tasks = new ArrayCollection();
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
     * Set name
     *
     * @param string $name
     */
    public function setName($name)
    {
        if ($this->getId() && $this->name != $name) {
            $this->getLastNote()->addChange("Name changed from '{$this->name}' to '$name'");
        }
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
     * Set status
     *
     * @param Status $status
     */
    public function setStatus($status)
    {
        if ($this->getId() && $this->status->getId() != $status->getId()) {
            if ($this->status->getActive() < $status->getActive()) {
                $this->getLastNote()->setVerb("Opened");
            }
            if ($this->status->getActive() > $status->getActive() || $this->status->getValue() != $status->getValue()) {
                if ($status->getValue() == 0) $this->getLastNote()->setVerb("Lost");
                if ($status->getValue() == 100) $this->getLastNote()->setVerb("Won");
            }
            $this->getLastNote()->addChange("Status changed from '{$this->status}' to '$status'");
        }
        $this->status = $status;
    }

    /**
     * Get status
     *
     * @return Status $status
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set category
     *
     * @param Category $category
     */
    public function setCategory($category)
    {
        if ($this->getId() && $this->category->getId() != $category->getId()) {
            $this->getLastNote()->addChange("Status changed from '{$this->category}' to '$category'");
        }
        $this->category = $category;
    }

    /**
     * Get category
     *
     * @return Category $category
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set description
     *
     * @param string $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * Get description
     *
     * @return string $description
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set estimated_start_date
     *
     * @param date $estimated_start_date
     */
    public function setEstimatedStartDate($estimated_start_date)
    {
        if ($this->getId() && $this->estimated_start_date != $estimated_start_date) {
            $this->getLastNote()->addChange("Estimated start date changed from '{$this->estimated_start_date}' to '$estimated_start_date'");
        }
        if ($this->getOriginalEstimatedStartDate() == null)
            $this->setOriginalEstimatedStartDate($estimated_start_date);
        $this->estimated_start_date = $estimated_start_date;
    }

    /**
     * Get estimated_start_date
     *
     * @return date $estimated_start_date
     */
    public function getEstimatedStartDate()
    {
        return $this->estimated_start_date;
    }

    /**
     * Set original_estimated_start_date
     *
     * @param date $original_estimated_start_date
     */
    public function setOriginalEstimatedStartDate($original_estimated_start_date)
    {
        $this->original_estimated_start_date = $original_estimated_start_date;
    }

    /**
     * Get original_estimated_start_date
     *
     * @return date $original_estimated_start_date
     */
    public function getOriginalEstimatedStartDate()
    {
        return $this->original_estimated_start_date;
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
     * Set contact
     *
     * @param Contact $contact
     */
    public function setContact($contact)
    {
        if (isset($contact) && $this->getId() && $this->contact && $this->contact->getId() != $contact->getId()) {
            $this->getLastNote()->addChange("Contact changed from '{$this->contact}' to '$contact'");
        }
        $this->contact = $contact;
    }

    /**
     * Get contact
     *
     * @return Contact $contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Set owner
     *
     * @param Application\ChiaBundle\Entity\User $owner
     */
    public function setOwner(\Application\ChiaBundle\Entity\User $owner)
    {
        if (!$owner) exit;
        if ($this->getId() && $this->owner && $this->owner->getId() != $owner->getId()) {
            $this->getLastNote()->addChange("Owner changed from '{$this->owner}' to '$owner'");
        }
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

    /**
     * Set price
     *
     * @param decimal $price
     */
    public function setPrice($price)
    {
        if ($this->getId() && $this->price != $price) {
            $this->getLastNote()->addChange("Price changed from '{$this->price}' to '$price'");
        }
        $this->price = $price;
    }

    /**
     * Get price
     *
     * @return decimal $price
     */
    public function getPrice()
    {
        return $this->price;
    }

    /**
     * Set price_type
     *
     * @param smallint $priceType
     */
    public function setPriceType($priceType)
    {
        if ($this->getId() && $this->price_type != $priceType) {
            $newPriceType = Project::$price_types[$priceType];
            $this->getLastNote()->addChange("Price type changed from '{$this->getPriceTypeName()}' to '$newPriceType'");
        }
        $this->price_type = $priceType;
    }

    /**
     * Get price_type
     *
     * @return smallint $priceType
     */
    public function getPriceType()
    {
        return $this->price_type;
    }

    /**
     * Get price_type
     *
     * @return smallint $priceType
     */
    public function getPriceTypeName()
    {
        return Project::$price_types[$this->price_type];
    }

    /**
     * Add task
     *
     * @param Application\ChiaBundle\Entity\Task $task
     */
    public function addTask(\Application\ChiaBundle\Entity\Task $task)
    {
        $task->setProject($this);
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

    /**
     * Add notes
     *
     * @param Application\ChiaBundle\Entity\Note $note
     */
    public function addNotes(\Application\ChiaBundle\Entity\Note $note)
    {
        $note->setProject($this);
        $this->notes[] = $note;
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
     * Returns the last note which has to be a new one
     */
    public function getLastNote()
    {
        if (!$this->notes->last() || $this->notes->last()->getId()) {
            $this->addNotes(new Note());
        }
        return $this->notes->last();
    }

    /**
     * Method used by ModifyProjectForm
     */
    public function getNewNote()
    {
        if (!$this->notes->last() || $this->notes->last()->getId())
            return '';
        else
            return $this->notes->last()->getNote();
    }

    /**
     * Method used by ModifyProjectForm
     */
    public function setNewNote($note)
    {
        return $this->getLastNote()->setNote($note);
    }

    public function __toString()
    {
        return $this->getName();
    }
}
