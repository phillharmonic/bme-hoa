<?php

namespace AppBundle\Entity\Repository;

/**
 * TermRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class TermRepository extends \Doctrine\ORM\EntityRepository
{
    public function getCurrentBoard(){
//        $qb = $this->createQueryBuilder('t')
//                   ->select('t')
//                   ->where('t.house_number = :housenumber')
//                   ->andWhere('p.street = :street')
//                   ->setParameter('housenumber', $userHousenumber)
//                   ->setParameter('street', $userStreet);
//        
//        return $qb->getQuery()
//                  ->getResult();
    }
}