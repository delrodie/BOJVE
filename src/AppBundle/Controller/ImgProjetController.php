<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ImgProjet;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Imgprojet controller.
 *
 * @Route("admin/imgprojet")
 */
class ImgProjetController extends Controller
{
    /**
     * Lists all imgProjet entities.
     *
     * @Route("/", name="admin_imgprojet_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imgProjets = $em->getRepository('AppBundle:ImgProjet')->findAll();

        return $this->render('imgprojet/index.html.twig', array(
            'imgProjets' => $imgProjets,
        ));
    }

    /**
     * Creates a new imgProjet entity.
     *
     * @Route("/new", name="admin_imgprojet_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $imgProjet = new Imgprojet();
        $form = $this->createForm('AppBundle\Form\ImgProjetType', $imgProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($imgProjet);
            $em->flush($imgProjet);

            return $this->redirectToRoute('admin_imgprojet_show', array('id' => $imgProjet->getId()));
        }

        return $this->render('imgprojet/new.html.twig', array(
            'imgProjet' => $imgProjet,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a imgProjet entity.
     *
     * @Route("/{id}", name="admin_imgprojet_show")
     * @Method("GET")
     */
    public function showAction(ImgProjet $imgProjet)
    {
        $deleteForm = $this->createDeleteForm($imgProjet);

        return $this->render('imgprojet/show.html.twig', array(
            'imgProjet' => $imgProjet,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing imgProjet entity.
     *
     * @Route("/{id}/edit", name="admin_imgprojet_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ImgProjet $imgProjet)
    {
        $deleteForm = $this->createDeleteForm($imgProjet);
        $editForm = $this->createForm('AppBundle\Form\ImgProjetType', $imgProjet);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_imgprojet_edit', array('id' => $imgProjet->getId()));
        }

        return $this->render('imgprojet/edit.html.twig', array(
            'imgProjet' => $imgProjet,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a imgProjet entity.
     *
     * @Route("/{id}", name="admin_imgprojet_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ImgProjet $imgProjet)
    {
        $form = $this->createDeleteForm($imgProjet);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($imgProjet);
            $em->flush($imgProjet);
        }

        return $this->redirectToRoute('admin_imgprojet_index');
    }

    /**
     * Creates a form to delete a imgProjet entity.
     *
     * @param ImgProjet $imgProjet The imgProjet entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ImgProjet $imgProjet)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_imgprojet_delete', array('id' => $imgProjet->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
