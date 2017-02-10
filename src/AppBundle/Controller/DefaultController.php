<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..').DIRECTORY_SEPARATOR,
        ]);
    }

    /**
     * @Route("/admin", name="admin_accueil")
     */
    public function adminAction(Request $request)
    {
      $em = $this->getDoctrine()->getManager();

      $nombreProjet = $em->getRepository('AppBundle:Projet')->getNombreProjet();

      $nombrePublicationInterne = $em->getRepository('AppBundle:Interne')->getNombrePublicationInterne();

      $nombrePublicationExterne = $em->getRepository('AppBundle:Externe')->getNombrePublicationExterne();

      $nombreAlbums = $em->getRepository('AppBundle:Phototheque')->getNombreAlbums();

        return $this->render('default/index.html.twig', array(
            'nombreProjet' => $nombreProjet,
            'nombrePublicationInterne' => $nombrePublicationInterne,
            'nombrePublicationExterne' => $nombrePublicationExterne,
            'nombreAlbums' => $nombreAlbums,
        ));
    }

    // ====================================
    // Controllers pour l'accueil du BackOffice
    // ====================================

    /**
     * Nombre de projets enregistrés.
     *
     */
    public function nombreprojetAction()
    {
        $em = $this->getDoctrine()->getManager();

        $projets = $em->getRepository('AppBundle:Projet')->getNombreProjet();

        $publicationInternes = $em->getRepository('AppBundle:Projet')->getNombrePublicationInterne();

        return $this->render('default/nombreprojet.html.twig', array(
            'projets' => $projets,
        ));
    }

}
