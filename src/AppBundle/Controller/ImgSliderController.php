<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ImgSlider;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Imgslider controller.
 *
 * @Route("admin/imgslider")
 */
class ImgSliderController extends Controller
{
    /**
     * Lists all imgSlider entities.
     *
     * @Route("/", name="admin_imgslider_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $imgSliders = $em->getRepository('AppBundle:ImgSlider')->findAll();

        return $this->render('imgslider/index.html.twig', array(
            'imgSliders' => $imgSliders,
        ));
    }

    /**
     * Creates a new imgSlider entity.
     *
     * @Route("/new", name="admin_imgslider_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $imgSlider = new Imgslider();
        $form = $this->createForm('AppBundle\Form\ImgSliderType', $imgSlider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($imgSlider);
            $em->flush($imgSlider);

            return $this->redirectToRoute('admin_imgslider_show', array('id' => $imgSlider->getId()));
        }

        return $this->render('imgslider/new.html.twig', array(
            'imgSlider' => $imgSlider,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a imgSlider entity.
     *
     * @Route("/{id}", name="admin_imgslider_show")
     * @Method("GET")
     */
    public function showAction(ImgSlider $imgSlider)
    {
        $deleteForm = $this->createDeleteForm($imgSlider);

        return $this->render('imgslider/show.html.twig', array(
            'imgSlider' => $imgSlider,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing imgSlider entity.
     *
     * @Route("/{id}/edit", name="admin_imgslider_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ImgSlider $imgSlider)
    {
        $deleteForm = $this->createDeleteForm($imgSlider);
        $editForm = $this->createForm('AppBundle\Form\ImgSliderType', $imgSlider);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('admin_imgslider_edit', array('id' => $imgSlider->getId()));
        }

        return $this->render('imgslider/edit.html.twig', array(
            'imgSlider' => $imgSlider,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a imgSlider entity.
     *
     * @Route("/{id}", name="admin_imgslider_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ImgSlider $imgSlider)
    {
        $form = $this->createDeleteForm($imgSlider);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($imgSlider);
            $em->flush($imgSlider);
        }

        return $this->redirectToRoute('admin_imgslider_index');
    }

    /**
     * Creates a form to delete a imgSlider entity.
     *
     * @param ImgSlider $imgSlider The imgSlider entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ImgSlider $imgSlider)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('admin_imgslider_delete', array('id' => $imgSlider->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
