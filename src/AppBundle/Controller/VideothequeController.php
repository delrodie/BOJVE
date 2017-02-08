<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Videotheque;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Videotheque controller.
 *
 * @Route("admin/videotheque")
 */
class VideothequeController extends Controller
{
    /**
     * Lists all videotheque entities.
     *
     * @Route("/", name="admin_videotheque_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $videotheques = $em->getRepository('AppBundle:Videotheque')->findAll();

        return $this->render('videotheque/index.html.twig', array(
            'videotheques' => $videotheques,
        ));
    }

    /**
     * Creates a new videotheque entity.
     *
     * @Route("/new", name="admin_videotheque_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $videotheque = new Videotheque();
        $form = $this->createForm('AppBundle\Form\VideothequeType', $videotheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($videotheque);
            $em->flush($videotheque);

            return $this->redirectToRoute('admin_videotheque_show', array('slug' => $videotheque->getSlug()));
        }

        return $this->render('videotheque/new.html.twig', array(
            'videotheque' => $videotheque,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a videotheque entity.
     *
     * @Route("/{slug}", name="admin_videotheque_show")
     * @Method("GET")
     */
    public function showAction(Videotheque $videotheque)
    {
        $deleteForm = $this->createDeleteForm($videotheque);

        return $this->render('videotheque/show.html.twig', array(
            'videotheque' => $videotheque,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing videotheque entity.
     *
     * @Route("/{slug}/edit", name="admin_videotheque_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Videotheque $videotheque)
    {
        $deleteForm = $this->createDeleteForm($videotheque);
        $editForm = $this->createForm('AppBundle\Form\VideothequeType', $videotheque);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_videotheque_show', array('slug' => $videotheque->getSlug()));
        }

        return $this->render('videotheque/edit.html.twig', array(
            'videotheque' => $videotheque,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a videotheque entity.
     *
     * @Route("/{id}", name="admin_videotheque_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Videotheque $videotheque)
    {
        $form = $this->createDeleteForm($videotheque);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($videotheque);
            $em->flush($videotheque);
        }

        return $this->redirectToRoute('admin_videotheque_index');
    }

    /**
     * Creates a form to delete a videotheque entity.
     *
     * @param Videotheque $videotheque The videotheque entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Videotheque $videotheque)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_videotheque_delete', array('id' => $videotheque->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
