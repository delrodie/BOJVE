<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Astuce;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Astuce controller.
 *
 * @Route("admin/astuce")
 */
class AstuceController extends Controller
{
    /**
     * Lists all astuce entities.
     *
     * @Route("/", name="admin_astuce_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $astuces = $em->getRepository('AppBundle:Astuce')->findAll();

        return $this->render('astuce/index.html.twig', array(
            'astuces' => $astuces,
        ));
    }

    /**
     * Creates a new astuce entity.
     *
     * @Route("/new", name="admin_astuce_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $astuce = new Astuce();
        $form = $this->createForm('AppBundle\Form\AstuceType', $astuce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($astuce);
            $em->flush($astuce);

            return $this->redirectToRoute('admin_astuce_index');
        }

        return $this->render('astuce/new.html.twig', array(
            'astuce' => $astuce,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a astuce entity.
     *
     * @Route("/{slug}", name="admin_astuce_show")
     * @Method("GET")
     */
    public function showAction(Astuce $astuce)
    {
        $deleteForm = $this->createDeleteForm($astuce);

        return $this->render('astuce/show.html.twig', array(
            'astuce' => $astuce,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing astuce entity.
     *
     * @Route("/{slug}/edit", name="admin_astuce_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Astuce $astuce)
    {
        $deleteForm = $this->createDeleteForm($astuce);
        $editForm = $this->createForm('AppBundle\Form\AstuceType', $astuce);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_astuce_index');
        }

        return $this->render('astuce/edit.html.twig', array(
            'astuce' => $astuce,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a astuce entity.
     *
     * @Route("/{id}", name="admin_astuce_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Astuce $astuce)
    {
        $form = $this->createDeleteForm($astuce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($astuce);
            $em->flush($astuce);
        }

        return $this->redirectToRoute('admin_astuce_index');
    }

    /**
     * Creates a form to delete a astuce entity.
     *
     * @param Astuce $astuce The astuce entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Astuce $astuce)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_astuce_delete', array('id' => $astuce->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
