<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class FoController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $sliders = $em->getRepository('AppBundle:Slider')->getSlider();

        $projets = $em->getRepository('AppBundle:Projet')->getProjet(0, 4);

        $partenaires = $em->getRepository('AppBundle:Partenaire')->getPartenaire();

        $astuces = $em->getRepository('AppBundle:Astuce')->getAstuce(0, 1);

        return $this->render('fr/index.html.twig', array(
            'sliders' => $sliders,
            'projets' => $projets,
            'astuces' => $astuces,
            'partenaires' => $partenaires,
        ));
    }

    /**
    * Recherche des articles actifs de l'entité presentation.
    *
    */
   public function presentationAction($slug)
   {
       $em = $this->getDoctrine()->getManager();

       $presentations = $em->getRepository('AppBundle:Presentation')->getArticle($slug);

       return $this->render('fr/presentation.html.twig', array(
           'presentations' => $presentations,
       ));
   }

   /**
   * Recherche des articles actifs de l'entité presentation.
   *
   */
    public function astuceAction($slug)
    {
        $em = $this->getDoctrine()->getManager();

        $astuces = $em->getRepository('AppBundle:Astuce')->getAstuce(0, 1);

        return $this->render('fr/astuce.html.twig', array(
            'astuces' => $astuces,
        ));
    }

    /**
    * Recherche des articles actifs de l'entité presentation.
    *
    */
     public function partenaireAction($slug)
     {
         $em = $this->getDoctrine()->getManager();

         $partenaires = $em->getRepository('AppBundle:Partenaire')->getPartenaire();

         return $this->render('fr/partenaire.html.twig', array(
             'partenaires' => $partenaires,
         ));
     }

     /**
     * Recherche des articles actifs de l'entité projet.
     *
     */
      public function projetsAction()
      {
          $em = $this->getDoctrine()->getManager();

          $projets = $em->getRepository('AppBundle:Projet')->getProjet(null, null);

          return $this->render('fr/projets.html.twig', array(
              'projets' => $projets,
          ));
      }

      /**
      * Recherche des articles actifs de l'entité projet.
      *
      */
       public function projetAction($slug)
       {
           $em = $this->getDoctrine()->getManager();

           $projets = $em->getRepository('AppBundle:Projet')->getArticle($slug);

           return $this->render('fr/projet.html.twig', array(
               'projets' => $projets,
           ));
       }

       /**
       * Recherche des articles actifs de l'entité internes.
       *
       */
        public function internesAction()
        {
            $em = $this->getDoctrine()->getManager();

            $internes = $em->getRepository('AppBundle:Interne')->getInterne(null, null);

            return $this->render('fr/internes.html.twig', array(
                'internes' => $internes,
            ));
        }

        /**
        * Recherche des articles actifs de l'entité externes.
        *
        */
         public function externesAction()
         {
             $em = $this->getDoctrine()->getManager();

             $externes = $em->getRepository('AppBundle:Externe')->getExterne(null, null);

             return $this->render('fr/externes.html.twig', array(
                 'externes' => $externes,
             ));
         }

}
