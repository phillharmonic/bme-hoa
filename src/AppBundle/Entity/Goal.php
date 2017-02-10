<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Good Goals & Milestones should:
 * 
 *  Units: (emails, collections, houses, etc...)
 *  unitsGoal: (94, 100, etc... must be number)
 * 
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Goal
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\GoalRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Goal {
    
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
     */
    protected $user;  //entity
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $action;  //string
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $units;  //string
    
    /**
     * @ORM\Column(type="integer")
     */   
    protected $unitsGoal;  
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */       
    protected $description;  //string
    
    /**
     * @ORM\Column(type="date")
     */   
    protected $created; 
    
    /**
     * @ORM\Column(type="date")
     */   
    protected $updated;
    
    /**
     * @ORM\Column(type="date")
     */       
    protected $completionGoalDate;  //date
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */   
    protected $percentComplete;      
    
    /**
     * @ORM\Column(type="integer", nullable=true)
     */   
    protected $totalComplete;         
    
    /**
     * One Goal has Many Progress Notes
     * 
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\ProgressNote", mappedBy="goal")
     */       
    protected $progressNotes;
    
    
    public function __construct()
    {
        $this->progressNotes = new ArrayCollection();
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
    }    
    
    /**
     * @ORM\PrePersist
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $goal = $args->getEntity();
        if($goal->getCreated() === null){ 
            $goal->setCreated(new \DateTime());
        }
        $goal->setUpdated(new \DateTime());
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
     * Set action
     *
     * @param string $action
     *
     * @return Goal
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
     * Set units
     *
     * @param string $units
     *
     * @return Goal
     */
    public function setUnits($units)
    {
        $this->units = $units;

        return $this;
    }

    /**
     * Get units
     *
     * @return string
     */
    public function getUnits()
    {
        return $this->units;
    }

    /**
     * Set unitsGoal
     *
     * @param integer $unitsGoal
     *
     * @return Goal
     */
    public function setUnitsGoal($unitsGoal)
    {
        $this->unitsGoal = $unitsGoal;

        return $this;
    }

    /**
     * Get unitsGoal
     *
     * @return integer
     */
    public function getUnitsGoal()
    {
        return $this->unitsGoal;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Goal
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Goal
     */
    public function setCreated($created)
    {
        $this->created = $created;

        return $this;
    }

    /**
     * Get created
     *
     * @return \DateTime
     */
    public function getCreated()
    {
        return $this->created;
    }

    /**
     * Set updated
     *
     * @param \DateTime $updated
     *
     * @return Goal
     */
    public function setUpdated($updated)
    {
        $this->updated = $updated;

        return $this;
    }

    /**
     * Get updated
     *
     * @return \DateTime
     */
    public function getUpdated()
    {
        return $this->updated;
    }

    /**
     * Set completionGoalDate
     *
     * @param \DateTime $completionGoalDate
     *
     * @return Goal
     */
    public function setCompletionGoalDate($completionGoalDate)
    {
        $this->completionGoalDate = $completionGoalDate;

        return $this;
    }

    /**
     * Get completionGoalDate
     *
     * @return \DateTime
     */
    public function getCompletionGoalDate()
    {
        return $this->completionGoalDate;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Goal
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
     * Add progressNote
     *
     * @param \AppBundle\Entity\ProgressNote $progressNote
     *
     * @return Goal
     */
    public function addProgressNote(\AppBundle\Entity\ProgressNote $progressNote)
    {
        $this->progressNotes[] = $progressNote;

        return $this;
    }

    /**
     * Remove progressNote
     *
     * @param \AppBundle\Entity\ProgressNote $progressNote
     */
    public function removeProgressNote(\AppBundle\Entity\ProgressNote $progressNote)
    {
        $this->progressNotes->removeElement($progressNote);
    }

    /**
     * Get progressNotes
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProgressNotes()
    {
        return $this->progressNotes;
    }

    /**
     * Set percentComplete
     *
     * @param integer $percentComplete
     *
     * @return Goal
     */
    public function setPercentComplete($percentComplete)
    {
        $this->percentComplete = $percentComplete;

        return $this;
    }

    /**
     * Get percentComplete
     *
     * @return integer
     */
    public function getPercentComplete()
    {
        return $this->percentComplete;
    }

    /**
     * Set totalComplete
     *
     * @param integer $totalComplete
     *
     * @return Goal
     */
    public function setTotalComplete($totalComplete)
    {
        $this->totalComplete = $totalComplete;

        return $this;
    }

    /**
     * Get totalComplete
     *
     * @return integer
     */
    public function getTotalComplete()
    {
        return $this->totalComplete;
    }
}
