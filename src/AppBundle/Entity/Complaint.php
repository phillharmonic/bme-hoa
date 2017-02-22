<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Validator\Constraints\DateTime;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * Complaint
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ComplaintRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Complaint
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
//    /**
//     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", mappedBy="complaints", cascade={"persist"})
//     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
//     */
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="complaints")
     */
    protected $user;    
    
    /**
     * @ORM\Column(type="date")
     * @GRID\Column(title="Submitted", size="150", type="date", filterable=false)
     */
    protected $timestamp;
    
    /**
     * @ORM\Column(type="string", length=100)
     * @GRID\Column(title="Summary", safe=false, filterable=false )
     */
    protected $type;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $details;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $assigned_to;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */    
    protected $defendent_name;

    /**
     * @ORM\Column(type="string", nullable=true)
     */    
    protected $defendent_address;
    
    /**
     * @ORM\Column(type="text")
     */    
    protected $reg_violated;
    
    /**
     * @ORM\Column(type="boolean")
     * @GRID\Column(title="Resolved", size="100", type="boolean")
     */
    protected $is_resolved;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $date_resolved;
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $date_updated;

    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Action", inversedBy="complaints")
     * @ORM\JoinColumn(nullable=true)
     */
    protected $actions;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Photos", inversedBy="complaint", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $photos;
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actions = new \Doctrine\Common\Collections\ArrayCollection();
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
        $this->user = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * @ORM\PrePersist
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $complaint = $args->getEntity();
        if($complaint->getTimestamp() === null){ 
            $complaint->setTimestamp(new \DateTime());
        }
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
     * Set timestamp
     *
     * @param \DateTime $timestamp
     *
     * @return Complaint
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Complaint
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
     * Set details
     *
     * @param string $details
     *
     * @return Complaint
     */
    public function setDetails($details)
    {
        $this->details = $details;

        return $this;
    }

    /**
     * Get details
     *
     * @return string
     */
    public function getDetails()
    {
        return $this->details;
    }

    /**
     * Set assignedTo
     *
     * @param string $assignedTo
     *
     * @return Complaint
     */
    public function setAssignedTo($assignedTo)
    {
        $this->assigned_to = $assignedTo;

        return $this;
    }

    /**
     * Get assignedTo
     *
     * @return string
     */
    public function getAssignedTo()
    {
        return $this->assigned_to;
    }

    /**
     * Set defendentName
     *
     * @param string $defendentName
     *
     * @return Complaint
     */
    public function setDefendentName($defendentName)
    {
        $this->defendent_name = $defendentName;

        return $this;
    }

    /**
     * Get defendentName
     *
     * @return string
     */
    public function getDefendentName()
    {
        return $this->defendent_name;
    }

    /**
     * Set defendentAddress
     *
     * @param string $defendentAddress
     *
     * @return Complaint
     */
    public function setDefendentAddress($defendentAddress)
    {
        $this->defendent_address = $defendentAddress;

        return $this;
    }

    /**
     * Get defendentAddress
     *
     * @return string
     */
    public function getDefendentAddress()
    {
        return $this->defendent_address;
    }

    /**
     * Set regViolated
     *
     * @param string $regViolated
     *
     * @return Complaint
     */
    public function setRegViolated($regViolated)
    {
        $this->reg_violated = $regViolated;

        return $this;
    }

    /**
     * Get regViolated
     *
     * @return string
     */
    public function getRegViolated()
    {
        return $this->reg_violated;
    }

    /**
     * Set isResolved
     *
     * @param boolean $isResolved
     *
     * @return Complaint
     */
    public function setIsResolved($isResolved)
    {
        $this->is_resolved = $isResolved;

        return $this;
    }

    /**
     * Get isResolved
     *
     * @return boolean
     */
    public function getIsResolved()
    {
        return $this->is_resolved;
    }

    /**
     * Set dateResolved
     *
     * @param \DateTime $dateResolved
     *
     * @return Complaint
     */
    public function setDateResolved($dateResolved)
    {
        $this->date_resolved = $dateResolved;

        return $this;
    }

    /**
     * Get dateResolved
     *
     * @return \DateTime
     */
    public function getDateResolved()
    {
        return $this->date_resolved;
    }

    /**
     * Set dateUpdated
     *
     * @param \DateTime $dateUpdated
     *
     * @return Complaint
     */
    public function setDateUpdated($dateUpdated)
    {
        $this->date_updated = $dateUpdated;

        return $this;
    }

    /**
     * Get dateUpdated
     *
     * @return \DateTime
     */
    public function getDateUpdated()
    {
        return $this->date_updated;
    }

    /**
     * Add action
     *
     * @param \AppBundle\Entity\Action $action
     *
     * @return Complaint
     */
    public function addAction(\AppBundle\Entity\Action $action)
    {
        $this->actions[] = $action;

        return $this;
    }

    /**
     * Remove action
     *
     * @param \AppBundle\Entity\Action $action
     */
    public function removeAction(\AppBundle\Entity\Action $action)
    {
        $this->actions->removeElement($action);
    }

    /**
     * Get actions
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getActions()
    {
        return $this->actions;
    }

    /**
     * Add photo
     *
     * @param \AppBundle\Entity\Photos $photo
     *
     * @return Complaint
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Complaint
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
}
