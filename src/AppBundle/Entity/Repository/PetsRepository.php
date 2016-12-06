<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

class PetsRepository extends EntityRepository
{    
    public function getUsersPets($user){
        //get all of the user's pets, sorted by name:
        
        $pets = $user->getPets();
        
        $newerCriteria = Criteria::create()
                            ->orderBy(Array(
                                'Name' => Criteria::ASC
                ));
        
        return $pets->matching($newerCriteria);
    }
    
    public function getPetsCollectionByIds($petIds){
        
        if($petIds != null){
            $qb = $this->createQueryBuilder('p')->select('p');
            $qb ->where('p.id is not null')
                ->andWhere($qb->expr()->in('p.id', $petIds));        
            return $qb->getQuery()->getResult();
        }else {return null;}
    }
    
    public function getUniquePets($collectionOfUsers){
        
        $pets = array();
        foreach($collectionOfUsers as $user){
            foreach($user->getPets() as $pet){
                $pets[$pet->getId()] = $pet->getType().$pet->getName();
            }
        }
        
        $pets = array_unique($pets);
        
        //create an array of the pet's ids
        $petIds = array();
        foreach($pets as $k => $v){
            $petIds[] = $k;
        }
        //retreive a collection of pets by their ids in an array:
        return $this->getPetsCollectionByIds($petIds);
        
    }
    
}
