<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Action
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ActionRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Action
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Complaint", mappedBy="action")
     */
    protected $complaints;    
    
    /**
     * @ORM\Column(type="string")
     */
    protected $type;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $action;      
    
    /**
     * @ORM\Column(type="string")
     */
    protected $description;   
    
    /**
     * @ORM\Column(type="date")
     */
    protected $date_taken;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $taken_by;    
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $is_resolved;      

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->complaints = new \Doctrine\Common\Collections\ArrayCollection();
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
     * @return Action
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
     * Set action
     *
     * @param string $action
     *
     * @return Action
     */
    public function setAction($action)
    {
        $this->action = $action;

        return $this;
    }

    /**
     * Get action
     *
     * @return string
     */
    public function getAction()
    {
        return $this->action;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Action
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
     * Set dateTaken
     *
     * @param \DateTime $dateTaken
     *
     * @return Action
     */
    public function setDateTaken($dateTaken)
    {
        $this->date_taken = $dateTaken;

        return $this;
    }

    /**
     * Get dateTaken
     *
     * @return \DateTime
     */
    public function getDateTaken()
    {
        return $this->date_taken;
    }

    /**
     * Set takenBy
     *
     * @param string $takenBy
     *
     * @return Action
     */
    public function setTakenBy($takenBy)
    {
        $this->taken_by = $takenBy;

        return $this;
    }

    /**
     * Get takenBy
     *
     * @return string
     */
    public function getTakenBy()
    {
        return $this->taken_by;
    }

    /**
     * Set isResolved
     *
     * @param boolean $isResolved
     *
     * @return Action
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
     * Add complaint
     *
     * @param \AppBundle\Entity\Complaint $complaint
     *
     * @return Action
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
}
