<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Photos
 *
 * @ORM\Table()
 * @ORM\Entity
 */
class Photos
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
     * @ORM\Column(type="string", length=75, nullable=true)
     */
    protected $name;   
    
    /**
     * @ORM\Column(type="string", length=250, nullable=true)
     */
    protected $description;
    
    /**
     * @ORM\Column(type="text")
     */
    protected $path;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", mappedBy="photos", cascade={"persist", "remove"})
     */
    private $user;
    
    /**
     * Many Photos have Many Terms.
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Term", mappedBy="photos")
     */    
    private $terms;
    
    /**
     * Many Photos have Many complaints.
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Complaint", mappedBy="photos")
     */    
    private $complaint;
    
    /**
     * Many Photos have Many vehicles.
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Vehicles", mappedBy="photos")
     */    
    private $vehicles;    
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Profile", inversedBy="photos")
     */
    protected $profile;      
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Property", mappedBy="photos")
     */
    protected $property;       
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $public;    
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->plants = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set name
     *
     * @param string $name
     *
     * @return Photos
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
     * @return Photos
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
     * Set path
     *
     * @param string $path
     *
     * @return Photos
     */
    public function setPath($path)
    {
        $this->path = $path;

        return $this;
    }

    /**
     * Get path
     *
     * @return string
     */
    public function getPath()
    {
        return $this->path;
    }

    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Photos
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
     * Set public
     *
     * @param boolean $public
     *
     * @return Photos
     */
    public function setPublic($public)
    {
        $this->public = $public;

        return $this;
    }

    /**
     * Get public
     *
     * @return boolean
     */
    public function getPublic()
    {
        return $this->public;
    }

    /**
     * Add term
     *
     * @param \AppBundle\Entity\Term $term
     *
     * @return Photos
     */
    public function addTerm(\AppBundle\Entity\Term $term)
    {
        $this->terms[] = $term;

        return $this;
    }

    /**
     * Remove term
     *
     * @param \AppBundle\Entity\Term $term
     */
    public function removeTerm(\AppBundle\Entity\Term $term)
    {
        $this->terms->removeElement($term);
    }

    /**
     * Get terms
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTerms()
    {
        return $this->terms;
    }

    /**
     * Add complaint
     *
     * @param \AppBundle\Entity\Complaint $complaint
     *
     * @return Photos
     */
    public function addComplaint(\AppBundle\Entity\Complaint $complaint)
    {
        $this->complaint[] = $complaint;

        return $this;
    }

    /**
     * Remove complaint
     *
     * @param \AppBundle\Entity\Complaint $complaint
     */
    public function removeComplaint(\AppBundle\Entity\Complaint $complaint)
    {
        $this->complaint->removeElement($complaint);
    }

    /**
     * Get complaint
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComplaint()
    {
        return $this->complaint;
    }

    /**
     * Add vehicle
     *
     * @param \AppBundle\Entity\Complaint $vehicle
     *
     * @return Photos
     */
    public function addVehicle(\AppBundle\Entity\Complaint $vehicle)
    {
        $this->vehicles[] = $vehicle;

        return $this;
    }

    /**
     * Remove vehicle
     *
     * @param \AppBundle\Entity\Complaint $vehicle
     */
    public function removeVehicle(\AppBundle\Entity\Complaint $vehicle)
    {
        $this->vehicles->removeElement($vehicle);
    }

    /**
     * Get vehicles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getVehicles()
    {
        return $this->vehicles;
    }

    /**
     * Set profile
     *
     * @param \AppBundle\Entity\Profile $profile
     *
     * @return Photos
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

    /**
     * Add property
     *
     * @param \AppBundle\Entity\Property $property
     *
     * @return Photos
     */
    public function addProperty(\AppBundle\Entity\Property $property)
    {
        $this->property[] = $property;

        return $this;
    }

    /**
     * Remove property
     *
     * @param \AppBundle\Entity\Property $property
     */
    public function removeProperty(\AppBundle\Entity\Property $property)
    {
        $this->property->removeElement($property);
    }

    /**
     * Get property
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProperty()
    {
        return $this->property;
    }
}
