<?php

namespace AppBundle\Entity\Repository;

/**
 * GoalRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class GoalRepository extends \Doctrine\ORM\EntityRepository
{
    public function getTopGoals($limit = null){
        $qb = $this->createQueryBuilder('g')->select('g')->orderBy('g.percentComplete', 'DESC');
        if($limit != null){
            $qb->setMaxResults( $limit );
        }
        return $qb->getQuery()->getResult();
    }
}
