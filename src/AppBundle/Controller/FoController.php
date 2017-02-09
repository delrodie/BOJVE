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



}
