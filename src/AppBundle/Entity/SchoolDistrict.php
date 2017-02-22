<?php

/*
 * School District info will be stored here...
 * 
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Goal
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\SchoolDistrictRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class SchoolDistrict {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $schoolDistrict;  
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $schoolDistrictLink;  
    
    /**
     * @ORM\Column(type="integer")
     */   
    protected $statsYear;  
    
    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */   
    protected $achievementScore;  
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $achievementGrade;  
    
    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */   
    protected $gapScore;  
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $gapGrade;  
    
    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */   
    protected $literacyScore;  
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $literacyGrade;  
    
    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */   
    protected $progressScore;  
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $progressGrade;  
    
    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */   
    protected $gradRateScore;  
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $gradRateGrade;  
    
    /**
     * @ORM\Column(type="decimal", precision=5, scale=2)
     */   
    protected $successScore;  
    
    /**
     * @ORM\Column(type="string")
     */   
    protected $successGrade;  
    

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
     * Set schoolDistrict
     *
     * @param string $schoolDistrict
     *
     * @return SchoolDistrict
     */
    public function setSchoolDistrict($schoolDistrict)
    {
        $this->schoolDistrict = $schoolDistrict;

        return $this;
    }

    /**
     * Get schoolDistrict
     *
     * @return string
     */
    public function getSchoolDistrict()
    {
        return $this->schoolDistrict;
    }

    /**
     * Set schoolDistrictLink
     *
     * @param string $schoolDistrictLink
     *
     * @return SchoolDistrict
     */
    public function setSchoolDistrictLink($schoolDistrictLink)
    {
        $this->schoolDistrictLink = $schoolDistrictLink;

        return $this;
    }

    /**
     * Get schoolDistrictLink
     *
     * @return string
     */
    public function getSchoolDistrictLink()
    {
        return $this->schoolDistrictLink;
    }

    /**
     * Set statsYear
     *
     * @param integer $statsYear
     *
     * @return SchoolDistrict
     */
    public function setStatsYear($statsYear)
    {
        $this->statsYear = $statsYear;

        return $this;
    }

    /**
     * Get statsYear
     *
     * @return integer
     */
    public function getStatsYear()
    {
        return $this->statsYear;
    }

    /**
     * Set achievementScore
     *
     * @param string $achievementScore
     *
     * @return SchoolDistrict
     */
    public function setAchievementScore($achievementScore)
    {
        $this->achievementScore = $achievementScore;

        return $this;
    }

    /**
     * Get achievementScore
     *
     * @return string
     */
    public function getAchievementScore()
    {
        return $this->achievementScore;
    }

    /**
     * Set achievementGrade
     *
     * @param string $achievementGrade
     *
     * @return SchoolDistrict
     */
    public function setAchievementGrade($achievementGrade)
    {
        $this->achievementGrade = $achievementGrade;

        return $this;
    }

    /**
     * Get achievementGrade
     *
     * @return string
     */
    public function getAchievementGrade()
    {
        return $this->achievementGrade;
    }

    /**
     * Set gapScore
     *
     * @param string $gapScore
     *
     * @return SchoolDistrict
     */
    public function setGapScore($gapScore)
    {
        $this->gapScore = $gapScore;

        return $this;
    }

    /**
     * Get gapScore
     *
     * @return string
     */
    public function getGapScore()
    {
        return $this->gapScore;
    }

    /**
     * Set gapGrade
     *
     * @param string $gapGrade
     *
     * @return SchoolDistrict
     */
    public function setGapGrade($gapGrade)
    {
        $this->gapGrade = $gapGrade;

        return $this;
    }

    /**
     * Get gapGrade
     *
     * @return string
     */
    public function getGapGrade()
    {
        return $this->gapGrade;
    }

    /**
     * Set literacyScore
     *
     * @param string $literacyScore
     *
     * @return SchoolDistrict
     */
    public function setLiteracyScore($literacyScore)
    {
        $this->literacyScore = $literacyScore;

        return $this;
    }

    /**
     * Get literacyScore
     *
     * @return string
     */
    public function getLiteracyScore()
    {
        return $this->literacyScore;
    }

    /**
     * Set literacyGrade
     *
     * @param string $literacyGrade
     *
     * @return SchoolDistrict
     */
    public function setLiteracyGrade($literacyGrade)
    {
        $this->literacyGrade = $literacyGrade;

        return $this;
    }

    /**
     * Get literacyGrade
     *
     * @return string
     */
    public function getLiteracyGrade()
    {
        return $this->literacyGrade;
    }

    /**
     * Set progressScore
     *
     * @param string $progressScore
     *
     * @return SchoolDistrict
     */
    public function setProgressScore($progressScore)
    {
        $this->progressScore = $progressScore;

        return $this;
    }

    /**
     * Get progressScore
     *
     * @return string
     */
    public function getProgressScore()
    {
        return $this->progressScore;
    }

    /**
     * Set progressGrade
     *
     * @param string $progressGrade
     *
     * @return SchoolDistrict
     */
    public function setProgressGrade($progressGrade)
    {
        $this->progressGrade = $progressGrade;

        return $this;
    }

    /**
     * Get progressGrade
     *
     * @return string
     */
    public function getProgressGrade()
    {
        return $this->progressGrade;
    }

    /**
     * Set gradRateScore
     *
     * @param string $gradRateScore
     *
     * @return SchoolDistrict
     */
    public function setGradRateScore($gradRateScore)
    {
        $this->gradRateScore = $gradRateScore;

        return $this;
    }

    /**
     * Get gradRateScore
     *
     * @return string
     */
    public function getGradRateScore()
    {
        return $this->gradRateScore;
    }

    /**
     * Set gradRateGrade
     *
     * @param string $gradRateGrade
     *
     * @return SchoolDistrict
     */
    public function setGradRateGrade($gradRateGrade)
    {
        $this->gradRateGrade = $gradRateGrade;

        return $this;
    }

    /**
     * Get gradRateGrade
     *
     * @return string
     */
    public function getGradRateGrade()
    {
        return $this->gradRateGrade;
    }

    /**
     * Set successScore
     *
     * @param string $successScore
     *
     * @return SchoolDistrict
     */
    public function setSuccessScore($successScore)
    {
        $this->successScore = $successScore;

        return $this;
    }

    /**
     * Get successScore
     *
     * @return string
     */
    public function getSuccessScore()
    {
        return $this->successScore;
    }

    /**
     * Set successGrade
     *
     * @param string $successGrade
     *
     * @return SchoolDistrict
     */
    public function setSuccessGrade($successGrade)
    {
        $this->successGrade = $successGrade;

        return $this;
    }

    /**
     * Get successGrade
     *
     * @return string
     */
    public function getSuccessGrade()
    {
        return $this->successGrade;
    }
}
