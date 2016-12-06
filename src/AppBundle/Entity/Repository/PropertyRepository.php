<?php

namespace AppBundle\Entity\Repository;
use Doctrine\ORM\EntityRepository;

class PropertyRepository extends EntityRepository
{    
    public function getDisplayName(){
        return $this->getHouseNumber().' '.$this->getStreet();        
    }
    
    public function getUsersProperty($user){
        $userStreet = $user->getStreet();
        $userHousenumber = $user->getHousenumber();
        
        $qb = $this->createQueryBuilder('p')
                   ->select('p')
                   ->where('p.house_number = :housenumber')
                   ->andWhere('p.street = :street')
                   ->setParameter('housenumber', $userHousenumber)
                   ->setParameter('street', $userStreet);
        
        return $qb->getQuery()
                  ->getResult();
        
    }
}
