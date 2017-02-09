<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Externe;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Externe controller.
 *
 * @Route("admin/externe")
 */
class ExterneController extends Controller
{
    /**
     * Lists all externe entities.
     *
     * @Route("/", name="admin_externe_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $externes = $em->getRepository('AppBundle:Externe')->findAll();

        return $this->render('externe/index.html.twig', array(
            'externes' => $externes,
        ));
    }

    /**
     * Creates a new externe entity.
     *
     * @Route("/new", name="admin_externe_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $externe = new Externe();
        $form = $this->createForm('AppBundle\Form\ExterneType', $externe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($externe);
            $em->flush($externe);

            return $this->redirectToRoute('admin_externe_show', array('slug' => $externe->getSlug()));
        }

        return $this->render('externe/new.html.twig', array(
            'externe' => $externe,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a externe entity.
     *
     * @Route("/{slug}", name="admin_externe_show")
     * @Method("GET")
     */
    public function showAction(Externe $externe)
    {
        $deleteForm = $this->createDeleteForm($externe);

        return $this->render('externe/show.html.twig', array(
            'externe' => $externe,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing externe entity.
     *
     * @Route("/{slug}/edit", name="admin_externe_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Externe $externe)
    {
        $deleteForm = $this->createDeleteForm($externe);
        $editForm = $this->createForm('AppBundle\Form\ExterneType', $externe);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_externe_edit', array('slug' => $externe->getSlug()));
        }

        return $this->render('externe/edit.html.twig', array(
            'externe' => $externe,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a externe entity.
     *
     * @Route("/{id}", name="admin_externe_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Externe $externe)
    {
        $form = $this->createDeleteForm($externe);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($externe);
            $em->flush($externe);
        }

        return $this->redirectToRoute('admin_externe_index');
    }

    /**
     * Creates a form to delete a externe entity.
     *
     * @param Externe $externe The externe entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Externe $externe)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_externe_delete', array('id' => $externe->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
