<?php

namespace Application\ChiaBundle\Entity;

/**
 * Application\ChiaBundle\Entity\Contact
 */
class Contact
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $name
     * @validation:NotBlank()
     */
    private $name;

    /**
     * @var string $title
     */
    private $title;

    /**
     * @var string $code
     */
    private $code;

    /**
     * @var string $description
     */
    private $description;

    /**
     * @var smallint $type
     * @validation:NotBlank()
     */
    private $type;

    /**
     * @var Contact
     */
    private $people;

    /**
     * @var Contact
     */
    private $company;

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
     * Set title
     *
     * @param string $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * Get title
     *
     * @return string $title
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set code
     *
     * @param string $code
     */
    public function setCode($code)
    {
        $this->code = $code;
    }

    /**
     * Get code
     *
     * @return string $code
     */
    public function getCode()
    {
        return $this->code;
    }

    /**
     * Set type
     *
     * @param smallint $type
     */
    public function setType($type)
    {
        $this->type = $type;
    }

    /**
     * Get type
     *
     * @return smallint $type
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Add people
     *
     * @param Contact $people
     */
    public function addPeople(\Contact $people)
    {
        $this->people[] = $people;
    }

    /**
     * Get people
     *
     * @return Doctrine\Common\Collections\Collection $people
     */
    public function getPeople()
    {
        return $this->people;
    }

    /**
     * Set company
     *
     * @param Contact $company
     */
    public function setCompany(\Contact $company)
    {
        $this->company = $company;
    }

    /**
     * Get company
     *
     * @return Contact $company
     */
    public function getCompany()
    {
        return $this->company;
    }


}