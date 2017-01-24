<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 * 
 * Good Goals & Milestones should:
 * 
 *  Specific
    Measurable
    Achievable
    Relevant
    Timely
 * 
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Description of Progress Note
 *
 * A Progress Note is for updating a Goal.
 */


/**
 * ProgressNote
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ProgressNoteRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class ProgressNote {
    
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
    protected $name;  //string
    
    /**
     * @ORM\Column(type="string")
     */       
    protected $description;  //string
    
    /**
     * @ORM\Column(type="date")
     */       
    protected $completionGoalDate;  //date
    
    /**
     * @ORM\Column(type="date")
     */   
    protected $created; 
    
    /**
     * @ORM\Column(type="date")
     */   
    protected $updated;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Goal")
     */
    protected $goal; //entity
    
    /**
     * @ORM\Column(type="integer")
     */   
    protected $completionPercentage;    
    

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
     * Set name
     *
     * @param string $name
     *
     * @return ProgressNote
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return ProgressNote
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
     * Set completionGoalDate
     *
     * @param \DateTime $completionGoalDate
     *
     * @return ProgressNote
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return ProgressNote
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
     * @return ProgressNote
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
     * Set completionPercentage
     *
     * @param integer $completionPercentage
     *
     * @return ProgressNote
     */
    public function setCompletionPercentage($completionPercentage)
    {
        $this->completionPercentage = $completionPercentage;

        return $this;
    }

    /**
     * Get completionPercentage
     *
     * @return integer
     */
    public function getCompletionPercentage()
    {
        return $this->completionPercentage;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return ProgressNote
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
     * Set goal
     *
     * @param \AppBundle\Entity\Goal $goal
     *
     * @return ProgressNote
     */
    public function setGoal(\AppBundle\Entity\Goal $goal = null)
    {
        $this->goal = $goal;

        return $this;
    }

    /**
     * Get goal
     *
     * @return \AppBundle\Entity\Goal
     */
    public function getGoal()
    {
        return $this->goal;
    }
}
