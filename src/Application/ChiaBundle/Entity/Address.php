<?php

namespace Application\ChiaBundle\Entity;

/**
 * Application\ChiaBundle\Entity\Address
 */
class Address
{
    /**
     * @var integer $id
     */
    private $id;

    /**
     * @var string $street
     */
    private $street;

    /**
     * @var string $city
     */
    private $city;

    /**
     * @var string $state
     */
    private $state;

    /**
     * @var string $country
     */
    private $country;

    /**
     * @var string $postal_code
     */
    private $postal_code;

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
     * Set street
     *
     * @param string $street
     */
    public function setStreet($street)
    {
        $this->street = $street;
    }

    /**
     * Get street
     *
     * @return string $street
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set city
     *
     * @param string $city
     */
    public function setCity($city)
    {
        $this->city = $city;
    }

    /**
     * Get city
     *
     * @return string $city
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     */
    public function setState($state)
    {
        $this->state = $state;
    }

    /**
     * Get state
     *
     * @return string $state
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set country
     *
     * @param string $country
     */
    public function setCountry($country)
    {
        $this->country = $country;
    }

    /**
     * Get country
     *
     * @return string $country
     */
    public function getCountry()
    {
        return $this->country;
    }

    /**
     * Set postal_code
     *
     * @param string $postalCode
     */
    public function setPostalCode($postalCode)
    {
        $this->postal_code = $postalCode;
    }

    /**
     * Get postal_code
     *
     * @return string $postalCode
     */
    public function getPostalCode()
    {
        return $this->postal_code;
    }

    /**
     * Set contact
     *
     * @param Contact $contact
     */
    public function setContact(\Contact $contact)
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