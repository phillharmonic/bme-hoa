<?php

/*
 * Comps are average home values in the different regions:
 * 
 * National, State, County, Township, and finally Neighborhood
 * 
 * These are annual comps maintained my the board, or by the management company.  They show up on
 * all the property profiles.  
 * 
 * Min & Max value are the values on the comp charts plot line
 * 
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Comps
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\CompsRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Comps {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="integer")
     */   
    protected $year;  
    
    /**
     * @ORM\Column(type="integer")
     */   
    protected $avgNationally;
    
    /**
     * @ORM\Column(type="integer")
     */   
    protected $avgState;  
    
    /**
     * @ORM\Column(type="integer")
     */   
    protected $avgCounty;
    
    /**
     * @ORM\Column(type="integer")
     */   
    protected $avgTownship;
    
    /**
     * @ORM\Column(type="integer")
     */   
    protected $avgNeighborhood;
    
    /**
     * @ORM\Column(type="integer")
     */   
    protected $maxValue;

    /**
     * @ORM\Column(type="integer")
     */   
    protected $minValue;    
    

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
     * Set year
     *
     * @param integer $year
     *
     * @return Comps
     */
    public function setYear($year)
    {
        $this->year = $year;

        return $this;
    }

    /**
     * Get year
     *
     * @return integer
     */
    public function getYear()
    {
        return $this->year;
    }

    /**
     * Set avgNationaly
     *
     * @param integer $avgNationally
     *
     * @return Comps
     */
    public function setAvgNationally($avgNationally)
    {
        $this->avgNationally = $avgNationally;

        return $this;
    }

    /**
     * Get avgNationally
     *
     * @return integer
     */
    public function getAvgNationally()
    {
        return $this->avgNationally;
    }

    /**
     * Set avgState
     *
     * @param integer $avgState
     *
     * @return Comps
     */
    public function setAvgState($avgState)
    {
        $this->avgState = $avgState;

        return $this;
    }

    /**
     * Get avgState
     *
     * @return integer
     */
    public function getAvgState()
    {
        return $this->avgState;
    }

    /**
     * Set avgCounty
     *
     * @param integer $avgCounty
     *
     * @return Comps
     */
    public function setAvgCounty($avgCounty)
    {
        $this->avgCounty = $avgCounty;

        return $this;
    }

    /**
     * Get avgCounty
     *
     * @return integer
     */
    public function getAvgCounty()
    {
        return $this->avgCounty;
    }

    /**
     * Set avgTownship
     *
     * @param integer $avgTownship
     *
     * @return Comps
     */
    public function setAvgTownship($avgTownship)
    {
        $this->avgTownship = $avgTownship;

        return $this;
    }

    /**
     * Get avgTownship
     *
     * @return integer
     */
    public function getAvgTownship()
    {
        return $this->avgTownship;
    }

    /**
     * Set avgNeighborhood
     *
     * @param integer $avgNeighborhood
     *
     * @return Comps
     */
    public function setAvgNeighborhood($avgNeighborhood)
    {
        $this->avgNeighborhood = $avgNeighborhood;

        return $this;
    }

    /**
     * Get avgNeighborhood
     *
     * @return integer
     */
    public function getAvgNeighborhood()
    {
        return $this->avgNeighborhood;
    }

    /**
     * Set maxValue
     *
     * @param integer $maxValue
     *
     * @return Comps
     */
    public function setMaxValue($maxValue)
    {
        $this->maxValue = $maxValue;

        return $this;
    }

    /**
     * Get maxValue
     *
     * @return integer
     */
    public function getMaxValue()
    {
        return $this->maxValue;
    }

    /**
     * Set minValuey
     *
     * @param integer $minValue
     *
     * @return Comps
     */
    public function setMinValue($minValue)
    {
        $this->minValue = $minValue;

        return $this;
    }

    /**
     * Get minValue
     *
     * @return integer
     */
    public function getMinValue()
    {
        return $this->minValue;
    }
}
