<?php

namespace AppBundle\Entity\Repository;

/**
 * ImprovementsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ImprovementsRepository extends \Doctrine\ORM\EntityRepository
{
    public function getExteriorImprovements($property){
        $qb = $this->createQueryBuilder('i')
                   ->select('i')
                   ->where('i.property = :property')
                   ->andWhere('i.type = :type')
                   ->setParameter('property', $property)
                    ->setParameter('type', 'Exterior');

        return $qb->getQuery()->getResult();
    }
    
    public function getInteriorImprovements($property){
        $qb = $this->createQueryBuilder('i')
                   ->select('i')
                   ->where('i.property = :property')
                   ->andWhere('i.type = :type')
                   ->setParameter('property', $property)
                    ->setParameter('type', 'Interior');

        return $qb->getQuery()->getResult();
    }
}
