<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ImgPhototheque;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Imgphototheque controller.
 *
 * @Route("admin/imgphototheque")
 */
class ImgPhotothequeController extends Controller
{
    /**
     * Lists all imgPhototheque entities.
     *
     * @Route("/", name="admin_imgphototheque_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imgPhototheques = $em->getRepository('AppBundle:ImgPhototheque')->findAll();

        return $this->render('imgphototheque/index.html.twig', array(
            'imgPhototheques' => $imgPhototheques,
        ));
    }

    /**
     * Creates a new imgPhototheque entity.
     *
     * @Route("/new", name="admin_imgphototheque_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $imgPhototheque = new Imgphototheque();
        $form = $this->createForm('AppBundle\Form\ImgPhotothequeType', $imgPhototheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($imgPhototheque);
            $em->flush($imgPhototheque);

            return $this->redirectToRoute('admin_imgphototheque_show', array('id' => $imgPhototheque->getId()));
        }

        return $this->render('imgphototheque/new.html.twig', array(
            'imgPhototheque' => $imgPhototheque,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a imgPhototheque entity.
     *
     * @Route("/{id}", name="admin_imgphototheque_show")
     * @Method("GET")
     */
    public function showAction(ImgPhototheque $imgPhototheque)
    {
        $deleteForm = $this->createDeleteForm($imgPhototheque);

        return $this->render('imgphototheque/show.html.twig', array(
            'imgPhototheque' => $imgPhototheque,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing imgPhototheque entity.
     *
     * @Route("/{id}/edit", name="admin_imgphototheque_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ImgPhototheque $imgPhototheque)
    {
        $deleteForm = $this->createDeleteForm($imgPhototheque);
        $editForm = $this->createForm('AppBundle\Form\ImgPhotothequeType', $imgPhototheque);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_imgphototheque_edit', array('id' => $imgPhototheque->getId()));
        }

        return $this->render('imgphototheque/edit.html.twig', array(
            'imgPhototheque' => $imgPhototheque,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a imgPhototheque entity.
     *
     * @Route("/{id}", name="admin_imgphototheque_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ImgPhototheque $imgPhototheque)
    {
        $form = $this->createDeleteForm($imgPhototheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($imgPhototheque);
            $em->flush($imgPhototheque);
        }

        return $this->redirectToRoute('admin_imgphototheque_index');
    }

    /**
     * Creates a form to delete a imgPhototheque entity.
     *
     * @param ImgPhototheque $imgPhototheque The imgPhototheque entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ImgPhototheque $imgPhototheque)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_imgphototheque_delete', array('id' => $imgPhototheque->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
