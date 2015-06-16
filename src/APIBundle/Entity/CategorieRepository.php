<?php

namespace APIBundle\Entity;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;

/**
 * CategorieRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class CategorieRepository extends EntityRepository
{
    public function findCatchThemAll($id = null)
    {
        $qb = $this->createQueryBuilder('c');

        $qb->select('c');

        if($id != null){
            $qb->where('c.id = :id')
                ->setParameters([
                    ':id' => $id,
                ])
            ;
        }

        return null === $id
            ? $qb->getQuery()->getArrayResult()
            : $qb->getQuery()->getSingleResult(AbstractQuery::HYDRATE_ARRAY);

    }
}
