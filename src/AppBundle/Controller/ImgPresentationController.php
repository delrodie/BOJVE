<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ImgPresentation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Imgpresentation controller.
 *
 * @Route("admin/imgpresentation")
 */
class ImgPresentationController extends Controller
{
    /**
     * Lists all imgPresentation entities.
     *
     * @Route("/", name="admin_imgpresentation_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imgPresentations = $em->getRepository('AppBundle:ImgPresentation')->findAll();

        return $this->render('imgpresentation/index.html.twig', array(
            'imgPresentations' => $imgPresentations,
        ));
    }

    /**
     * Creates a new imgPresentation entity.
     *
     * @Route("/new", name="admin_imgpresentation_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $imgPresentation = new Imgpresentation();
        $form = $this->createForm('AppBundle\Form\ImgPresentationType', $imgPresentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($imgPresentation);
            $em->flush($imgPresentation);

            return $this->redirectToRoute('admin_imgpresentation_show', array('id' => $imgPresentation->getId()));
        }

        return $this->render('imgpresentation/new.html.twig', array(
            'imgPresentation' => $imgPresentation,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a imgPresentation entity.
     *
     * @Route("/{id}", name="admin_imgpresentation_show")
     * @Method("GET")
     */
    public function showAction(ImgPresentation $imgPresentation)
    {
        $deleteForm = $this->createDeleteForm($imgPresentation);

        return $this->render('imgpresentation/show.html.twig', array(
            'imgPresentation' => $imgPresentation,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing imgPresentation entity.
     *
     * @Route("/{id}/edit", name="admin_imgpresentation_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ImgPresentation $imgPresentation)
    {
        $deleteForm = $this->createDeleteForm($imgPresentation);
        $editForm = $this->createForm('AppBundle\Form\ImgPresentationType', $imgPresentation);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_imgpresentation_edit', array('id' => $imgPresentation->getId()));
        }

        return $this->render('imgpresentation/edit.html.twig', array(
            'imgPresentation' => $imgPresentation,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a imgPresentation entity.
     *
     * @Route("/{id}", name="admin_imgpresentation_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ImgPresentation $imgPresentation)
    {
        $form = $this->createDeleteForm($imgPresentation);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($imgPresentation);
            $em->flush($imgPresentation);
        }

        return $this->redirectToRoute('admin_imgpresentation_index');
    }

    /**
     * Creates a form to delete a imgPresentation entity.
     *
     * @param ImgPresentation $imgPresentation The imgPresentation entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ImgPresentation $imgPresentation)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_imgpresentation_delete', array('id' => $imgPresentation->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
