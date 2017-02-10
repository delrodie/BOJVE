<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Presentation;
use AppBundle\Entity\Avantage;
use AppBundle\Entity\Communaute;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 *
 */
class MenuController extends Controller
{

  /**
   * Menu de la rubrique presentation.
   *
   */
  public function presentationAction()
  {
      $em = $this->getDoctrine()->getManager();

      $presentations = $em->getRepository('AppBundle:Presentation')->findAll();

      return $this->render('menu/presentation.html.twig', array(
          'presentations' => $presentations,
      ));
  }

  /**
   * Menu de la rubrique presentation.
   *
   */
  public function fopresentationAction()
  {
      $em = $this->getDoctrine()->getManager();

      $presentations = $em->getRepository('AppBundle:Presentation')->getMenu();

      return $this->render('menu/fopresentation.html.twig', array(
          'presentations' => $presentations,
      ));
  }

}
