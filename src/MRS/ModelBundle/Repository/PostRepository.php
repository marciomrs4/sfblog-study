<?php
/**
 * Created by PhpStorm.
 * User: marcio
 * Date: 9/22/15
 * Time: 4:22 PM
 */

namespace MRS\ModelBundle\Repository;

use Doctrine\ORM\EntityRepository;

class PostRepository extends EntityRepository
{

    private function getQueryBuilder()
    {
        $em = $this->getEntityManager();

        $queryBuilder = $em->getRepository('MRSModelBundle:Post')
                           ->createQueryBuilder('p');

        return $queryBuilder;

    }


    public function findAllInOrder()
    {
        $qb = $this->getQueryBuilder()->orderBy('p.createdAt','DESC');

        return $qb->getQuery()->getResult();
    }

}