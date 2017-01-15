<?php

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;


/**
 * Comment
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\MinutesRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Minutes {
    
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
    protected $user;

    /**
     * @ORM\Column(type="integer")
     */
    protected $year;
    
    /**
     * @ORM\Column(type="integer")
     */
    protected $quarter;
    
    /**
     * @ORM\Column(type="string")
     */
    protected $title;

    /**
     * @ORM\Column(type="string")
     */
    protected $embed_code;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $created;

    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated;

    public function __construct()
    {
        $this->setCreated(new \DateTime());
        $this->setUpdated(new \DateTime());
    }

    /**
     * @ORM\preUpdate
     */
    public function setUpdatedValue()
    {
       $this->setUpdated(new \DateTime());
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
     * Set title
     *
     * @param string $title
     *
     * @return Minutes
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set embedCode
     *
     * @param string $embedCode
     *
     * @return Minutes
     */
    public function setEmbedCode($embedCode)
    {
        $this->embed_code = $embedCode;

        return $this;
    }

    /**
     * Get embedCode
     *
     * @return string
     */
    public function getEmbedCode()
    {
        return $this->embed_code;
    }

    /**
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Minutes
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
     * @return Minutes
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
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Minutes
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
     * Set year
     *
     * @param integer $year
     *
     * @return Minutes
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
     * Set quarter
     *
     * @param integer $quarter
     *
     * @return Minutes
     */
    public function setQuarter($quarter)
    {
        $this->quarter = $quarter;

        return $this;
    }

    /**
     * Get quarter
     *
     * @return integer
     */
    public function getQuarter()
    {
        return $this->quarter;
    }
}
