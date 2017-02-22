<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Criteria;

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
     * @ORM\Column(type="string", length=25)
     */
    protected $ownership;    
    
    /**
     * @ORM\Column(type="string", length=25)
     */
    protected $occupiedBy;       
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $isRental;
    
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", mappedBy="properties", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $users;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="property", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $accounts;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Photos", inversedBy="property", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $photos;
    
    /**
     * @ORM\Column(type="string", nullable = true)
     */    
    protected $auditors_pin;
    
    /**
     * @ORM\Column(type="integer", nullable = true)
     */    
    protected $last_sale_price;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */    
    protected $last_sale_date;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $lotSize;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $sqFeet;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $numBedrooms;
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    protected $numBathrooms;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Improvements", mappedBy="property", cascade={"persist"}))
     */
    protected $improvements;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Contact", mappedBy="property", cascade={"persist"}))
     */
    protected $contacts;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
        $this->improvements = new \Doctrine\Common\Collections\ArrayCollection();
        $this->accounts = new \Doctrine\Common\Collections\ArrayCollection();
    }

    public function getOccupationStatusString(){
        if ($this->is_occupied == true){
            return "occupied";
        }else {
            return "not occupied";
        }
    }
    
    public function getLienStatusString(){
        if ($this->has_hoa_lien == true){
            return "shows liens filed against it";
        }else {
            return "does not have any liens filed against it";
        }
    }
    
    public function getArrearStatusString(){
        if ($this->in_arrears == true){
            return "not in good";
        }else {
            return "in good";
        }
    }
    
    public function getCurrentOwners(){
        //need to make sure it's the curent residents
        $users = $this->getUsers();        
        $num = count($users); //return $num;
        $names = "";
        if($num > 1){
            foreach($users as $owner){
                if(is_null($owner->getVacateDate())){
                    $names .= $owner->getFullname().' and ';
                }
            }
            $names =  rtrim($names, " and");
        }
        else{
            foreach($users as $owner){
                $names .= $owner->getFullname();
            }
        }
        return $names;
    }
    
    public function blurb(){
        return  "<strong>".$this->house_number." ".
                strtoupper($this->street)."</strong>"." is a ".
                strtolower($this->type)." property located on platted lot # ".
                $this->lot_number." in the Brandy Mill Estates Subdivision of Etna Township in Licking County, Ohio.  The home was built in ".
                date_format($this->date_built, 'F \of Y').", has a ".
                strtolower($this->color)." facade, and is ".
                $this->getOccupationStatusString()." by ".
                $this->getCurrentOwners().".  The property currently ".
                $this->getLienStatusString()." and is ".
                $this->getArrearStatusString()." financial standing with the HOA.  The property last sold ".
                date_format($this->last_sale_date, 'F j, Y'). " for a sale price of ".
                "$".number_format($this->last_sale_price)." according to the Licking County Auditors office.";
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
     * @param \AppBundle\Entity\User $users
     *
     * @return Property
     */
    public function addUsers(\AppBundle\Entity\User $users)
    {
        $this->users[] = $users;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $users
     */
    public function removeUsers(\AppBundle\Entity\User $users)
    {
        $this->user->removeElement($users);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }

    /**
     * Set auditorsPin
     *
     * @param string $auditorsPin
     *
     * @return Property
     */
    public function setAuditorsPin($auditorsPin)
    {
        $this->auditors_pin = $auditorsPin;

        return $this;
    }

    /**
     * Get auditorsPin
     *
     * @return string
     */
    public function getAuditorsPin()
    {
        return $this->auditors_pin;
    }

    /**
     * Set lastSalePrice
     *
     * @param integer $lastSalePrice
     *
     * @return Property
     */
    public function setLastSalePrice($lastSalePrice)
    {
        $this->last_sale_price = $lastSalePrice;

        return $this;
    }

    /**
     * Get lastSalePrice
     *
     * @return integer
     */
    public function getLastSalePrice()
    {
        return $this->last_sale_price;
    }

    /**
     * Set lastSaleDate
     *
     * @param \DateTime $lastSaleDate
     *
     * @return Property
     */
    public function setLastSaleDate($lastSaleDate)
    {
        $this->last_sale_date = $lastSaleDate;

        return $this;
    }

    /**
     * Get lastSaleDate
     *
     * @return \DateTime
     */
    public function getLastSaleDate()
    {
        return $this->last_sale_date;
    }

    /**
     * Set ownership
     *
     * @param string $ownership
     *
     * @return Property
     */
    public function setOwnership($ownership)
    {
        $this->ownership = $ownership;

        return $this;
    }

    /**
     * Get ownership
     *
     * @return string
     */
    public function getOwnership()
    {
        return $this->ownership;
    }

    /**
     * Set occupiedBy
     *
     * @param string $occupiedBy
     *
     * @return Property
     */
    public function setOccupiedBy($occupiedBy)
    {
        $this->occupiedBy = $occupiedBy;

        return $this;
    }

    /**
     * Get occupiedBy
     *
     * @return string
     */
    public function getOccupiedBy()
    {
        return $this->occupiedBy;
    }

    /**
     * Set isRental
     *
     * @param boolean $isRental
     *
     * @return Property
     */
    public function setIsRental($isRental)
    {
        $this->isRental = $isRental;

        return $this;
    }

    /**
     * Get isRental
     *
     * @return boolean
     */
    public function getIsRental()
    {
        return $this->isRental;
    }

    /**
     * Set lotSize
     *
     * @param string $lotSize
     *
     * @return Property
     */
    public function setLotSize($lotSize)
    {
        $this->lotSize = $lotSize;

        return $this;
    }

    /**
     * Get lotSize
     *
     * @return string
     */
    public function getLotSize()
    {
        return $this->lotSize;
    }

    /**
     * Set sqFeet
     *
     * @param string $sqFeet
     *
     * @return Property
     */
    public function setSqFeet($sqFeet)
    {
        $this->sqFeet = $sqFeet;

        return $this;
    }

    /**
     * Get sqFeet
     *
     * @return string
     */
    public function getSqFeet()
    {
        return $this->sqFeet;
    }

    /**
     * Set numBedrooms
     *
     * @param integer $numBedrooms
     *
     * @return Property
     */
    public function setNumBedrooms($numBedrooms)
    {
        $this->numBedrooms = $numBedrooms;

        return $this;
    }

    /**
     * Get numBedrooms
     *
     * @return integer
     */
    public function getNumBedrooms()
    {
        return $this->numBedrooms;
    }

    /**
     * Set numBathrooms
     *
     * @param integer $numBathrooms
     *
     * @return Property
     */
    public function setNumBathrooms($numBathrooms)
    {
        $this->numBathrooms = $numBathrooms;

        return $this;
    }

    /**
     * Get numBathrooms
     *
     * @return integer
     */
    public function getNumBathrooms()
    {
        return $this->numBathrooms;
    }

    /**
     * Add improvement
     *
     * @param \AppBundle\Entity\Improvements $improvement
     *
     * @return Property
     */
    public function addImprovement(\AppBundle\Entity\Improvements $improvement)
    {
        $this->improvements[] = $improvement;

        return $this;
    }

    /**
     * Remove improvement
     *
     * @param \AppBundle\Entity\Improvements $improvement
     */
    public function removeImprovement(\AppBundle\Entity\Improvements $improvement)
    {
        $this->improvements->removeElement($improvement);
    }

    /**
     * Get improvements
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getImprovements()
    {
        return $this->improvements;
    }

    /**
     * Add lienHolder
     *
     * @param \AppBundle\Entity\LienHolder $lienHolder
     *
     * @return Property
     */
    public function addLienHolder(\AppBundle\Entity\LienHolder $lienHolder)
    {
        $this->lienHolders[] = $lienHolder;

        return $this;
    }

    /**
     * Remove lienHolder
     *
     * @param \AppBundle\Entity\LienHolder $lienHolder
     */
    public function removeLienHolder(\AppBundle\Entity\LienHolder $lienHolder)
    {
        $this->lienHolders->removeElement($lienHolder);
    }

    /**
     * Get lienHolders
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getLienHolders()
    {
        return $this->lienHolders;
    }

    /**
     * Add contact
     *
     * @param \AppBundle\Entity\LienHolder $contact
     *
     * @return Property
     */
    public function addContact(\AppBundle\Entity\LienHolder $contact)
    {
        $this->contacts[] = $contact;

        return $this;
    }

    /**
     * Remove contact
     *
     * @param \AppBundle\Entity\LienHolder $contact
     */
    public function removeContact(\AppBundle\Entity\LienHolder $contact)
    {
        $this->contacts->removeElement($contact);
    }

    /**
     * Get contacts
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getContacts()
    {
        return $this->contacts;
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
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    

    /**
     * Set accounts
     *
     * @param \AppBundle\Entity\Account $accounts
     *
     * @return Property
     */
    public function setAccounts(\AppBundle\Entity\Account $accounts = null)
    {
        $this->accounts = $accounts;

        return $this;
    }

    /**
     * Get accounts
     *
     * @return \AppBundle\Entity\Account
     */
    public function getAccounts()
    {
        return $this->accounts;
    }
}
