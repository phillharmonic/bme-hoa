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
 * Description of Goals
 *
 * Goals are for the HOA and should be set annually.  They are not assigned specifically to any one
 * person, Trustee, or Board member.  They are just that.  Goals.  Goals need to be measureable. At
 * quarterly Board meetings, the Board should assess their goals and their progress.  
 * 
 * At any time, a trustee (any trustee) can provide a progress note and with it, can move the progress
 * completion bar to his/her choosing (example: 50% complete)
 * 
 * Goals should not be confused with TASKS that are assignable.  
 */


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
    protected $name;  //string
    
    /**
     * @ORM\Column(type="string")
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
     * @return Goal
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
}
