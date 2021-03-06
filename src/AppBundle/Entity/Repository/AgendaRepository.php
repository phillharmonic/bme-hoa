<?php

namespace AppBundle\Entity\Repository;

/**
 * AgendaRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AgendaRepository extends \Doctrine\ORM\EntityRepository
{
    public function getIdOfLast() {
        $query = $this->createQueryBuilder('a')
                ->select('a')
                ->orderBy('a.year', 'DESC')
                ->setMaxResults(1);
        
        return $query->getQuery()->getSingleResult();
    }
}
