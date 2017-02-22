<?php

/*
 * All APP settings that can be changed by the HOA or the Management company will be stored here...
 * 
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Goal
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SettingsRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Settings {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $city;  
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $state;  
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $stateAbrv;  
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $zipCode;  
    
    /**
     * @ORM\Column(type="text")
     */   
    protected $cityBlurb;  
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $county; 
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $township; 
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $hoaName; 
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $hoaAbrv; 
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $mgtCoName;
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $mgtCoAddress;
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $mgtCoState;
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $mgtCoCity;
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $mgtCoZip;
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $mgtCoPointOfContact;
    
        /**
     * @ORM\Column(type="string")
     */   
    protected $mgtCoPointOfContactPhone;
    
        /**
     * @ORM\Column(type="string")
     */   
    protected $mgtCoPointOfContactEmail;
    
        /**
     * @ORM\Column(type="string")
     */   
    protected $mgtCoPointOfContactWebsite;    
    

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set city
     *
     * @param string $city
     *
     * @return Settings
     */
    public function setCity($city)
    {
        $this->city = $city;

        return $this;
    }

    /**
     * Get city
     *
     * @return string
     */
    public function getCity()
    {
        return $this->city;
    }

    /**
     * Set state
     *
     * @param string $state
     *
     * @return Settings
     */
    public function setState($state)
    {
        $this->state = $state;

        return $this;
    }

    /**
     * Get state
     *
     * @return string
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * Set stateAbrv
     *
     * @param string $stateAbrv
     *
     * @return Settings
     */
    public function setStateAbrv($stateAbrv)
    {
        $this->stateAbrv = $stateAbrv;

        return $this;
    }

    /**
     * Get stateAbrv
     *
     * @return string
     */
    public function getStateAbrv()
    {
        return $this->stateAbrv;
    }

    /**
     * Set zipCode
     *
     * @param string $zipCode
     *
     * @return Settings
     */
    public function setZipCode($zipCode)
    {
        $this->zipCode = $zipCode;

        return $this;
    }

    /**
     * Get zipCode
     *
     * @return string
     */
    public function getZipCode()
    {
        return $this->zipCode;
    }

    /**
     * Set cityBlurb
     *
     * @param string $cityBlurb
     *
     * @return Settings
     */
    public function setCityBlurb($cityBlurb)
    {
        $this->cityBlurb = $cityBlurb;

        return $this;
    }

    /**
     * Get cityBlurb
     *
     * @return string
     */
    public function getCityBlurb()
    {
        return $this->cityBlurb;
    }


    /**
     * Set county
     *
     * @param string $county
     *
     * @return Settings
     */
    public function setCounty($county)
    {
        $this->county = $county;

        return $this;
    }

    /**
     * Get county
     *
     * @return string
     */
    public function getCounty()
    {
        return $this->county;
    }

    /**
     * Set township
     *
     * @param string $township
     *
     * @return Settings
     */
    public function setTownship($township)
    {
        $this->township = $township;

        return $this;
    }

    /**
     * Get township
     *
     * @return string
     */
    public function getTownship()
    {
        return $this->township;
    }

    /**
     * Set hoaName
     *
     * @param string $hoaName
     *
     * @return Settings
     */
    public function setHoaName($hoaName)
    {
        $this->hoaName = $hoaName;

        return $this;
    }

    /**
     * Get hoaName
     *
     * @return string
     */
    public function getHoaName()
    {
        return $this->hoaName;
    }

    /**
     * Set hoaAbrv
     *
     * @param string $hoaAbrv
     *
     * @return Settings
     */
    public function setHoaAbrv($hoaAbrv)
    {
        $this->hoaAbrv = $hoaAbrv;

        return $this;
    }

    /**
     * Get hoaAbrv
     *
     * @return string
     */
    public function getHoaAbrv()
    {
        return $this->hoaAbrv;
    }

    /**
     * Set mgtCoName
     *
     * @param string $mgtCoName
     *
     * @return Settings
     */
    public function setMgtCoName($mgtCoName)
    {
        $this->mgtCoName = $mgtCoName;

        return $this;
    }

    /**
     * Get mgtCoName
     *
     * @return string
     */
    public function getMgtCoName()
    {
        return $this->mgtCoName;
    }

    /**
     * Set mgtCoAddress
     *
     * @param string $mgtCoAddress
     *
     * @return Settings
     */
    public function setMgtCoAddress($mgtCoAddress)
    {
        $this->mgtCoAddress = $mgtCoAddress;

        return $this;
    }

    /**
     * Get mgtCoAddress
     *
     * @return string
     */
    public function getMgtCoAddress()
    {
        return $this->mgtCoAddress;
    }

    /**
     * Set mgtCoState
     *
     * @param string $mgtCoState
     *
     * @return Settings
     */
    public function setMgtCoState($mgtCoState)
    {
        $this->mgtCoState = $mgtCoState;

        return $this;
    }

    /**
     * Get mgtCoState
     *
     * @return string
     */
    public function getMgtCoState()
    {
        return $this->mgtCoState;
    }

    /**
     * Set mgtCoCity
     *
     * @param string $mgtCoCity
     *
     * @return Settings
     */
    public function setMgtCoCity($mgtCoCity)
    {
        $this->mgtCoCity = $mgtCoCity;

        return $this;
    }

    /**
     * Get mgtCoCity
     *
     * @return string
     */
    public function getMgtCoCity()
    {
        return $this->mgtCoCity;
    }

    /**
     * Set mgtCoZip
     *
     * @param string $mgtCoZip
     *
     * @return Settings
     */
    public function setMgtCoZip($mgtCoZip)
    {
        $this->mgtCoZip = $mgtCoZip;

        return $this;
    }

    /**
     * Get mgtCoZip
     *
     * @return string
     */
    public function getMgtCoZip()
    {
        return $this->mgtCoZip;
    }

    /**
     * Set mgtCoPointOfContact
     *
     * @param string $mgtCoPointOfContact
     *
     * @return Settings
     */
    public function setMgtCoPointOfContact($mgtCoPointOfContact)
    {
        $this->mgtCoPointOfContact = $mgtCoPointOfContact;

        return $this;
    }

    /**
     * Get mgtCoPointOfContact
     *
     * @return string
     */
    public function getMgtCoPointOfContact()
    {
        return $this->mgtCoPointOfContact;
    }

    /**
     * Set mgtCoPointOfContactPhone
     *
     * @param string $mgtCoPointOfContactPhone
     *
     * @return Settings
     */
    public function setMgtCoPointOfContactPhone($mgtCoPointOfContactPhone)
    {
        $this->mgtCoPointOfContactPhone = $mgtCoPointOfContactPhone;

        return $this;
    }

    /**
     * Get mgtCoPointOfContactPhone
     *
     * @return string
     */
    public function getMgtCoPointOfContactPhone()
    {
        return $this->mgtCoPointOfContactPhone;
    }

    /**
     * Set mgtCoPointOfContactEmail
     *
     * @param string $mgtCoPointOfContactEmail
     *
     * @return Settings
     */
    public function setMgtCoPointOfContactEmail($mgtCoPointOfContactEmail)
    {
        $this->mgtCoPointOfContactEmail = $mgtCoPointOfContactEmail;

        return $this;
    }

    /**
     * Get mgtCoPointOfContactEmail
     *
     * @return string
     */
    public function getMgtCoPointOfContactEmail()
    {
        return $this->mgtCoPointOfContactEmail;
    }

    /**
     * Set mgtCoPointOfContactWebsite
     *
     * @param string $mgtCoPointOfContactWebsite
     *
     * @return Settings
     */
    public function setMgtCoPointOfContactWebsite($mgtCoPointOfContactWebsite)
    {
        $this->mgtCoPointOfContactWebsite = $mgtCoPointOfContactWebsite;

        return $this;
    }

    /**
     * Get mgtCoPointOfContactWebsite
     *
     * @return string
     */
    public function getMgtCoPointOfContactWebsite()
    {
        return $this->mgtCoPointOfContactWebsite;
    }
}
