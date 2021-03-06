<?php

namespace APIBundle\Entity;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;

/**
 * UserRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class UserRepository extends EntityRepository
{
    public function findCatchThemAll($id = null)
    {
        $qb = $this->createQueryBuilder('u');

        $qb->select('u');

        if($id != null){
            $qb->where('u.id = :id')
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
