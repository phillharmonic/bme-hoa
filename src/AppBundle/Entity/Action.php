<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Action
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\ActionRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Action
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
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Complaint", mappedBy="action")
     */
    protected $complaints;    
    
    /**
     * @ORM\Column(type="string", length=25)
     */
    protected $type;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $description;   
    
    /**
     * @ORM\Column(type="date")
     */
    protected $date_taken;

    /**
     * Constructor
     */
    public function __construct()
    {
        $this->complaints = new \Doctrine\Common\Collections\ArrayCollection();
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
     * Set type
     *
     * @param string $type
     *
     * @return Action
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
     * Set description
     *
     * @param string $description
     *
     * @return Action
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
     * Add complaint
     *
     * @param \AppBundle\Entity\Complaint $complaint
     *
     * @return Action
     */
    public function addComplaint(\AppBundle\Entity\Complaint $complaint)
    {
        $this->complaints[] = $complaint;

        return $this;
    }

    /**
     * Remove complaint
     *
     * @param \AppBundle\Entity\Complaint $complaint
     */
    public function removeComplaint(\AppBundle\Entity\Complaint $complaint)
    {
        $this->complaints->removeElement($complaint);
    }

    /**
     * Get complaints
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getComplaints()
    {
        return $this->complaints;
    }

    /**
     * Set dateTaken
     *
     * @param \DateTime $dateTaken
     *
     * @return Action
     */
    public function setDateTaken($dateTaken)
    {
        $this->date_taken = $dateTaken;

        return $this;
    }

    /**
     * Get dateTaken
     *
     * @return \DateTime
     */
    public function getDateTaken()
    {
        return $this->date_taken;
    }
}
