<?php

namespace AppBundle\Repository;

/**
 * PresentationRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PresentationRepository extends \Doctrine\ORM\EntityRepository
{
  /**
    * Requête de recherche du menu de la rubrique presentation
    *
    * Author: Delrodie AMOIKON
    * Date: 09/02/2017
    * Since: v1.0
    */
    public function getMenu()
    {
        $em = $this->getEntityManager();
        $qb = $em->createQuery('
            SELECT p
            FROM AppBundle:Presentation p
            WHERE p.statut = :stat
        ')
          ->setParameter('stat', 1)
        ;
        try {
            $result = $qb->getResult();

            return $result;

        } catch (NoResultException $e) {
            return $e;
        }

    }

    /**
    * Recherche de l'article de la rubrique presentation
    *
    * Author: Delrodie AMOIKON
    * Date: 09/02/2017
    * Since: v1.0
    */
    public function getArticle($slug)
    {
        $em = $this->getEntityManager();
        $qb = $em->createQuery('
            SELECT p
            FROM AppBundle:Presentation p
            WHERE p.slug LIKE :slug
            AND p.statut = :stat
        ')
          ->setParameter('slug', '%'.$slug.'%')
          ->setParameter('stat', 1)
        ;
        try {
            $result = $qb->getResult();

            return $result;

        } catch (NoResultException $e) {
            return $e;
        }
    }
}