<?php

namespace AppBundle\Entity\Repository;
use Doctrine\ORM\EntityRepository;

class CommentRepository extends EntityRepository
{
    
    public function getCommentsForBlog($blogId, $approved = true)
    {
        $qb = $this->createQueryBuilder('c')
                   ->select('c')
                   ->where('c.blog = :blog_id')
                   ->addOrderBy('c.created')
                   ->setParameter('blog_id', $blogId);

        if (false === is_null($approved)){
            $qb->andWhere('c.approved = :approved')
               ->setParameter('approved', $approved);
        }
        return $qb->getQuery();
//                  ->getResult();
    }
    
}
