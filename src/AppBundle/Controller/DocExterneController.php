<?php

namespace AppBundle\Controller;

use AppBundle\Entity\DocExterne;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Docexterne controller.
 *
 * @Route("admin/docexterne")
 */
class DocExterneController extends Controller
{
    /**
     * Lists all docExterne entities.
     *
     * @Route("/", name="admin_docexterne_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $docExternes = $em->getRepository('AppBundle:DocExterne')->findAll();

        return $this->render('docexterne/index.html.twig', array(
            'docExternes' => $docExternes,
        ));
    }

    /**
     * Creates a new docExterne entity.
     *
     * @Route("/new", name="admin_docexterne_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $docExterne = new Docexterne();
        $form = $this->createForm('AppBundle\Form\DocExterneType', $docExterne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($docExterne);
            $em->flush($docExterne);

            return $this->redirectToRoute('admin_docexterne_show', array('id' => $docExterne->getId()));
        }

        return $this->render('docexterne/new.html.twig', array(
            'docExterne' => $docExterne,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a docExterne entity.
     *
     * @Route("/{id}", name="admin_docexterne_show")
     * @Method("GET")
     */
    public function showAction(DocExterne $docExterne)
    {
        $deleteForm = $this->createDeleteForm($docExterne);

        return $this->render('docexterne/show.html.twig', array(
            'docExterne' => $docExterne,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing docExterne entity.
     *
     * @Route("/{id}/edit", name="admin_docexterne_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, DocExterne $docExterne)
    {
        $deleteForm = $this->createDeleteForm($docExterne);
        $editForm = $this->createForm('AppBundle\Form\DocExterneType', $docExterne);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_docexterne_edit', array('id' => $docExterne->getId()));
        }

        return $this->render('docexterne/edit.html.twig', array(
            'docExterne' => $docExterne,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a docExterne entity.
     *
     * @Route("/{id}", name="admin_docexterne_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, DocExterne $docExterne)
    {
        $form = $this->createDeleteForm($docExterne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($docExterne);
            $em->flush($docExterne);
        }

        return $this->redirectToRoute('admin_docexterne_index');
    }

    /**
     * Creates a form to delete a docExterne entity.
     *
     * @param DocExterne $docExterne The docExterne entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(DocExterne $docExterne)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_docexterne_delete', array('id' => $docExterne->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
