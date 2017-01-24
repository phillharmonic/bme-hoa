<?php

/**
 * The Agenda is created by a board member and will describe the agenda for the year.  Meeting
 * Minutes for the year cannot be created without first having an agenda for the year.  By creating
 * an Agenda, the necessary quarterly minutes can then be a created.  
 * 
 * For the quarterly minutes tabs menu, those are calculated when THEY are created and saved for 
 * that specific year. 
 * 
 * Only one Agenda per year is permissable - because a lot of other methods depend on there only
 * being one agenda per year, and calculating quarterly minutes.  It tells us how many years for
 * the sub-menu.
 * 
 * Allow other admin users to edit.  We need to keep record of 
 * the users who edit so they can be held accountable. But how do you 
 * keep track of the actual edits??  I know!  We keep track of both.
 * Creator, and Updater.  Only the last user who updated is recorded.  The actual updates will
 * not be able to be tracked... to advanced for me. 
 * 
 * Hold the phone.  The agenda is going to be updated a lot.  Make it a google doc that the creator
 * can share with whomever they wish to edit. Don't need to keep track if the updator or the edits.
 * Google Docs will do that for you.  The results will be embeded in the twig page.
 * 
 * Only thing to think about: what if for some reason the creator is negligent and needs oversight?
 * Fuck it.  Too much to think about.  I guess that's where a programmer (me) comes into play.
 *
 * Author: Patrick D Hollis
 */

namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Persistence\Event\LifecycleEventArgs;

/**
 * Agenda
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\AgendaRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class Agenda {
    
    /**
     * @var integer
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;  //unique
    
    /**
     * @ORM\Column(type="integer", unique = true)
     */    
    protected $year; //integer; unique
    
    /**
     * @ORM\Column(type="datetime")
     */    
    protected $created;  //date
    
    /**
     * @ORM\Column(type="string")
     */    
    protected $agenda_path; //string - this is going to be a path to a google doc
    
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User")
     */    
    protected $creator; //user entity
        
    public function __construct()
    {
        $this->creator = new \Doctrine\Common\Collections\ArrayCollection();
    }
    
    /**
     * @ORM\PrePersist
     * @param \Doctrine\ORM\Event\LifecycleEventArgs $args
     */
    public function prePersist(LifecycleEventArgs $args)
    {
        $agenda = $args->getEntity();
        if($agenda->getCreated() === null){ 
            $agenda->setCreated(new \DateTime());
        }
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
     * Set year
     *
     * @param integer $year
     *
     * @return Agenda
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
     * Set created
     *
     * @param \DateTime $created
     *
     * @return Agenda
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
     * Set agendaPath
     *
     * @param string $agendaPath
     *
     * @return Agenda
     */
    public function setAgendaPath($agendaPath)
    {
        $this->agenda_path = $agendaPath;

        return $this;
    }

    /**
     * Get agendaPath
     *
     * @return string
     */
    public function getAgendaPath()
    {
        return $this->agenda_path;
    }

    /**
     * Set creator
     *
     * @param \AppBundle\Entity\User $creator
     *
     * @return Agenda
     */
    public function setCreator(\AppBundle\Entity\User $creator = null)
    {
        $this->creator = $creator;

        return $this;
    }

    /**
     * Get creator
     *
     * @return \AppBundle\Entity\User
     */
    public function getCreator()
    {
        return $this->creator;
    }
}
