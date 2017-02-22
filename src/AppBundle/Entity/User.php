<?php

namespace AppBundle\Entity;

use FOS\UserBundle\Model\User as BaseUser;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\Common\Collections\Criteria;
use NumberFormatter;

/**
 * User
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\UserRepository")
 * @ORM\Table()
 * @ORM\HasLifecycleCallbacks()
 */
class User extends BaseUser
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
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }
    
    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     * @Assert\NotBlank()
     */
    protected $firstname;
    
    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     * @Assert\NotBlank()
     */
    protected $lastname;
    
    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    protected $mi;
    
    /**
     * @ORM\Column(type="integer", length=5, nullable=true)
     * @Assert\NotBlank(
     *      message = "Must not be blank"
     * )
     */
    protected $housenumber;
    
    /**
     * @ORM\Column(type="string", length=25, nullable=true)
     */
    protected $street;
    
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
    protected $marital_status;
    
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $cellphone;
    
    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    protected $homephone;
    
    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    protected $honorific;
    
    /**
     * @ORM\Column(type="string", length=200, nullable=true)
     */
    protected $occupation;
    
    /**
     * @ORM\Column(type="date", nullable=true, nullable=true)
     */
    protected $occupy_date;
    
    /**
     * @ORM\Column(type="date", nullable=true, options={"default":NULL})
     */
    protected $vacate_date;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Property", inversedBy="users", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $properties;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Pets", mappedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $pets;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Dependents", mappedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $dependents;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Photos", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $photos;
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Vehicles", inversedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $vehicles;
    
    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Complaint", mappedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $complaints;    
    
    /**
     * @ORM\ManyToMany(targetEntity="AppBundle\Entity\Term", mappedBy="user", cascade={"persist"})
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $term;   
    
//    /**
//     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Account", mappedBy="users")
//     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
//     */
    
    //use this one:
    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Account", inversedBy="users")
     * @ORM\JoinColumn(name="account_id", referencedColumnName="id")
     */
    protected $account;
    
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Profile", mappedBy="user")
     */
    protected $profile;    
    
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
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $bio_public;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $bio_protected;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $bday_public;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $bday_protected;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $maritalstatus_public;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $maritalstatus_protected;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $homephone_public;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $homephone_protected;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $cellphone_public;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $cellphone_protected;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $occupation_public;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $occupation_protected;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $age_public;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $age_protected;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $email_public;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $email_protected;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $facebook_public;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $facebook_protected;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $twitter_public;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $twitter_protected;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $google_public;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $google_protected;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $linkedIn_public;

    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $linkedIn_protected;    
    
    /**
    * @ORM\Column(type="boolean", nullable=true)
    */
    protected $primaryHouseholdContact;
    
    /**
     * @ORM\OneToOne(targetEntity="AppBundle\Entity\Contact", inversedBy="user")
     * @ORM\JoinColumn(nullable=true, onDelete="CASCADE")
     */
    protected $contact; 

    
    public function getTrusteeTitle(){
//        $honorific = $user->getHonorific();
//        $roles = $user->getRoles();
//        $role = (in_array('ROLE_PRESIDENT', $roles)) ? 'President' : 'Nope';
        return "President";
    }
    
    /**
     * Get fullname
     *
     * @return string
     */
    public function getFullname()
    {
        return $this->firstname.' '.$this->mi.'. '.$this->lastname;
    }
    
    public function getAge($date, $nextYear = false){
        $today   = new \DateTime('today');
        if($nextYear === false) {
            return $date->diff($today)->y;
        }else {
            return $date->diff($today)->y+1;        
        }
    }
    public function pronoun($gender){
        if($gender == "Male"){
            return "He";
        }else{
            return "She";
        }
    }
    public function possesive($gender){
        if($gender == "Male"){
            return "his";
        }else{
            return "her";
        }
    }
    public function getUsersSpouse(){
        $dependents = $this->getDependents();
        $spouse = array();
        foreach($dependents as $dep){
            if($dep->getSpouse() == true ){
                $spouse[] = $dep;
            }
        }
        return $spouse[0];        
    }
    
    public function getNumSpelledOut($number){
        $f = new NumberFormatter("en", NumberFormatter::SPELLOUT);
        return $f->format($number)." ($number) ";
    }
    
    public function getNumDeps(){
        $dependents = $this->getDependents();
        $kids = array();
        foreach($dependents as $dep){
            if($dep->getSpouse() == false ){
                $kids[] = $dep;
            }
        }
        $num = count($kids);
        return $this->getNumSpelledOut($num);
        
    }
    
    public function getDepsLessSpouse(){
        $dependents = $this->getDependents();
        $kids = array();
        foreach($dependents as $dep){
            if($dep->getSpouse() == false ){
                $kids[] = $dep;
            }
        }
        return $kids;
        
    }
    
    public function getDependentsBlurb($possessive){
        $dependents = $this->getDependents();
        $string = "";
        foreach($dependents as $dep){
            if($dep->getSpouse() == false ){
                $string .= 
                        $possessive." ".strtolower($dep->getType()).", ".$dep->getFirstname().", who turns ".
                        $this->getNumSpelledOut($this->getAge($dep->getBday(), true))." on ".
                        date_format($dep->getBday(), 'F j').";&nbsp;&nbsp;"
                        ;
            }
        }
        $formatted = rtrim($string, ';&nbsp;&nbsp;');
        return $formatted;
    }
    
    
    public function getPetsBlurb(){
        $pets = $this->getPets();
        $string = "";
        foreach($pets as $pet){
            $string .= 
                    $pet->getName().", a ".
                    $this->getNumSpelledOut($this->getAge($pet->getBorn(), false))." year old ".
                    strtolower($pet->getGender())." ".
                    strtolower($pet->getColor())." ".
                    strtolower($pet->getBreed())." ".
                    strtolower($pet->getType()).",&nbsp;and&nbsp;"
                    ;
        }
        $formatted = rtrim($string, ',&nbsp;and&nbsp;');
        return $this->getNumSpelledOut(count($pets))."&nbsp;pet(s):&nbsp;&nbsp;".$formatted.".&nbsp;&nbsp;";
    }
    
    public function getVehicleBlurb(){
        $cars = $this->getVehicles();
        $string = "";
        foreach($cars as $car){
            $string .= 
                    $car->getYear().", ".
                    strtolower($car->getColor())." ".
                    $car->getMake()." ".
                    $car->getModel().",&nbsp;and&nbsp;"
                    ;
        }
        $formatted = rtrim($string, ',&nbsp;and&nbsp;');
        return $this->getNumSpelledOut(count($cars))."&nbsp;vehicle(s):&nbsp;&nbsp;a&nbsp;".$formatted.".&nbsp;&nbsp;";
    }    
    
    public function getBlurb(){
//        TODO: make sure the user gave permission for each item to be viewed
        // add: employer, race, facebook, twitter, google+, linkedIn
        $spouse = $this->getUsersSpouse();
        
        return
                "<strong>".$this->honorific." ".
                strtoupper($this->getFullname())."</strong>, a ".
                $this->getAge($this->bday)." year old ".
                strtolower($this->race)." ".
                strtolower($this->gender)." that celebrates ".$this->possesive($this->gender)." birthday on ".
                date_format($this->bday, 'F j').", first moved into the neighborhood in ".
                date_format($this->occupy_date, 'F \of Y').". ".ucfirst($this->possesive($this->gender))." current occupation is listed as ".
                ucfirst($this->occupation)." at ".
                $this->employer.". ".$this->pronoun($this->gender)." is currently ".
                strtolower($this->marital_status)." to ".
                $spouse->getFirstname()." ".$spouse->getLastname().", a ".
                $this->getAge($spouse->getBday(), 'F j')." year old ".
                "CAUCASION"." ".
                strtolower($spouse->getGender())." ".
                " that celebrates ".$this->possesive($spouse->getGender())." birthday on ".
                date_format($spouse->getBday(), 'F j').".&nbsp;&nbsp;".
                ucFirst($this->getFirstname())." has ".
                $this->getNumDeps()." dependent(s): ".
                $this->getDependentsBlurb($this->possesive($this->gender)).".&nbsp;&nbsp;".
                ucFirst($this->getFirstname())." also has ".
                $this->getPetsBlurb()."&nbsp;&nbsp;Additionally, ".
                ucFirst($this->getFirstname())." has ".
                $this->getVehicleBlurb();        
    }
    
    
    /**
     * @ORM\Column(type="boolean")
     */
    protected $is_trustee;
    

    /**
     * Set firstname
     *
     * @param string $firstname
     *
     * @return User
     */
    public function setFirstname($firstname)
    {
        $this->firstname = $firstname;

        return $this;
    }

    /**
     * Get firstname
     *
     * @return string
     */
    public function getFirstname()
    {
        return $this->firstname;
    }

    /**
     * Set lastname
     *
     * @param string $lastname
     *
     * @return User
     */
    public function setLastname($lastname)
    {
        $this->lastname = $lastname;

        return $this;
    }

    /**
     * Get lastname
     *
     * @return string
     */
    public function getLastname()
    {
        return $this->lastname;
    }

    /**
     * Set mi
     *
     * @param string $mi
     *
     * @return User
     */
    public function setMi($mi)
    {
        $this->mi = $mi;

        return $this;
    }

    /**
     * Get mi
     *
     * @return string
     */
    public function getMi()
    {
        return $this->mi;
    }

    /**
     * Set housenumber
     *
     * @param integer $housenumber
     *
     * @return User
     */
    public function setHousenumber($housenumber)
    {
        $this->housenumber = $housenumber;

        return $this;
    }

    /**
     * Get housenumber
     *
     * @return integer
     */
    public function getHousenumber()
    {
        return $this->housenumber;
    }

    /**
     * Set street
     *
     * @param string $street
     *
     * @return User
     */
    public function setStreet($street)
    {
        $this->street = $street;

        return $this;
    }

    /**
     * Get street
     *
     * @return string
     */
    public function getStreet()
    {
        return $this->street;
    }

    /**
     * Set bday
     *
     * @param \DateTime $bday
     *
     * @return User
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
     * @return User
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
     * @return User
     */
    public function setMaritalStatus($maritalStatus)
    {
        $this->marital_status = $maritalStatus;

        return $this;
    }

    /**
     * Get maritalStatus
     *
     * @return string
     */
    public function getMaritalStatus()
    {
        return $this->marital_status;
    }

    /**
     * Set cellphone
     *
     * @param string $cellphone
     *
     * @return User
     */
    public function setCellphone($cellphone)
    {
        $this->cellphone = $cellphone;

        return $this;
    }

    /**
     * Get cellphone
     *
     * @return string
     */
    public function getCellphone()
    {
        return $this->cellphone;
    }

    /**
     * Set homephone
     *
     * @param string $homephone
     *
     * @return User
     */
    public function setHomephone($homephone)
    {
        $this->homephone = $homephone;

        return $this;
    }

    /**
     * Get homephone
     *
     * @return string
     */
    public function getHomephone()
    {
        return $this->homephone;
    }

    /**
     * Set honorific
     *
     * @param string $honorific
     *
     * @return User
     */
    public function setHonorific($honorific)
    {
        $this->honorific = $honorific;

        return $this;
    }

    /**
     * Get honorific
     *
     * @return string
     */
    public function getHonorific()
    {
        return $this->honorific;
    }

    /**
     * Set occupation
     *
     * @param string $occupation
     *
     * @return User
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
     * Set occupyDate
     *
     * @param \DateTime $occupyDate
     *
     * @return User
     */
    public function setOccupyDate($occupyDate)
    {
        $this->occupy_date = $occupyDate;

        return $this;
    }

    /**
     * Get occupyDate
     *
     * @return \DateTime
     */
    public function getOccupyDate()
    {
        return $this->occupy_date;
    }

    /**
     * Set vacateDate
     *
     * @param \DateTime $vacateDate
     *
     * @return User
     */
    public function setVacateDate($vacateDate)
    {
        $this->vacate_date = $vacateDate;

        return $this;
    }

    /**
     * Get vacateDate
     *
     * @return \DateTime
     */
    public function getVacateDate()
    {
        return $this->vacate_date;
    }

    /**
     * Set isTrustee
     *
     * @param boolean $isTrustee
     *
     * @return User
     */
    public function setIsTrustee($isTrustee)
    {
        $this->is_trustee = $isTrustee;

        return $this;
    }

    /**
     * Get isTrustee
     *
     * @return boolean
     */
    public function getIsTrustee()
    {
        return $this->is_trustee;
    }

    /**
     * Add photo
     *
     * @param \AppBundle\Entity\Photos $photo
     *
     * @return User
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
     * Add vehicle
     *
     * @param \AppBundle\Entity\Vehicles $vehicle
     *
     * @return User
     */
    public function addVehicle(\AppBundle\Entity\Vehicles $vehicle)
    {
        $this->vehicles[] = $vehicle;

        return $this;
    }

    /**
     * Remove vehicle
     *
     * @param \AppBundle\Entity\Vehicles $vehicle
     */
    public function removeVehicle(\AppBundle\Entity\Vehicles $vehicle)
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
     * Add term
     *
     * @param \AppBundle\Entity\Term $term
     *
     * @return User
     */
    public function addTerm(\AppBundle\Entity\Term $term)
    {
        $this->term[] = $term;

        return $this;
    }

    /**
     * Remove term
     *
     * @param \AppBundle\Entity\Term $term
     */
    public function removeTerm(\AppBundle\Entity\Term $term)
    {
        $this->term->removeElement($term);
    }

    /**
     * Get term
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getTerm()
    {
        return $this->term;
    }

    /**
     * Set account
     *
     * @param \AppBundle\Entity\Account $account
     *
     * @return User
     */
    public function setAccount(\AppBundle\Entity\Account $account = null)
    {
        $this->account = $account;

        return $this;
    }

    /**
     * Get account
     *
     * @return \AppBundle\Entity\Account
     */
    public function getAccount()
    {
        return $this->account;
    }

    /**
     * Set employer
     *
     * @param string $employer
     *
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * @return User
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
     * Set bioPublic
     *
     * @param boolean $bioPublic
     *
     * @return User
     */
    public function setBioPublic($bioPublic)
    {
        $this->bio_public = $bioPublic;

        return $this;
    }

    /**
     * Get bioPublic
     *
     * @return boolean
     */
    public function getBioPublic()
    {
        return $this->bio_public;
    }

    /**
     * Set bioProtected
     *
     * @param boolean $bioProtected
     *
     * @return User
     */
    public function setBioProtected($bioProtected)
    {
        $this->bio_protected = $bioProtected;

        return $this;
    }

    /**
     * Get bioProtected
     *
     * @return boolean
     */
    public function getBioProtected()
    {
        return $this->bio_protected;
    }

    /**
     * Set bdayPublic
     *
     * @param boolean $bdayPublic
     *
     * @return User
     */
    public function setBdayPublic($bdayPublic)
    {
        $this->bday_public = $bdayPublic;

        return $this;
    }

    /**
     * Get bdayPublic
     *
     * @return boolean
     */
    public function getBdayPublic()
    {
        return $this->bday_public;
    }

    /**
     * Set bdayProtected
     *
     * @param boolean $bdayProtected
     *
     * @return User
     */
    public function setBdayProtected($bdayProtected)
    {
        $this->bday_protected = $bdayProtected;

        return $this;
    }

    /**
     * Get bdayProtected
     *
     * @return boolean
     */
    public function getBdayProtected()
    {
        return $this->bday_protected;
    }

    /**
     * Set maritalstatusPublic
     *
     * @param boolean $maritalstatusPublic
     *
     * @return User
     */
    public function setMaritalstatusPublic($maritalstatusPublic)
    {
        $this->maritalstatus_public = $maritalstatusPublic;

        return $this;
    }

    /**
     * Get maritalstatusPublic
     *
     * @return boolean
     */
    public function getMaritalstatusPublic()
    {
        return $this->maritalstatus_public;
    }

    /**
     * Set maritalstatusProtected
     *
     * @param boolean $maritalstatusProtected
     *
     * @return User
     */
    public function setMaritalstatusProtected($maritalstatusProtected)
    {
        $this->maritalstatus_protected = $maritalstatusProtected;

        return $this;
    }

    /**
     * Get maritalstatusProtected
     *
     * @return boolean
     */
    public function getMaritalstatusProtected()
    {
        return $this->maritalstatus_protected;
    }

    /**
     * Set homephonePublic
     *
     * @param boolean $homephonePublic
     *
     * @return User
     */
    public function setHomephonePublic($homephonePublic)
    {
        $this->homephone_public = $homephonePublic;

        return $this;
    }

    /**
     * Get homephonePublic
     *
     * @return boolean
     */
    public function getHomephonePublic()
    {
        return $this->homephone_public;
    }

    /**
     * Set homephoneProtected
     *
     * @param boolean $homephoneProtected
     *
     * @return User
     */
    public function setHomephoneProtected($homephoneProtected)
    {
        $this->homephone_protected = $homephoneProtected;

        return $this;
    }

    /**
     * Get homephoneProtected
     *
     * @return boolean
     */
    public function getHomephoneProtected()
    {
        return $this->homephone_protected;
    }

    /**
     * Set cellphonePublic
     *
     * @param boolean $cellphonePublic
     *
     * @return User
     */
    public function setCellphonePublic($cellphonePublic)
    {
        $this->cellphone_public = $cellphonePublic;

        return $this;
    }

    /**
     * Get cellphonePublic
     *
     * @return boolean
     */
    public function getCellphonePublic()
    {
        return $this->cellphone_public;
    }

    /**
     * Set cellphoneProtected
     *
     * @param boolean $cellphoneProtected
     *
     * @return User
     */
    public function setCellphoneProtected($cellphoneProtected)
    {
        $this->cellphone_protected = $cellphoneProtected;

        return $this;
    }

    /**
     * Get cellphoneProtected
     *
     * @return boolean
     */
    public function getCellphoneProtected()
    {
        return $this->cellphone_protected;
    }

    /**
     * Set occupationPublic
     *
     * @param boolean $occupationPublic
     *
     * @return User
     */
    public function setOccupationPublic($occupationPublic)
    {
        $this->occupation_public = $occupationPublic;

        return $this;
    }

    /**
     * Get occupationPublic
     *
     * @return boolean
     */
    public function getOccupationPublic()
    {
        return $this->occupation_public;
    }

    /**
     * Set occupationProtected
     *
     * @param boolean $occupationProtected
     *
     * @return User
     */
    public function setOccupationProtected($occupationProtected)
    {
        $this->occupation_protected = $occupationProtected;

        return $this;
    }

    /**
     * Get occupationProtected
     *
     * @return boolean
     */
    public function getOccupationProtected()
    {
        return $this->occupation_protected;
    }

    /**
     * Set agePublic
     *
     * @param boolean $agePublic
     *
     * @return User
     */
    public function setAgePublic($agePublic)
    {
        $this->age_public = $agePublic;

        return $this;
    }

    /**
     * Get agePublic
     *
     * @return boolean
     */
    public function getAgePublic()
    {
        return $this->age_public;
    }

    /**
     * Set ageProtected
     *
     * @param boolean $ageProtected
     *
     * @return User
     */
    public function setAgeProtected($ageProtected)
    {
        $this->age_protected = $ageProtected;

        return $this;
    }

    /**
     * Get ageProtected
     *
     * @return boolean
     */
    public function getAgeProtected()
    {
        return $this->age_protected;
    }

    /**
     * Set emailPublic
     *
     * @param boolean $emailPublic
     *
     * @return User
     */
    public function setEmailPublic($emailPublic)
    {
        $this->email_public = $emailPublic;

        return $this;
    }

    /**
     * Get emailPublic
     *
     * @return boolean
     */
    public function getEmailPublic()
    {
        return $this->email_public;
    }

    /**
     * Set emailProtected
     *
     * @param boolean $emailProtected
     *
     * @return User
     */
    public function setEmailProtected($emailProtected)
    {
        $this->email_protected = $emailProtected;

        return $this;
    }

    /**
     * Get emailProtected
     *
     * @return boolean
     */
    public function getEmailProtected()
    {
        return $this->email_protected;
    }

    /**
     * Set facebookPublic
     *
     * @param boolean $facebookPublic
     *
     * @return User
     */
    public function setFacebookPublic($facebookPublic)
    {
        $this->facebook_public = $facebookPublic;

        return $this;
    }

    /**
     * Get facebookPublic
     *
     * @return boolean
     */
    public function getFacebookPublic()
    {
        return $this->facebook_public;
    }

    /**
     * Set facebookProtected
     *
     * @param boolean $facebookProtected
     *
     * @return User
     */
    public function setFacebookProtected($facebookProtected)
    {
        $this->facebook_protected = $facebookProtected;

        return $this;
    }

    /**
     * Get facebookProtected
     *
     * @return boolean
     */
    public function getFacebookProtected()
    {
        return $this->facebook_protected;
    }

    /**
     * Set twitterPublic
     *
     * @param boolean $twitterPublic
     *
     * @return User
     */
    public function setTwitterPublic($twitterPublic)
    {
        $this->twitter_public = $twitterPublic;

        return $this;
    }

    /**
     * Get twitterPublic
     *
     * @return boolean
     */
    public function getTwitterPublic()
    {
        return $this->twitter_public;
    }

    /**
     * Set twitterProtected
     *
     * @param boolean $twitterProtected
     *
     * @return User
     */
    public function setTwitterProtected($twitterProtected)
    {
        $this->twitter_protected = $twitterProtected;

        return $this;
    }

    /**
     * Get twitterProtected
     *
     * @return boolean
     */
    public function getTwitterProtected()
    {
        return $this->twitter_protected;
    }

    /**
     * Set googlePublic
     *
     * @param boolean $googlePublic
     *
     * @return User
     */
    public function setGooglePublic($googlePublic)
    {
        $this->google_public = $googlePublic;

        return $this;
    }

    /**
     * Get googlePublic
     *
     * @return boolean
     */
    public function getGooglePublic()
    {
        return $this->google_public;
    }

    /**
     * Set googleProtected
     *
     * @param boolean $googleProtected
     *
     * @return User
     */
    public function setGoogleProtected($googleProtected)
    {
        $this->google_protected = $googleProtected;

        return $this;
    }

    /**
     * Get googleProtected
     *
     * @return boolean
     */
    public function getGoogleProtected()
    {
        return $this->google_protected;
    }

    /**
     * Set linkedInPublic
     *
     * @param boolean $linkedInPublic
     *
     * @return User
     */
    public function setLinkedInPublic($linkedInPublic)
    {
        $this->linkedIn_public = $linkedInPublic;

        return $this;
    }

    /**
     * Get linkedInPublic
     *
     * @return boolean
     */
    public function getLinkedInPublic()
    {
        return $this->linkedIn_public;
    }

    /**
     * Set linkedInProtected
     *
     * @param boolean $linkedInProtected
     *
     * @return User
     */
    public function setLinkedInProtected($linkedInProtected)
    {
        $this->linkedIn_protected = $linkedInProtected;

        return $this;
    }

    /**
     * Get linkedInProtected
     *
     * @return boolean
     */
    public function getLinkedInProtected()
    {
        return $this->linkedIn_protected;
    }

    /**
     * Add complaint
     *
     * @param \AppBundle\Entity\Complaint $complaint
     *
     * @return User
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
     * Set profile
     *
     * @param \AppBundle\Entity\Profile $profile
     *
     * @return User
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
     * Set primaryHouseholdContact
     *
     * @param boolean $primaryHouseholdContact
     *
     * @return User
     */
    public function setPrimaryHouseholdContact($primaryHouseholdContact)
    {
        $this->primaryHouseholdContact = $primaryHouseholdContact;

        return $this;
    }

    /**
     * Get primaryHouseholdContact
     *
     * @return boolean
     */
    public function getPrimaryHouseholdContact()
    {
        return $this->primaryHouseholdContact;
    }

    /**
     * Set lienHolder
     *
     * @param \AppBundle\Entity\User $lienHolder
     *
     * @return User
     */
    public function setLienHolder(\AppBundle\Entity\User $lienHolder = null)
    {
        $this->lienHolder = $lienHolder;

        return $this;
    }

    /**
     * Get lienHolder
     *
     * @return \AppBundle\Entity\User
     */
    public function getLienHolder()
    {
        return $this->lienHolder;
    }

    /**
     * Set contact
     *
     * @param \AppBundle\Entity\Contact $contact
     *
     * @return User
     */
    public function setContact(\AppBundle\Entity\Contact $contact = null)
    {
        $this->contact = $contact;

        return $this;
    }

    /**
     * Get contact
     *
     * @return \AppBundle\Entity\Contact
     */
    public function getContact()
    {
        return $this->contact;
    }

    /**
     * Add property
     *
     * @param \AppBundle\Entity\Property $properties
     *
     * @return User
     */
    public function addProperties(\AppBundle\Entity\Property $properties)
    {
        $this->properties[] = $properties;

        return $this;
    }

    /**
     * Remove property
     *
     * @param \AppBundle\Entity\Property $properties
     */
    public function removeProperties(\AppBundle\Entity\Property $properties)
    {
        $this->properties->removeElement($properties);
    }

    /**
     * Get property
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getProperties()
    {
        return $this->properties;
    }

    /**
     * Add property
     *
     * @param \AppBundle\Entity\Property $property
     *
     * @return User
     */
    public function addProperty(\AppBundle\Entity\Property $property)
    {
        $this->properties[] = $property;

        return $this;
    }

    /**
     * Remove property
     *
     * @param \AppBundle\Entity\Property $property
     */
    public function removeProperty(\AppBundle\Entity\Property $property)
    {
        $this->properties->removeElement($property);
    }

    /**
     * Add pet
     *
     * @param \AppBundle\Entity\Pets $pet
     *
     * @return User
     */
    public function addPet(\AppBundle\Entity\Pets $pet)
    {
        $this->pets[] = $pet;

        return $this;
    }

    /**
     * Remove pet
     *
     * @param \AppBundle\Entity\Pets $pet
     */
    public function removePet(\AppBundle\Entity\Pets $pet)
    {
        $this->pets->removeElement($pet);
    }

    /**
     * Get pets
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getPets()
    {
        return $this->pets;
    }

    /**
     * Add dependent
     *
     * @param \AppBundle\Entity\Dependents $dependent
     *
     * @return User
     */
    public function addDependent(\AppBundle\Entity\Dependents $dependent)
    {
        $this->dependents[] = $dependent;

        return $this;
    }

    /**
     * Remove dependent
     *
     * @param \AppBundle\Entity\Dependents $dependent
     */
    public function removeDependent(\AppBundle\Entity\Dependents $dependent)
    {
        $this->dependents->removeElement($dependent);
    }

    /**
     * Get dependents
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getDependents()
    {
        return $this->dependents;
    }
}
