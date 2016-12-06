<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    protected $user;    
    
    /**
     * @ORM\Column(type="string", length=25)
     */
    protected $type;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $details;
    
    /**
     * @ORM\Column(type="string", length=50)
     */
    protected $assigned_to;
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $is_resolved;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $date_issued;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $date_resolved;
    
    /**
     * @ORM\Column(type="date")
     */
    protected $date_updated;

    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Action", inversedBy="complaints", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $actions;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actions = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set dateIssued
     *
     * @param \DateTime $dateIssued
     *
     * @return Complaint
     */
    public function setDateIssued($dateIssued)
    {
        $this->date_issued = $dateIssued;

        return $this;
    }

    /**
     * Get dateIssued
     *
     * @return \DateTime
     */
    public function getDateIssued()
    {
        return $this->date_issued;
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
}
