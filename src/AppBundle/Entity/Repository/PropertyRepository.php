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
    
    public function getPropertiesByStreet($street, $type){
        /*
         * 
         * We can retrieve users by property, but not vise versa... which necessitates this function.  Be sure to include:
         *      - include vacant houses
         *      - sort by house number
         * It is not needed to join the table with users in order to get the current homeowners.  ONLY current homeowners can be assigned to a property by ADMIN EDIT PROPERTY  
         */
        
        $qb = $this->createQueryBuilder('p')
                   ->select('p')
                   ->where('p.street = :street')
                   ->andWhere('p.type = :type')
                   ->setParameter('street', $street)
                   ->setParameter('type', $type)
                   ->addOrderBy('p.house_number', 'ASC');
        
        return $qb->getQuery()
                  ->getResult();
        
    }
    
}
