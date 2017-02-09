<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Interne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Interne controller.
 *
 * @Route("admin/interne")
 */
class InterneController extends Controller
{
    /**
     * Lists all interne entities.
     *
     * @Route("/", name="admin_interne_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $internes = $em->getRepository('AppBundle:Interne')->findAll();

        return $this->render('interne/index.html.twig', array(
            'internes' => $internes,
        ));
    }

    /**
     * Creates a new interne entity.
     *
     * @Route("/new", name="admin_interne_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $interne = new Interne();
        $form = $this->createForm('AppBundle\Form\InterneType', $interne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($interne);
            $em->flush($interne);

            return $this->redirectToRoute('admin_interne_show', array('slug' => $interne->getSlug()));
        }

        return $this->render('interne/new.html.twig', array(
            'interne' => $interne,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a interne entity.
     *
     * @Route("/{slug}", name="admin_interne_show")
     * @Method("GET")
     */
    public function showAction(Interne $interne)
    {
        $deleteForm = $this->createDeleteForm($interne);

        return $this->render('interne/show.html.twig', array(
            'interne' => $interne,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing interne entity.
     *
     * @Route("/{slug}/edit", name="admin_interne_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Interne $interne)
    {
        $deleteForm = $this->createDeleteForm($interne);
        $editForm = $this->createForm('AppBundle\Form\InterneType', $interne);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_interne_show', array('slug' => $interne->getSlug()));
        }

        return $this->render('interne/edit.html.twig', array(
            'interne' => $interne,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a interne entity.
     *
     * @Route("/{id}", name="admin_interne_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Interne $interne)
    {
        $form = $this->createDeleteForm($interne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($interne);
            $em->flush($interne);
        }

        return $this->redirectToRoute('admin_interne_index');
    }

    /**
     * Creates a form to delete a interne entity.
     *
     * @param Interne $interne The interne entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Interne $interne)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_interne_delete', array('id' => $interne->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
