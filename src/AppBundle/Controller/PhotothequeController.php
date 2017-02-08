<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Phototheque;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Phototheque controller.
 *
 * @Route("admin/phototheque")
 */
class PhotothequeController extends Controller
{
    /**
     * Lists all phototheque entities.
     *
     * @Route("/", name="admin_phototheque_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $phototheques = $em->getRepository('AppBundle:Phototheque')->findAll();

        return $this->render('phototheque/index.html.twig', array(
            'phototheques' => $phototheques,
        ));
    }

    /**
     * Creates a new phototheque entity.
     *
     * @Route("/new", name="admin_phototheque_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $phototheque = new Phototheque();
        $form = $this->createForm('AppBundle\Form\PhotothequeType', $phototheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($phototheque);
            $em->flush($phototheque);

            return $this->redirectToRoute('admin_phototheque_show', array('slug' => $phototheque->getSlug()));
        }

        return $this->render('phototheque/new.html.twig', array(
            'phototheque' => $phototheque,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a phototheque entity.
     *
     * @Route("/{slug}", name="admin_phototheque_show")
     * @Method("GET")
     */
    public function showAction(Phototheque $phototheque)
    {
        $deleteForm = $this->createDeleteForm($phototheque);

        return $this->render('phototheque/show.html.twig', array(
            'phototheque' => $phototheque,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing phototheque entity.
     *
     * @Route("/{slug}/edit", name="admin_phototheque_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Phototheque $phototheque)
    {
        $deleteForm = $this->createDeleteForm($phototheque);
        $editForm = $this->createForm('AppBundle\Form\PhotothequeType', $phototheque);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_phototheque_edit', array('slug' => $phototheque->getSlug()));
        }

        return $this->render('phototheque/edit.html.twig', array(
            'phototheque' => $phototheque,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a phototheque entity.
     *
     * @Route("/{id}", name="admin_phototheque_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Phototheque $phototheque)
    {
        $form = $this->createDeleteForm($phototheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($phototheque);
            $em->flush($phototheque);
        }

        return $this->redirectToRoute('admin_phototheque_index');
    }

    /**
     * Creates a form to delete a phototheque entity.
     *
     * @param Phototheque $phototheque The phototheque entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Phototheque $phototheque)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_phototheque_delete', array('id' => $phototheque->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
