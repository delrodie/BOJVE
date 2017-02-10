<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ImgPartenaire;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Imgpartenaire controller.
 *
 * @Route("admin/imgpartenaire")
 */
class ImgPartenaireController extends Controller
{
    /**
     * Lists all imgPartenaire entities.
     *
     * @Route("/", name="admin_imgpartenaire_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imgPartenaires = $em->getRepository('AppBundle:ImgPartenaire')->findAll();

        return $this->render('imgpartenaire/index.html.twig', array(
            'imgPartenaires' => $imgPartenaires,
        ));
    }

    /**
     * Creates a new imgPartenaire entity.
     *
     * @Route("/new", name="admin_imgpartenaire_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $imgPartenaire = new Imgpartenaire();
        $form = $this->createForm('AppBundle\Form\ImgPartenaireType', $imgPartenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($imgPartenaire);
            $em->flush($imgPartenaire);

            return $this->redirectToRoute('admin_imgpartenaire_show', array('id' => $imgPartenaire->getId()));
        }

        return $this->render('imgpartenaire/new.html.twig', array(
            'imgPartenaire' => $imgPartenaire,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a imgPartenaire entity.
     *
     * @Route("/{id}", name="admin_imgpartenaire_show")
     * @Method("GET")
     */
    public function showAction(ImgPartenaire $imgPartenaire)
    {
        $deleteForm = $this->createDeleteForm($imgPartenaire);

        return $this->render('imgpartenaire/show.html.twig', array(
            'imgPartenaire' => $imgPartenaire,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing imgPartenaire entity.
     *
     * @Route("/{id}/edit", name="admin_imgpartenaire_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ImgPartenaire $imgPartenaire)
    {
        $deleteForm = $this->createDeleteForm($imgPartenaire);
        $editForm = $this->createForm('AppBundle\Form\ImgPartenaireType', $imgPartenaire);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_imgpartenaire_edit', array('id' => $imgPartenaire->getId()));
        }

        return $this->render('imgpartenaire/edit.html.twig', array(
            'imgPartenaire' => $imgPartenaire,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a imgPartenaire entity.
     *
     * @Route("/{id}", name="admin_imgpartenaire_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ImgPartenaire $imgPartenaire)
    {
        $form = $this->createDeleteForm($imgPartenaire);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($imgPartenaire);
            $em->flush($imgPartenaire);
        }

        return $this->redirectToRoute('admin_imgpartenaire_index');
    }

    /**
     * Creates a form to delete a imgPartenaire entity.
     *
     * @param ImgPartenaire $imgPartenaire The imgPartenaire entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ImgPartenaire $imgPartenaire)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_imgpartenaire_delete', array('id' => $imgPartenaire->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
