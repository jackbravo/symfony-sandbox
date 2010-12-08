<?php

namespace Application\ChiaBundle\Entity;

/**
 * Application\ChiaBundle\Entity\Email
 */
class Email
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $email
     * @validation:Email()
     */
    private $email;

    /**
     * @var Contact
     */
    private $contact;

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
     * Set email
     *
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
    }

    /**
     * Get email
     *
     * @return string $email
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set contact
     *
     * @param Contact $contact
     */
    public function setContact($contact)
    {
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

}
