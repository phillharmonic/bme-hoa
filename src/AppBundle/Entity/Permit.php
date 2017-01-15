<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Constraints\DateTime;
use APY\DataGridBundle\Grid\Mapping as GRID;

/**
 * Permit
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\PermitRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Permit
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Action", inversedBy="permits", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $actions;
    
    /**
     * @ORM\Column(type="date")
     * @GRID\Column(title="Submitted", filterable=false )
     */
    protected $submit_date;
    
    /**
     * @ORM\Column(type="string", length=250)
     * @GRID\Column(title="Summary", safe=false, filterable=false )
     */
    protected $type;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $description;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $location;
    
    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     * 
     * @Assert\NotBlank(message="Please, upload the drawings as a PDF file.")
     */
    protected $drawings;

    /**
     * @ORM\Column(type="string")
     */    
    protected $assoc_name;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @GRID\Column(title="Approved" )
     */    
    protected $is_approved;
        
    /**
     * @ORM\Column(type="boolean", nullable=true)
     * @GRID\Column(title="Denied" )
     */    
    protected $is_denied;    
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $decision_date;
    
    /**
     * @ORM\Column(type="string", length=500, nullable=true)
     */
    protected $decided_by;
    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->actions = new \Doctrine\Common\Collections\ArrayCollection();
    }


    /**
     * @ORM\PrePersist
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $permit = $args->getEntity();
        $permit->setAssocName('Brandy Mill Estates Homeowners Association');
        if($permit->getSubmitDate() === null){ 
            $permit->setSubmitDate(new \DateTime());
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
     * Set submitDate
     *
     * @param \DateTime $submitDate
     *
     * @return Permit
     */
    public function setSubmitDate($submitDate)
    {
        $this->submit_date = $submitDate;

        return $this;
    }

    /**
     * Get submitDate
     *
     * @return \DateTime
     */
    public function getSubmitDate()
    {
        return $this->submit_date;
    }

    /**
     * Set type
     *
     * @param string $type
     *
     * @return Permit
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
     * Set description
     *
     * @param string $description
     *
     * @return Permit
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set location
     *
     * @param string $location
     *
     * @return Permit
     */
    public function setLocation($location)
    {
        $this->location = $location;

        return $this;
    }

    /**
     * Get location
     *
     * @return string
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set drawings
     *
     * @param string $drawings
     *
     * @return Permit
     */
    public function setDrawings($drawings)
    {
        $this->drawings = $drawings;

        return $this;
    }

    /**
     * Get drawings
     *
     * @return string
     */
    public function getDrawings()
    {
        return $this->drawings;
    }

    /**
     * Set assocName
     *
     * @param string $assocName
     *
     * @return Permit
     */
    public function setAssocName($assocName)
    {
        $this->assoc_name = $assocName;

        return $this;
    }

    /**
     * Get assocName
     *
     * @return string
     */
    public function getAssocName()
    {
        return $this->assoc_name;
    }

    /**
     * Set isApproved
     *
     * @param boolean $isApproved
     *
     * @return Permit
     */
    public function setIsApproved($isApproved)
    {
        $this->is_approved = $isApproved;

        return $this;
    }

    /**
     * Get isApproved
     *
     * @return boolean
     */
    public function getIsApproved()
    {
        return $this->is_approved;
    }

    /**
     * Set isDenied
     *
     * @param boolean $isDenied
     *
     * @return Permit
     */
    public function setIsDenied($isDenied)
    {
        $this->is_denied = $isDenied;

        return $this;
    }

    /**
     * Get isDenied
     *
     * @return boolean
     */
    public function getIsDenied()
    {
        return $this->is_denied;
    }

    /**
     * Set decisionDate
     *
     * @param \DateTime $decisionDate
     *
     * @return Permit
     */
    public function setDecisionDate($decisionDate)
    {
        $this->decision_date = $decisionDate;

        return $this;
    }

    /**
     * Get decisionDate
     *
     * @return \DateTime
     */
    public function getDecisionDate()
    {
        return $this->decision_date;
    }

    /**
     * Set decidedBy
     *
     * @param string $decidedBy
     *
     * @return Permit
     */
    public function setDecidedBy($decidedBy)
    {
        $this->decided_by = $decidedBy;

        return $this;
    }

    /**
     * Get decidedBy
     *
     * @return string
     */
    public function getDecidedBy()
    {
        return $this->decided_by;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Permit
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
     * @return Permit
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
