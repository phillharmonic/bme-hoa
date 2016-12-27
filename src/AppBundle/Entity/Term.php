<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Term
 * 
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\TermRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */

class Term 
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Term", mappedBy="term", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $user;  
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $start_date;  
    
    /**
     * @ORM\Column(type="date", nullable=true)
     */
    protected $end_date;    
    
    /**
     * @ORM\Column(type="string", nullable=true)
     */
    protected $trustee_position;    
    
    /**
     * @ORM\Column(type="text", nullable=true)
     */    
    protected $aboutme;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Photos", inversedBy="terms", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     * @ORM\JoinTable(name="term_photos")
     */
    protected $photos;    
    
    
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
     * Set startDate
     *
     * @param \DateTime $startDate
     *
     * @return Term
     */
    public function setStartDate($startDate)
    {
        $this->start_date = $startDate;

        return $this;
    }

    /**
     * Get startDate
     *
     * @return \DateTime
     */
    public function getStartDate()
    {
        return $this->start_date;
    }

    /**
     * Set endDate
     *
     * @param \DateTime $endDate
     *
     * @return Term
     */
    public function setEndDate($endDate)
    {
        $this->end_date = $endDate;

        return $this;
    }

    /**
     * Get endDate
     *
     * @return \DateTime
     */
    public function getEndDate()
    {
        return $this->end_date;
    }

    /**
     * Set trusteePosition
     *
     * @param string $trusteePosition
     *
     * @return Term
     */
    public function setTrusteePosition($trusteePosition)
    {
        $this->trustee_position = $trusteePosition;

        return $this;
    }

    /**
     * Get trusteePosition
     *
     * @return string
     */
    public function getTrusteePosition()
    {
        return $this->trustee_position;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Term
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->user[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->user->removeElement($user);
    }

    /**
     * Get user
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUser()
    {
        return $this->user;
    }

    

    /**
     * Add roles
     *
     * @param \AppBundle\Entity\Roles $roles
     *
     * @return Term
     */
    public function addRoles(\AppBundle\Entity\Roles $roles)
    {
        $this->roles[] = $roles;

        return $this;
    }

    /**
     * Remove roles
     *
     * @param \AppBundle\Entity\Roles $roles
     */
    public function removeRoles(\AppBundle\Entity\Roles $roles)
    {
        $this->roles->removeElement($roles);
    }

    /**
     * Get roles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getRoles()
    {
        return $this->roles;
    }

    /**
     * Set aboutme
     *
     * @param string $aboutme
     *
     * @return Term
     */
    public function setAboutme($aboutme)
    {
        $this->aboutme = $aboutme;

        return $this;
    }

    /**
     * Get aboutme
     *
     * @return string
     */
    public function getAboutme()
    {
        return $this->aboutme;
    }

    /**
     * Add photo
     *
     * @param \AppBundle\Entity\Photos $photo
     *
     * @return Term
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
     * Constructor
     */
    public function __construct()
    {
        $this->photos = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Dependents
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }


}
