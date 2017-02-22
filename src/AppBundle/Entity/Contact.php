<?php

/*
 * Contact
 * 
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Goal
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ContactRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Contact {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Property", inversedBy="contacts")
     */
    protected $property;  
    
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", mappedBy="contact")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $user;      
    
    // property status stores the purpose of the property: i.e. is it rented, occupied, etc... 
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $type;  //property-contact, business-contact, sub-contractor, contractor, mgt-contact, maintenance, accountant, legal, other
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $occupationStatus;  //occupies the property, rents the property, not-applicable, etc
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $relationToProperty;  //lienholder, co-lienholder, lienholder-relation, co-mortgage-holder, renter, co-renter, renter-relation, other-occupant, not-applicable,
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $specificRelation;  //mom, dad, father, mother, daughter, son, step-son, step-daughter, etc... 
    
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $honorific;
    
    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     * @Assert\NotBlank()
     */
    protected $firstname;
    
    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     * @Assert\NotBlank()
     */
    protected $lastname;
    
    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    protected $mi;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isCurrentLienholder;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isPrimaryContact;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $datePossessed;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $dateTransferred;
    
    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $gender;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $race;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $marital_status;
    
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $cellphone;
    
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $homephone;
    
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $businessphone;        
    
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $fax;    
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $primaryEmail;    
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $secondaryEmail;    
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $businessEmail;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank()
     */
    protected $contactAddress;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank()
     */
    protected $contactCity;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank()
     */
    protected $contactState;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     * @Assert\NotBlank()
     */
    protected $contactZip;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $contactBusinessName;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $pointOfContact;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $dba;    
    

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
     * Set type
     *
     * @param string $type
     *
     * @return LienHolder
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set honorific
     *
     * @param string $honorific
     *
     * @return LienHolder
     */
    public function setHonorific($honorific)
    {
        $this->honorific = $honorific;

        return $this;
    }

    /**
     * Get honorific
     *
     * @return string
     */
    public function getHonorific()
    {
        return $this->honorific;
    }

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return LienHolder
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return LienHolder
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set mi
     *
     * @param string $mi
     *
     * @return LienHolder
     */
    public function setMi($mi)
    {
        $this->mi = $mi;

        return $this;
    }

    /**
     * Get mi
     *
     * @return string
     */
    public function getMi()
    {
        return $this->mi;
    }

    /**
     * Set isCurrentLienholder
     *
     * @param boolean $isCurrentLienholder
     *
     * @return LienHolder
     */
    public function setIsCurrentLienholder($isCurrentLienholder)
    {
        $this->isCurrentLienholder = $isCurrentLienholder;

        return $this;
    }

    /**
     * Get isCurrentLienholder
     *
     * @return boolean
     */
    public function getIsCurrentLienholder()
    {
        return $this->isCurrentLienholder;
    }

    /**
     * Set isPrimaryContact
     *
     * @param boolean $isPrimaryContact
     *
     * @return LienHolder
     */
    public function setIsPrimaryContact($isPrimaryContact)
    {
        $this->isPrimaryContact = $isPrimaryContact;

        return $this;
    }

    /**
     * Get isPrimaryContact
     *
     * @return boolean
     */
    public function getIsPrimaryContact()
    {
        return $this->isPrimaryContact;
    }

    /**
     * Set datePossessed
     *
     * @param \DateTime $datePossessed
     *
     * @return LienHolder
     */
    public function setDatePossessed($datePossessed)
    {
        $this->datePossessed = $datePossessed;

        return $this;
    }

    /**
     * Get datePossessed
     *
     * @return \DateTime
     */
    public function getDatePossessed()
    {
        return $this->datePossessed;
    }

    /**
     * Set dateTransferred
     *
     * @param \DateTime $dateTransferred
     *
     * @return LienHolder
     */
    public function setDateTransferred($dateTransferred)
    {
        $this->dateTransferred = $dateTransferred;

        return $this;
    }

    /**
     * Get dateTransferred
     *
     * @return \DateTime
     */
    public function getDateTransferred()
    {
        return $this->dateTransferred;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return LienHolder
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set race
     *
     * @param string $race
     *
     * @return LienHolder
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return string
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set maritalStatus
     *
     * @param string $maritalStatus
     *
     * @return LienHolder
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->marital_status = $maritalStatus;

        return $this;
    }

    /**
     * Get maritalStatus
     *
     * @return string
     */
    public function getMaritalStatus()
    {
        return $this->marital_status;
    }

    /**
     * Set cellphone
     *
     * @param string $cellphone
     *
     * @return LienHolder
     */
    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;

        return $this;
    }

    /**
     * Get cellphone
     *
     * @return string
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * Set homephone
     *
     * @param string $homephone
     *
     * @return LienHolder
     */
    public function setHomephone($homephone)
    {
        $this->homephone = $homephone;

        return $this;
    }

    /**
     * Get homephone
     *
     * @return string
     */
    public function getHomephone()
    {
        return $this->homephone;
    }

    /**
     * Set businessphone
     *
     * @param string $businessphone
     *
     * @return LienHolder
     */
    public function setBusinessphone($businessphone)
    {
        $this->businessphone = $businessphone;

        return $this;
    }

    /**
     * Get businessphone
     *
     * @return string
     */
    public function getBusinessphone()
    {
        return $this->businessphone;
    }

    /**
     * Set email
     *
     * @param string $email
     *
     * @return LienHolder
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set contactAddress
     *
     * @param string $contactAddress
     *
     * @return LienHolder
     */
    public function setContactAddress($contactAddress)
    {
        $this->contactAddress = $contactAddress;

        return $this;
    }

    /**
     * Get contactAddress
     *
     * @return string
     */
    public function getContactAddress()
    {
        return $this->contactAddress;
    }

    /**
     * Set contactCity
     *
     * @param string $contactCity
     *
     * @return LienHolder
     */
    public function setContactCity($contactCity)
    {
        $this->contactCity = $contactCity;

        return $this;
    }

    /**
     * Get contactCity
     *
     * @return string
     */
    public function getContactCity()
    {
        return $this->contactCity;
    }

    /**
     * Set contactState
     *
     * @param string $contactState
     *
     * @return LienHolder
     */
    public function setContactState($contactState)
    {
        $this->contactState = $contactState;

        return $this;
    }

    /**
     * Get contactState
     *
     * @return string
     */
    public function getContactState()
    {
        return $this->contactState;
    }

    /**
     * Set contactZip
     *
     * @param string $contactZip
     *
     * @return LienHolder
     */
    public function setContactZip($contactZip)
    {
        $this->contactZip = $contactZip;

        return $this;
    }

    /**
     * Get contactZip
     *
     * @return string
     */
    public function getContactZip()
    {
        return $this->contactZip;
    }

    /**
     * Set contactBusinessName
     *
     * @param string $contactBusinessName
     *
     * @return LienHolder
     */
    public function setContactBusinessName($contactBusinessName)
    {
        $this->contactBusinessName = $contactBusinessName;

        return $this;
    }

    /**
     * Get contactBusinessName
     *
     * @return string
     */
    public function getContactBusinessName()
    {
        return $this->contactBusinessName;
    }

    /**
     * Set pointOfContact
     *
     * @param string $pointOfContact
     *
     * @return LienHolder
     */
    public function setPointOfContact($pointOfContact)
    {
        $this->pointOfContact = $pointOfContact;

        return $this;
    }

    /**
     * Get pointOfContact
     *
     * @return string
     */
    public function getPointOfContact()
    {
        return $this->pointOfContact;
    }

    /**
     * Set property
     *
     * @param \AppBundle\Entity\Property $property
     *
     * @return LienHolder
     */
    public function setProperty(\AppBundle\Entity\Property $property = null)
    {
        $this->property = $property;

        return $this;
    }

    /**
     * Get property
     *
     * @return \AppBundle\Entity\Property
     */
    public function getProperty()
    {
        return $this->property;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return LienHolder
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Set fax
     *
     * @param string $fax
     *
     * @return LienHolder
     */
    public function setFax($fax)
    {
        $this->fax = $fax;

        return $this;
    }

    /**
     * Get fax
     *
     * @return string
     */
    public function getFax()
    {
        return $this->fax;
    }

    /**
     * Set primaryEmail
     *
     * @param string $primaryEmail
     *
     * @return LienHolder
     */
    public function setPrimaryEmail($primaryEmail)
    {
        $this->primaryEmail = $primaryEmail;

        return $this;
    }

    /**
     * Get primaryEmail
     *
     * @return string
     */
    public function getPrimaryEmail()
    {
        return $this->primaryEmail;
    }

    /**
     * Set secondaryEmail
     *
     * @param string $secondaryEmail
     *
     * @return LienHolder
     */
    public function setSecondaryEmail($secondaryEmail)
    {
        $this->secondaryEmail = $secondaryEmail;

        return $this;
    }

    /**
     * Get secondaryEmail
     *
     * @return string
     */
    public function getSecondaryEmail()
    {
        return $this->secondaryEmail;
    }

    /**
     * Set businessEmail
     *
     * @param string $businessEmail
     *
     * @return LienHolder
     */
    public function setBusinessEmail($businessEmail)
    {
        $this->businessEmail = $businessEmail;

        return $this;
    }

    /**
     * Get businessEmail
     *
     * @return string
     */
    public function getBusinessEmail()
    {
        return $this->businessEmail;
    }

    /**
     * Set dba
     *
     * @param boolean $dba
     *
     * @return LienHolder
     */
    public function setDba($dba)
    {
        $this->dba = $dba;

        return $this;
    }

    /**
     * Get dba
     *
     * @return boolean
     */
    public function getDba()
    {
        return $this->dba;
    }

    /**
     * Set occupationStatus
     *
     * @param string $occupationStatus
     *
     * @return Contact
     */
    public function setOccupationStatus($occupationStatus)
    {
        $this->occupationStatus = $occupationStatus;

        return $this;
    }

    /**
     * Get occupationStatus
     *
     * @return string
     */
    public function getOccupationStatus()
    {
        return $this->occupationStatus;
    }

    /**
     * Set relationToProperty
     *
     * @param string $relationToProperty
     *
     * @return Contact
     */
    public function setRelationToProperty($relationToProperty)
    {
        $this->relationToProperty = $relationToProperty;

        return $this;
    }

    /**
     * Get relationToProperty
     *
     * @return string
     */
    public function getRelationToProperty()
    {
        return $this->relationToProperty;
    }

    /**
     * Set specificRelation
     *
     * @param string $specificRelation
     *
     * @return Contact
     */
    public function setSpecificRelation($specificRelation)
    {
        $this->specificRelation = $specificRelation;

        return $this;
    }

    /**
     * Get specificRelation
     *
     * @return string
     */
    public function getSpecificRelation()
    {
        return $this->specificRelation;
    }
}
