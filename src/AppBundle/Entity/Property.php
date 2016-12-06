<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Property
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PropertyRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Property
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
     * @ORM\Column(type="string", length=25)
     */
    protected $type;  //    Residential, HOA Drainage Pond, Undeveloped Lot, HOA Land, 
    
    /**
     * @ORM\Column(type="string", length=25)
     */
    protected $lot_number;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $is_occupied;    
    
     /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $in_arrears;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $has_hoa_lien;   
    
    /**
     * @ORM\Column(type="string", length=25)
     */
    protected $status; //Owner Resides, For Sale, Rental, Bank Owned, HUD Owned, Builder Owned, In Foreclosure
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $color;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $date_built;
    
    /**
     * @ORM\Column(type="integer", length=3, nullable=true)
     */
    protected $house_number;
    
    /**
     * @ORM\Column(type="string", nullable = true)
     */
    protected $street;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $user;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Photos", inversedBy="photos", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $photos;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }


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
     * @return Property
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
     * Set lotNumber
     *
     * @param string $lotNumber
     *
     * @return Property
     */
    public function setLotNumber($lotNumber)
    {
        $this->lot_number = $lotNumber;

        return $this;
    }

    /**
     * Get lotNumber
     *
     * @return string
     */
    public function getLotNumber()
    {
        return $this->lot_number;
    }

    /**
     * Set status
     *
     * @param string $status
     *
     * @return Property
     */
    public function setStatus($status)
    {
        $this->status = $status;

        return $this;
    }

    /**
     * Get status
     *
     * @return string
     */
    public function getStatus()
    {
        return $this->status;
    }

    /**
     * Set color
     *
     * @param string $color
     *
     * @return Property
     */
    public function setColor($color)
    {
        $this->color = $color;

        return $this;
    }

    /**
     * Get color
     *
     * @return string
     */
    public function getColor()
    {
        return $this->color;
    }

    /**
     * Set dateBuilt
     *
     * @param \DateTime $dateBuilt
     *
     * @return Property
     */
    public function setDateBuilt($dateBuilt)
    {
        $this->date_built = $dateBuilt;

        return $this;
    }

    /**
     * Get dateBuilt
     *
     * @return \DateTime
     */
    public function getDateBuilt()
    {
        return $this->date_built;
    }

    /**
     * Set houseNumber
     *
     * @param integer $houseNumber
     *
     * @return Property
     */
    public function setHouseNumber($houseNumber)
    {
        $this->house_number = $houseNumber;

        return $this;
    }

    /**
     * Get houseNumber
     *
     * @return integer
     */
    public function getHouseNumber()
    {
        return $this->house_number;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return Property
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
     * Add photo
     *
     * @param \AppBundle\Entity\Photos $photo
     *
     * @return Property
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
     * Set isOccupied
     *
     * @param boolean $isOccupied
     *
     * @return Property
     */
    public function setIsOccupied($isOccupied)
    {
        $this->is_occupied = $isOccupied;

        return $this;
    }

    /**
     * Get isOccupied
     *
     * @return boolean
     */
    public function getIsOccupied()
    {
        return $this->is_occupied;
    }

    /**
     * Set hasHoaLien
     *
     * @param boolean $hasHoaLien
     *
     * @return Property
     */
    public function setHasHoaLien($hasHoaLien)
    {
        $this->has_hoa_lien = $hasHoaLien;

        return $this;
    }

    /**
     * Get hasHoaLien
     *
     * @return boolean
     */
    public function getHasHoaLien()
    {
        return $this->has_hoa_lien;
    }

    /**
     * Set inArrears
     *
     * @param boolean $inArrears
     *
     * @return Property
     */
    public function setInArrears($inArrears)
    {
        $this->in_arrears = $inArrears;

        return $this;
    }

    /**
     * Get inArrears
     *
     * @return boolean
     */
    public function getInArrears()
    {
        return $this->in_arrears;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Property
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }
}
