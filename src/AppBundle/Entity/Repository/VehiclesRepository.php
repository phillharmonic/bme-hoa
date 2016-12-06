<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\Criteria;
use Doctrine\Common\Collections\ArrayCollection;

class VehiclesRepository extends EntityRepository
{    
    public function getUsersVehicles($user){
        //get all of the user's vehicles, sorted by year:
        
        $vehicles = $user->getVehicles();
        
        $newerCriteria = Criteria::create()
                            ->orderBy(Array(
                                'Year' => Criteria::ASC
                ));
        
        return $vehicles->matching($newerCriteria);
    }
    
    public function getVehiclesCollectionByIds($vhclsIds){
        if($vhclsIds != null){
            $qb = $this->createQueryBuilder('v')->select('v');
            $qb ->where('v.id is not null')
                ->andWhere($qb->expr()->in('v.id', $vhclsIds));        
            return $qb->getQuery()->getResult();
        }else {return null;}
    }
    
    public function getUniqueVehicles($collectionOfUsers){
        $vhcls = array();
        foreach($collectionOfUsers as $user){
            foreach($user->getVehicles() as $vhcl){
                $vhcls[$vhcl->getId()] = $vhcl->getYear().$vhcl->getMake().$vhcl->getModel();
            }
        }
        
        $vhcls = array_unique($vhcls);
        //create an array of the vehicles's ids
        $vhclsIds = array();
        foreach($vhcls as $k => $v){
            $vhclsIds[] = $k;
        }
        //retreive a collection of vehicles by their ids in an array:
        return $this->getVehiclesCollectionByIds($vhclsIds);
        
    }
    
}
