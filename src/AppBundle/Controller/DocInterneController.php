<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DocInterne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Docinterne controller.
 *
 * @Route("admin/docinterne")
 */
class DocInterneController extends Controller
{
    /**
     * Lists all docInterne entities.
     *
     * @Route("/", name="admin_docinterne_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $docInternes = $em->getRepository('AppBundle:DocInterne')->findAll();

        return $this->render('docinterne/index.html.twig', array(
            'docInternes' => $docInternes,
        ));
    }

    /**
     * Creates a new docInterne entity.
     *
     * @Route("/new", name="admin_docinterne_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $docInterne = new Docinterne();
        $form = $this->createForm('AppBundle\Form\DocInterneType', $docInterne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($docInterne);
            $em->flush($docInterne);

            return $this->redirectToRoute('admin_docinterne_show', array('id' => $docInterne->getId()));
        }

        return $this->render('docinterne/new.html.twig', array(
            'docInterne' => $docInterne,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a docInterne entity.
     *
     * @Route("/{id}", name="admin_docinterne_show")
     * @Method("GET")
     */
    public function showAction(DocInterne $docInterne)
    {
        $deleteForm = $this->createDeleteForm($docInterne);

        return $this->render('docinterne/show.html.twig', array(
            'docInterne' => $docInterne,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing docInterne entity.
     *
     * @Route("/{id}/edit", name="admin_docinterne_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, DocInterne $docInterne)
    {
        $deleteForm = $this->createDeleteForm($docInterne);
        $editForm = $this->createForm('AppBundle\Form\DocInterneType', $docInterne);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_docinterne_edit', array('id' => $docInterne->getId()));
        }

        return $this->render('docinterne/edit.html.twig', array(
            'docInterne' => $docInterne,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a docInterne entity.
     *
     * @Route("/{id}", name="admin_docinterne_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, DocInterne $docInterne)
    {
        $form = $this->createDeleteForm($docInterne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($docInterne);
            $em->flush($docInterne);
        }

        return $this->redirectToRoute('admin_docinterne_index');
    }

    /**
     * Creates a form to delete a docInterne entity.
     *
     * @param DocInterne $docInterne The docInterne entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DocInterne $docInterne)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_docinterne_delete', array('id' => $docInterne->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
