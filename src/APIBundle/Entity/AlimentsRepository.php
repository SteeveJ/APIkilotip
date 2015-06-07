<?php

namespace APIBundle\Entity;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\EntityRepository;
use Doctrine\ORM\Query\Expr as Expr;

/**
 * AlimentsRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class AlimentsRepository extends EntityRepository
{
    public function findCatchThemAll($id = null)
    {
        $qb = $this->createQueryBuilder('a');

        $qb->select('a, uM')
        ->leftJoin('a.uniteMesure','uM', Expr\Join::WITH);

        if($id != null){
            $qb->where('a.id = :id')
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
