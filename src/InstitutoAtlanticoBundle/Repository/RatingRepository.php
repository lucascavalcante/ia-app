<?php

namespace InstitutoAtlanticoBundle\Repository;

/**
 * RatingRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class RatingRepository extends \Doctrine\ORM\EntityRepository
{
    public function ratingsGroupedByUser()
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('r.user')
            ->from('InstitutoAtlanticoBundle:Rating', 'r')
            ->groupBy('r.user');

        $results = $query->getQuery()->getResult();

        return $results;
    }

    public function ratingsGroupedByMovie()
    {
        $query = $this->getEntityManager()->createQueryBuilder()
            ->select('r.movie')
            ->from('InstitutoAtlanticoBundle:Rating', 'r')
            ->groupBy('r.movie');

        $results = $query->getQuery()->getResult();

        return $results;
    }
}
