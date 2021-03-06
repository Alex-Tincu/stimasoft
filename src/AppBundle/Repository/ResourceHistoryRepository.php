<?php

namespace AppBundle\Repository;

/**
 * ResourceHistoryRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ResourceHistoryRepository extends \Doctrine\ORM\EntityRepository
{
    public function getLastValue($resource)
    {
        return $this->getEntityManager()
            ->createQuery('
                    SELECT h
                    FROM AppBundle:ResourceHistory h
                    WHERE h.resource = :resource
                    ORDER BY h.date desc'
            )->setParameter('resource', $resource)
            ->setMaxResults(1)
            ->getOneOrNullResult();
    }

    public function getHistory($resource)
    {
        return $this->getEntityManager()
            ->createQuery('
                    SELECT h
                    FROM AppBundle:ResourceHistory h
                    WHERE h.resource = :resource
                    ORDER BY h.date desc'
            )->setParameter('resource', $resource)
            ->getResult();
    }

}
