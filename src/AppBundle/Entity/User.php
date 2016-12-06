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
     * Add dependentId
     *
     * @param \AppBundle\Entity\Dependents $dependentId
     *
     * @return User
     */
    public function addDependentId(\AppBundle\Entity\Dependents $dependentId)
    {
        $this->dependent_ids[] = $dependentId;

        return $this;
    }

    /**
     * Remove dependentId
     *
     * @param \AppBundle\Entity\Dependents $dependentId
     */
    public function removeDependentId(\AppBundle\Entity\Dependents $dependentId)
    {
        $this->dependent_ids->removeElement($dependentId);
    }

    /**
     * Get dependentIds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDependentIds()
    {
        return $this->dependent_ids;
    }

    /**
     * Add photoId
     *
     * @param \AppBundle\Entity\Photos $photoId
     *
     * @return User
     */
    public function addPhotoId(\AppBundle\Entity\Photos $photoId)
    {
        $this->photo_ids[] = $photoId;

        return $this;
    }

    /**
     * Remove photoId
     *
     * @param \AppBundle\Entity\Photos $photoId
     */
    public function removePhotoId(\AppBundle\Entity\Photos $photoId)
    {
        $this->photo_ids->removeElement($photoId);
    }

    /**
     * Get photoIds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotoIds()
    {
        return $this->photo_ids;
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
     * Add petId
     *
     * @param \AppBundle\Entity\Pets $petId
     *
     * @return User
     */
    public function addPetId(\AppBundle\Entity\Pets $petId)
    {
        $this->pet_ids[] = $petId;

        return $this;
    }

    /**
     * Remove petId
     *
     * @param \AppBundle\Entity\Pets $petId
     */
    public function removePetId(\AppBundle\Entity\Pets $petId)
    {
        $this->pet_ids->removeElement($petId);
    }

    /**
     * Get petIds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPetIds()
    {
        return $this->pet_ids;
    }

    /**
     * Add vehicleId
     *
     * @param \AppBundle\Entity\Vehicles $vehicleId
     *
     * @return User
     */
    public function addVehicleId(\AppBundle\Entity\Vehicles $vehicleId)
    {
        $this->vehicle_ids[] = $vehicleId;

        return $this;
    }

    /**
     * Remove vehicleId
     *
     * @param \AppBundle\Entity\Vehicles $vehicleId
     */
    public function removeVehicleId(\AppBundle\Entity\Vehicles $vehicleId)
    {
        $this->vehicle_ids->removeElement($vehicleId);
    }

    /**
     * Get vehicleIds
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVehicleIds()
    {
        return $this->vehicle_ids;
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
    
    public function getUsernames()
    {
        return $this->lastname.', '.$this->firstname;
    }
    
    public function getFullname()
    {
        return $this->firstname.' '.$this->lastname;
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
