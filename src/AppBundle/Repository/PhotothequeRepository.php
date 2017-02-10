<?php

namespace AppBundle\Repository;

/**
 * PhotothequeRepository
 *
 * This class was generated by the Doctrine ORM. Add your own custom
 * repository methods below.
 */
class PhotothequeRepository extends \Doctrine\ORM\EntityRepository
{
  /**
   * Calcule du nombre d'albums enregistrés'
   *
   * Author: Delrodie AMOIKON
   * Date: 09/12/2017
   */
   public function getNombreAlbums()
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
     * Les publications internes actives
     *
     * Author: Delrodie AMOIKON
     * Date: 09/02/2017
     * Since: v1.0
     */
     public function getPhoto($offset, $limit)
     {
         $em = $this->getEntityManager();
         $qb = $em->createQuery('
             SELECT p
             FROM AppBundle:Phototheque p
             WHERE p.statut = :stat
             ORDER BY p.id DESC
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

     /**
     * Recherche de l'article de la rubrique Phototheques
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
             FROM AppBundle:Phototheque p
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