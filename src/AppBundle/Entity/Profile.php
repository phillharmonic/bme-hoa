<?php

/**
 * This is a USER'S profile... it should not be the profile of the user's spouse, dependents or kids.  
 * 
 * Going to keep the other entities (dependents, pets, and vehicles)... and just deal with the dupes via code.  Chances are, not many dependents will create their own account
 * in the age of Facebook.
 * 
 * Spouses - are different - They can and probably will want their own account at some point to stay informed of HOA business.  
 * 
 *
 * Author: Patrick D Hollis
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * Profile
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ProfileRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Profile {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;  //unique
    
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\User", inversedBy="profile")
     */       
    protected $user;
    
    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $profilePublic;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $profileProtected;    
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $bday;
    
    /**
     * @ORM\Column(type="string", length=10, nullable=true)
     */
    protected $gender;
    
    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    protected $maritalStatus;
    
    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $occupation;
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $employer; 

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $race;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $facebook;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $twitter;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $google;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $linkedIn;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $bio;
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $aboutMe;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $job;    
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Skills", mappedBy="profile")
     */
    protected $skills;    
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */
    protected $resumeLink;    
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Photos", mappedBy="profile")
     */
    protected $photos;     
    
    /**
     * @ORM\PrePersist
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        
    }   
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->skills = new \Doctrine\Common\Collections\ArrayCollection();
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set profilePublic
     *
     * @param boolean $profilePublic
     *
     * @return Profile
     */
    public function setProfilePublic($profilePublic)
    {
        $this->profilePublic = $profilePublic;

        return $this;
    }

    /**
     * Get profilePublic
     *
     * @return boolean
     */
    public function getProfilePublic()
    {
        return $this->profilePublic;
    }

    /**
     * Set profileProtected
     *
     * @param boolean $profileProtected
     *
     * @return Profile
     */
    public function setProfileProtected($profileProtected)
    {
        $this->profileProtected = $profileProtected;

        return $this;
    }

    /**
     * Get profileProtected
     *
     * @return boolean
     */
    public function getProfileProtected()
    {
        return $this->profileProtected;
    }

    /**
     * Set bday
     *
     * @param \DateTime $bday
     *
     * @return Profile
     */
    public function setBday($bday)
    {
        $this->bday = $bday;

        return $this;
    }

    /**
     * Get bday
     *
     * @return \DateTime
     */
    public function getBday()
    {
        return $this->bday;
    }

    /**
     * Set gender
     *
     * @param string $gender
     *
     * @return Profile
     */
    public function setGender($gender)
    {
        $this->gender = $gender;

        return $this;
    }

    /**
     * Get gender
     *
     * @return string
     */
    public function getGender()
    {
        return $this->gender;
    }

    /**
     * Set maritalStatus
     *
     * @param string $maritalStatus
     *
     * @return Profile
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->maritalStatus = $maritalStatus;

        return $this;
    }

    /**
     * Get maritalStatus
     *
     * @return string
     */
    public function getMaritalStatus()
    {
        return $this->maritalStatus;
    }

    /**
     * Set occupation
     *
     * @param string $occupation
     *
     * @return Profile
     */
    public function setOccupation($occupation)
    {
        $this->occupation = $occupation;

        return $this;
    }

    /**
     * Get occupation
     *
     * @return string
     */
    public function getOccupation()
    {
        return $this->occupation;
    }

    /**
     * Set employer
     *
     * @param string $employer
     *
     * @return Profile
     */
    public function setEmployer($employer)
    {
        $this->employer = $employer;

        return $this;
    }

    /**
     * Get employer
     *
     * @return string
     */
    public function getEmployer()
    {
        return $this->employer;
    }

    /**
     * Set race
     *
     * @param string $race
     *
     * @return Profile
     */
    public function setRace($race)
    {
        $this->race = $race;

        return $this;
    }

    /**
     * Get race
     *
     * @return string
     */
    public function getRace()
    {
        return $this->race;
    }

    /**
     * Set facebook
     *
     * @param string $facebook
     *
     * @return Profile
     */
    public function setFacebook($facebook)
    {
        $this->facebook = $facebook;

        return $this;
    }

    /**
     * Get facebook
     *
     * @return string
     */
    public function getFacebook()
    {
        return $this->facebook;
    }

    /**
     * Set twitter
     *
     * @param string $twitter
     *
     * @return Profile
     */
    public function setTwitter($twitter)
    {
        $this->twitter = $twitter;

        return $this;
    }

    /**
     * Get twitter
     *
     * @return string
     */
    public function getTwitter()
    {
        return $this->twitter;
    }

    /**
     * Set google
     *
     * @param string $google
     *
     * @return Profile
     */
    public function setGoogle($google)
    {
        $this->google = $google;

        return $this;
    }

    /**
     * Get google
     *
     * @return string
     */
    public function getGoogle()
    {
        return $this->google;
    }

    /**
     * Set linkedIn
     *
     * @param string $linkedIn
     *
     * @return Profile
     */
    public function setLinkedIn($linkedIn)
    {
        $this->linkedIn = $linkedIn;

        return $this;
    }

    /**
     * Get linkedIn
     *
     * @return string
     */
    public function getLinkedIn()
    {
        return $this->linkedIn;
    }

    /**
     * Set bio
     *
     * @param string $bio
     *
     * @return Profile
     */
    public function setBio($bio)
    {
        $this->bio = $bio;

        return $this;
    }

    /**
     * Get bio
     *
     * @return string
     */
    public function getBio()
    {
        return $this->bio;
    }

    /**
     * Set aboutMe
     *
     * @param string $aboutMe
     *
     * @return Profile
     */
    public function setAboutMe($aboutMe)
    {
        $this->aboutMe = $aboutMe;

        return $this;
    }

    /**
     * Get aboutMe
     *
     * @return string
     */
    public function getAboutMe()
    {
        return $this->aboutMe;
    }

    /**
     * Set job
     *
     * @param string $job
     *
     * @return Profile
     */
    public function setJob($job)
    {
        $this->job = $job;

        return $this;
    }

    /**
     * Get job
     *
     * @return string
     */
    public function getJob()
    {
        return $this->job;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Profile
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
     * Add skill
     *
     * @param \AppBundle\Entity\Skills $skill
     *
     * @return Profile
     */
    public function addSkill(\AppBundle\Entity\Skills $skill)
    {
        $this->skills[] = $skill;

        return $this;
    }

    /**
     * Remove skill
     *
     * @param \AppBundle\Entity\Skills $skill
     */
    public function removeSkill(\AppBundle\Entity\Skills $skill)
    {
        $this->skills->removeElement($skill);
    }

    /**
     * Get skills
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSkills()
    {
        return $this->skills;
    }

    /**
     * Add photo
     *
     * @param \AppBundle\Entity\Photos $photo
     *
     * @return Profile
     */
    public function addPhoto(\AppBundle\Entity\Photos $photo)
    {
        $this->photos[] = $photo;

        return $this;
    }

    /**
     * Remove photo
     *
     * @param \AppBundle\Entity\Photos $photo
     */
    public function removePhoto(\AppBundle\Entity\Photos $photo)
    {
        $this->photos->removeElement($photo);
    }

    /**
     * Get photos
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPhotos()
    {
        return $this->photos;
    }

    /**
     * Set resumeLink
     *
     * @param string $resumeLink
     *
     * @return Profile
     */
    public function setResumeLink($resumeLink)
    {
        $this->resumeLink = $resumeLink;

        return $this;
    }

    /**
     * Get resumeLink
     *
     * @return string
     */
    public function getResumeLink()
    {
        return $this->resumeLink;
    }
}
