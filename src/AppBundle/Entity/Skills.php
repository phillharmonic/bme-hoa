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
class Skills {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Profile", inversedBy="skills")
     */
    protected $profile;  
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $skill; 
    
    /**
     * @ORM\Column(type="integer")
     */   
    protected $competancy; 
    
    
    

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
     * Set skill
     *
     * @param string $skill
     *
     * @return Skills
     */
    public function setSkill($skill)
    {
        $this->skill = $skill;

        return $this;
    }

    /**
     * Get skill
     *
     * @return string
     */
    public function getSkill()
    {
        return $this->skill;
    }

    /**
     * Set competancy
     *
     * @param integer $competancy
     *
     * @return Skills
     */
    public function setCompetancy($competancy)
    {
        $this->competancy = $competancy;

        return $this;
    }

    /**
     * Get competancy
     *
     * @return integer
     */
    public function getCompetancy()
    {
        return $this->competancy;
    }

    /**
     * Set profile
     *
     * @param \AppBundle\Entity\Profile $profile
     *
     * @return Skills
     */
    public function setProfile(\AppBundle\Entity\Profile $profile = null)
    {
        $this->profile = $profile;

        return $this;
    }

    /**
     * Get profile
     *
     * @return \AppBundle\Entity\Profile
     */
    public function getProfile()
    {
        return $this->profile;
    }
}
