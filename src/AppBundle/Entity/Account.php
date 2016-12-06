<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * Account
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\AccountRepository")
 * @ORM\HasLifecycleCallbacks()
 */
class Account
{
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
//    /**
//     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\User", inversedBy="user", cascade={"persist"})
//     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
//     */
//    private $users;  //an account can have many users, but a user may have only one account; One-To-Many, Unidirectional with Join Table
    

//use this one:
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="account")
     */
    private $users;   
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Property", inversedBy="property", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */    
    private $property; //a property can have many accounts (previous owners), but an account can have only one property; One-To-Many, Unidirectional with Join Table
    
    /**
     * @ORM\Column(type="integer")
     */
    private $balance;
    
    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    protected $is_closed;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $created_at;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $updated_at;
    
    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    protected $closed_at;


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
    *
    * @ORM\PrePersist
    * @ORM\PreUpdate
    */
   public function updatedTimestamps()
   {
       $this->setUpdatedAt(new \DateTime('now'));

       if ($this->getCreatedAt() == null) {
           $this->setCreatedAt(new \DateTime('now'));
       }
   }
    
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->users = new ArrayCollection();
        $this->property = new \Doctrine\Common\Collections\ArrayCollection();
        
    }

    /**
     * Set balance
     *
     * @param integer $balance
     *
     * @return Account
     */
    public function setBalance($balance)
    {
        $this->balance = $balance;

        return $this;
    }

    /**
     * Get balance
     *
     * @return integer
     */
    public function getBalance()
    {
        return $this->balance;
    }


    /**
     * Add property
     *
     * @param \AppBundle\Entity\Property $property
     *
     * @return Account
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

    /**
     * Set isClosed
     *
     * @param boolean $isClosed
     *
     * @return Account
     */
    public function setIsClosed($isClosed)
    {
        $this->is_closed = $isClosed;

        return $this;
    }

    /**
     * Get isClosed
     *
     * @return boolean
     */
    public function getIsClosed()
    {
        return $this->is_closed;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return Account
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set updatedAt
     *
     * @param \DateTime $updatedAt
     *
     * @return Account
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;

        return $this;
    }

    /**
     * Get updatedAt
     *
     * @return \DateTime
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }

    /**
     * Set closedAt
     *
     * @param \DateTime $closedAt
     *
     * @return Account
     */
    public function setClosedAt($closedAt)
    {
        $this->closed_at = $closedAt;

        return $this;
    }

    /**
     * Get closedAt
     *
     * @return \DateTime
     */
    public function getClosedAt()
    {
        return $this->closed_at;
    }


    /**
     * Add user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Account
     */
    public function addUser(\AppBundle\Entity\User $user)
    {
        $this->users[] = $user;

        return $this;
    }

    /**
     * Remove user
     *
     * @param \AppBundle\Entity\User $user
     */
    public function removeUser(\AppBundle\Entity\User $user)
    {
        $this->users->removeElement($user);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getUsers()
    {
        return $this->users;
    }
    
    public function accountNumber(){
        
        $date = $this->created_at;
        
        return  $date->format('Y').'-'.
                $date->format('m').
                $this->id.'-'.
                $date->format('d').
                $date->format('H');
    }
}
