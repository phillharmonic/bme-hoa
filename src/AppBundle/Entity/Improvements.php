<?php

/*
 * 
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Goal
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ImprovementsRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Improvements {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Property", inversedBy="improvements")
     */
    protected $property;  
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $type;  //interior or exterior
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $improvement;  //string
    
    /**
     * @ORM\Column(type="date")
     */   
    protected $improvementDate;  
    
    

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
     * @return Improvements
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
     * Set improvement
     *
     * @param string $improvement
     *
     * @return Improvements
     */
    public function setImprovement($improvement)
    {
        $this->improvement = $improvement;

        return $this;
    }

    /**
     * Get improvement
     *
     * @return string
     */
    public function getImprovement()
    {
        return $this->improvement;
    }

    /**
     * Set improvementDate
     *
     * @param \DateTime $improvementDate
     *
     * @return Improvements
     */
    public function setImprovementDate($improvementDate)
    {
        $this->improvementDate = $improvementDate;

        return $this;
    }

    /**
     * Get improvementDate
     *
     * @return \DateTime
     */
    public function getImprovementDate()
    {
        return $this->improvementDate;
    }

    /**
     * Set property
     *
     * @param \AppBundle\Entity\Property $property
     *
     * @return Improvements
     */
    public function setProperty(\AppBundle\Entity\Property $property = null)
    {
        $this->property = $property;

        return $this;
    }

    /**
     * Get property
     *
     * @return \AppBundle\Entity\Property
     */
    public function getProperty()
    {
        return $this->property;
    }
}
