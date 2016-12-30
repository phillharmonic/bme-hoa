<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * User
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UserRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
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
     * @ORM\Column(type="integer", length=5, nullable=true)
     * @Assert\NotBlank(
     *      message = "Must not be blank"
     * )
     */
    protected $housenumber;
    
    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    protected $street;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $bday;
    
    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $gender;
    
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
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $honorific;
    
    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $occupation;
    
    /**
     * @ORM\Column(type="date", nullable=true, nullable=true)
     */
    protected $occupy_date;
    
    /**
     * @ORM\Column(type="date", nullable=true, options={"default":NULL})
     */
    protected $vacate_date;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Pets", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $pets;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Dependents", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $dependents;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Photos", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $photos;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Vehicles", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $vehicles;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Complaint", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $complaints;    
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Term", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $term;   
    
//    /**
//     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Account", mappedBy="users")
//     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
//     */
    
    //use this one:
    /**
     * @ORM\ManyToOne(targetEntity="Account", inversedBy="users")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     */
    protected $account;

    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->firstname.' '.$this->mi.'. '.$this->lastname;
    }
    
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $is_trustee;
    

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * Set housenumber
     *
     * @param integer $housenumber
     *
     * @return User
     */
    public function setHousenumber($housenumber)
    {
        $this->housenumber = $housenumber;

        return $this;
    }

    /**
     * Get housenumber
     *
     * @return integer
     */
    public function getHousenumber()
    {
        return $this->housenumber;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return User
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set bday
     *
     * @param \DateTime $bday
     *
     * @return User
     */
    public function setBday($bday)
    {
        $this->bday = $bday;

        return $this;
    }

    /**
     * Get bday
     *
     * @return \DateTime
     */
    public function getBday()
    {
        return $this->bday;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return User
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
     * Set maritalStatus
     *
     * @param string $maritalStatus
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * Set honorific
     *
     * @param string $honorific
     *
     * @return User
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
     * Set occupation
     *
     * @param string $occupation
     *
     * @return User
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;

        return $this;
    }

    /**
     * Get occupation
     *
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Set occupyDate
     *
     * @param \DateTime $occupyDate
     *
     * @return User
     */
    public function setOccupyDate($occupyDate)
    {
        $this->occupy_date = $occupyDate;

        return $this;
    }

    /**
     * Get occupyDate
     *
     * @return \DateTime
     */
    public function getOccupyDate()
    {
        return $this->occupy_date;
    }

    /**
     * Set vacateDate
     *
     * @param \DateTime $vacateDate
     *
     * @return User
     */
    public function setVacateDate($vacateDate)
    {
        $this->vacate_date = $vacateDate;

        return $this;
    }

    /**
     * Get vacateDate
     *
     * @return \DateTime
     */
    public function getVacateDate()
    {
        return $this->vacate_date;
    }

    /**
     * Set isTrustee
     *
     * @param boolean $isTrustee
     *
     * @return User
     */
    public function setIsTrustee($isTrustee)
    {
        $this->is_trustee = $isTrustee;

        return $this;
    }

    /**
     * Get isTrustee
     *
     * @return boolean
     */
    public function getIsTrustee()
    {
        return $this->is_trustee;
    }

    /**
     * Add pet
     *
     * @param \AppBundle\Entity\Pets $pet
     *
     * @return User
     */
    public function addPet(\AppBundle\Entity\Pets $pet)
    {
        $this->pets[] = $pet;

        return $this;
    }

    /**
     * Remove pet
     *
     * @param \AppBundle\Entity\Pets $pet
     */
    public function removePet(\AppBundle\Entity\Pets $pet)
    {
        $this->pets->removeElement($pet);
    }

    /**
     * Get pets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPets()
    {
        return $this->pets;
    }

    /**
     * Add dependent
     *
     * @param \AppBundle\Entity\Dependents $dependent
     *
     * @return User
     */
    public function addDependent(\AppBundle\Entity\Dependents $dependent)
    {
        $this->dependents[] = $dependent;

        return $this;
    }

    /**
     * Remove dependent
     *
     * @param \AppBundle\Entity\Dependents $dependent
     */
    public function removeDependent(\AppBundle\Entity\Dependents $dependent)
    {
        $this->dependents->removeElement($dependent);
    }

    /**
     * Get dependents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDependents()
    {
        return $this->dependents;
    }

    /**
     * Add photo
     *
     * @param \AppBundle\Entity\Photos $photo
     *
     * @return User
     */
    public function addPhoto(\AppBundle\Entity\Photos $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \AppBundle\Entity\Photos $photo
     */
    public function removePhoto(\AppBundle\Entity\Photos $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Add vehicle
     *
     * @param \AppBundle\Entity\Vehicles $vehicle
     *
     * @return User
     */
    public function addVehicle(\AppBundle\Entity\Vehicles $vehicle)
    {
        $this->vehicles[] = $vehicle;

        return $this;
    }

    /**
     * Remove vehicle
     *
     * @param \AppBundle\Entity\Vehicles $vehicle
     */
    public function removeVehicle(\AppBundle\Entity\Vehicles $vehicle)
    {
        $this->vehicles->removeElement($vehicle);
    }

    /**
     * Get vehicles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }

    /**
     * Add complaint
     *
     * @param \AppBundle\Entity\Complaint $complaint
     *
     * @return User
     */
    public function addComplaint(\AppBundle\Entity\Complaint $complaint)
    {
        $this->complaints[] = $complaint;

        return $this;
    }

    /**
     * Remove complaint
     *
     * @param \AppBundle\Entity\Complaint $complaint
     */
    public function removeComplaint(\AppBundle\Entity\Complaint $complaint)
    {
        $this->complaints->removeElement($complaint);
    }

    /**
     * Get complaints
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComplaints()
    {
        return $this->complaints;
    }

    /**
     * Add term
     *
     * @param \AppBundle\Entity\Term $term
     *
     * @return User
     */
    public function addTerm(\AppBundle\Entity\Term $term)
    {
        $this->term[] = $term;

        return $this;
    }

    /**
     * Remove term
     *
     * @param \AppBundle\Entity\Term $term
     */
    public function removeTerm(\AppBundle\Entity\Term $term)
    {
        $this->term->removeElement($term);
    }

    /**
     * Get term
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Set account
     *
     * @param \AppBundle\Entity\Account $account
     *
     * @return User
     */
    public function setAccount(\AppBundle\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \AppBundle\Entity\Account
     */
    public function getAccount()
    {
        return $this->account;
    }
}
