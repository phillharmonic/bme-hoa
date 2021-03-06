<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

class DependentsRepository extends EntityRepository
{    
    public function getUsersDependents($user){
        //get all of the user's dependents, minus the spouse:
        
        $dependents = $user->getDependents();
        
        $newerCriteria = Criteria::create()
                            ->where(Criteria::expr()->gt("spouse", false));
        
        return $dependents->matching($newerCriteria);
    }
    
    public function getUsersSpouse($user){
        //get all of the user's dependents, minus the spouse:
        
        is_null($user->getDependents()) 
            ? $spouse = null 
            : $spouse = $user->getDependents();
        
        if(!is_null($spouse) ){
            $newerCriteria = Criteria::create()
                                ->where(Criteria::expr()->gt("spouse", true));

            return $spouse->matching($newerCriteria);
        }
        else {
            return null;
        }
    }
    
    public function getDepsCollectionByIds($depIds){
        if($depIds != null){
            $qb = $this->createQueryBuilder('d')->select('d');
            $qb ->where('d.spouse = false')
                ->andWhere($qb->expr()->in('d.id', $depIds)); 
            return $qb->getQuery()->getResult();
        }else{return null;}
    }
    
    public function getUniqueDependents($collectionOfUsers){
        $dependents = array();
        foreach($collectionOfUsers as $user){
            foreach($user->getDependents() as $dependent){
                $dependents[$dependent->getId()] = $dependent->getFirstname().$dependent->getLastname();
            }
        }
        
        $dependents = array_unique($dependents);
        
        $depIds = array();
            foreach($dependents as $k => $v){
                $depIds[] = $k;
            }
        
        return $this->getDepsCollectionByIds($depIds);        
    }
    
    public function removeDupes($depsCollection){
        //since multiple users of the same household can have an account and create their own instance of a pet, we have
        //to remove duplicate pets not by ID (bc they will be differnt), but by name.  
        
        $deps = array();
        foreach($depsCollection as $dep){
            $deps[$dep->getId()] = $dep->getFirstname();
        }
        $deps = array_unique($deps);
        
        //create an array of the pet's ids
        $depsIds = array();
        foreach($deps as $k => $v){
            $depsIds[] = $k;
        }
        //retreive a collection of pets by their ids in an array:
        return $this->getDepsCollectionByIds($depsIds);
        
    }
    
}
