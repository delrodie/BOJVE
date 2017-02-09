<?php

namespace AppBundle\Repository;

use Doctrine\ORM\QueryBuilder;
use Doctrine\ORM\NoResultException;

/**
 * ProjetRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class ProjetRepository extends \Doctrine\ORM\EntityRepository
{
  /**
   * Calcule du nombre de projets enregistrés
   *
   * Author: Delrodie AMOIKON
   * Date: 09/12/2017
   */
   public function getNombreProjet()
   {
       $qb = $this->createQueryBuilder('p')
           ->select('count(p.id)')
       ;

       $query = $qb->getQuery();

       $recup =  $query->getSingleScalarResult();

       // Si compteur est egal a 0 alors initialiser
       if ($recup < 10){
           $suffixe = $recup ;
           return $code = '00'.$suffixe;
       }
       elseif ($recup < 100) {
         $suffixe = $recup ;
         return $code = '0'.$suffixe;
       }
       else{
           return $code = $recup;
       }
   }

   /**
     * Les projets actifs
     *
     * Author: Delrodie AMOIKON
     * Date: 09/02/2017
     * Since: v1.0
     */
     public function getProjet($offset, $limit)
     {
         $em = $this->getEntityManager();
         $qb = $em->createQuery('
             SELECT p
             FROM AppBundle:Projet p
             WHERE p.statut = :stat
             ORDER BY p.datedeb DESC
         ')
           ->setParameter('stat', 1)
           ->setFirstResult($offset)
           ->setMaxResults($limit)
         ;
         try {
             $result = $qb->getResult();

             return $result;

         } catch (NoResultException $e) {
             return $e;
         }
     }
}
