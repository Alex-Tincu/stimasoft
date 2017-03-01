<?php

namespace AppBundle\Repository;

/**
 * ResourceRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ResourceRepository extends \Doctrine\ORM\EntityRepository
{
    public function getAll()
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT r FROM AppBundle:Resource r'
            )->getResult();
    }

    public function getUserResources($user)
    {
        return $this->getEntityManager()
            ->createQuery('
                    SELECT r
                    FROM AppBundle:Resource r
                    WHERE r.user = :user
                    ORDER BY r.url asc'
            )->setParameter('user', $user)
            ->getResult();
    }
}