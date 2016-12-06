<?php

namespace AppBundle\Entity\Repository;

use Doctrine\ORM\EntityRepository;
use Doctrine\Common\Collections\ArrayCollection;

class UserRepository extends EntityRepository
{    
    
    //override the default findAll method and add sort:
    public function findAll()
    {
        return $this->findBy(array(), array('lastname' => 'ASC'));
    }
    
    public function getUnassignedUsers(){
        //This is only partially correct.  
        //Need to join with the property table and check if a property has been assigned too
       $qb = $this->createQueryBuilder('u')
                   ->select('u')
                   ->where('u.account is null');
        
        return $qb->getQuery()
                  ->getResult();
    }
    
    public function getAllCurrentHomeowners(){
        $qb = $this->createQueryBuilder('u')
                   ->select('u')
                   ->where('u.id is not null')
                   ->andWhere('u.account is not null')
                   ->andWhere('u.vacate_date = 00-00-0000 OR u.vacate_date is null')
                    ->orderBy('u.lastname', 'ASC');
        
        return $qb->getQuery()
                  ->getResult();
    }
    
    public function getAllFormerHomeowners(){
        $qb = $this->createQueryBuilder('u')
                   ->select('u')
                   ->where('u.id is not null')
                   ->andWhere('u.vacate_date != 00-00-0000');
        
        return $qb->getQuery()
                  ->getResult();
    }
    
    public function getAdminUsers(){
        $roles = array();
        $roles[] = 'ROLE_SUPER_ADMIN';
        $roles[] = 'ROLE_ADMIN';
        $roles[] = 'ROLE_TRUSTEE';
        $roles[] = 'ROLE_MODERATOR'; 
        
        $ar = new ArrayCollection();
        
        foreach($roles as $role){
            $qb = $this->createQueryBuilder('u');
            $qb ->select('u')
                ->where('u.roles LIKE :roles')
                ->setParameter('roles', '%"'.$role.'"%');
            $result = $qb->getQuery()->getResult();
            if($result != null){$ar[] = $result;}            
        }
        
        return $ar;
    
    }
    
    public function getCurrentUsersByAddress($housenumber, $street){
        $qb = $this->createQueryBuilder('u')
                   ->select('u')
                   ->where('u.housenumber = :housenumber')
                   ->andWhere('u.street = :street')
                   ->andWhere('u.vacate_date = 00-00-00000 OR u.vacate_date is null')
                   ->setParameter('housenumber', $housenumber)
                   ->setParameter('street', $street);
        
        return $qb->getQuery()
                  ->getResult();
    }
    
    public function getPastUsersByAddress($housenumber, $street){
        $qb = $this->createQueryBuilder('u')
                   ->select('u')
                   ->where('u.housenumber = :housenumber')
                   ->andWhere('u.street = :street')
                   ->andWhere('u.vacate_date is > 00-00-0000')
                   ->setParameter('housenumber', $housenumber)
                   ->setParameter('street', $street);
        
        return $qb->getQuery()
                  ->getResult();
    }
    
}
