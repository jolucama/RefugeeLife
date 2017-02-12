<?php

namespace AppBundle\Controller;

use AppBundle\Entity\RefugeeStory;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Refugeestory controller.
 *
 * @Route("refugeestory")
 */
class RefugeeStoryController extends Controller
{
    /**
     * Lists all refugeeStory entities.
     *
     * @Route("/", name="refugeestory_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $refugeeStories = $em->getRepository('AppBundle:RefugeeStory')->findAll();

        return $this->render('refugeestory/index.html.twig', array(
            'refugeeStories' => $refugeeStories,
        ));
    }

    /**
     * Creates a new refugeeStory entity.
     *
     * @Route("/new", name="refugeestory_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $refugeeStory = new Refugeestory();
        $form = $this->createForm('AppBundle\Form\RefugeeStoryType', $refugeeStory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($refugeeStory);
            $em->flush($refugeeStory);

            return $this->redirectToRoute('refugeestory_show', array('id' => $refugeeStory->getId()));
        }

        return $this->render('refugeestory/new.html.twig', array(
            'refugeeStory' => $refugeeStory,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a refugeeStory entity.
     *
     * @Route("/{id}", name="refugeestory_show")
     * @Method("GET")
     */
    public function showAction(RefugeeStory $refugeeStory)
    {
        $deleteForm = $this->createDeleteForm($refugeeStory);

        return $this->render('refugeestory/show.html.twig', array(
            'refugeeStory' => $refugeeStory,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing refugeeStory entity.
     *
     * @Route("/{id}/edit", name="refugeestory_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, RefugeeStory $refugeeStory)
    {
        $deleteForm = $this->createDeleteForm($refugeeStory);
        $editForm = $this->createForm('AppBundle\Form\RefugeeStoryType', $refugeeStory);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('refugeestory_edit', array('id' => $refugeeStory->getId()));
        }

        return $this->render('refugeestory/edit.html.twig', array(
            'refugeeStory' => $refugeeStory,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a refugeeStory entity.
     *
     * @Route("/{id}", name="refugeestory_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, RefugeeStory $refugeeStory)
    {
        $form = $this->createDeleteForm($refugeeStory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($refugeeStory);
            $em->flush($refugeeStory);
        }

        return $this->redirectToRoute('refugeestory_index');
    }

    /**
     * Creates a form to delete a refugeeStory entity.
     *
     * @param RefugeeStory $refugeeStory The refugeeStory entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(RefugeeStory $refugeeStory)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('refugeestory_delete', array('id' => $refugeeStory->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
