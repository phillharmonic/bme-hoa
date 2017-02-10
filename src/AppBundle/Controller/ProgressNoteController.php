<?php

namespace AppBundle\Controller;

use AppBundle\Entity\ProgressNote;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Doctrine\Common\Collections\Criteria;

/**
 * Progressnote controller.
 *
 * @Route("progress_note")
 */
class ProgressNoteController extends Controller
{
    
    protected function getGoal($id)
    {
        $em = $this->getDoctrine()->getManager();
        $goal = $em->getRepository('AppBundle:Goal')->find($id);
        
        if (!$goal) {
            throw $this->createNotFoundException('Unable to find Goal.');
        }

        return $goal;
    }
    
    /**
     * Lists all progressNote entities.
     *
     * @Route("/", name="progress_note_index")
     * @Method("GET")
     */
    public function indexAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();

        $progressNotes = $em->getRepository('AppBundle:ProgressNote')->findAll();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $progressNotes, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );

        return $this->render('progressnote/index.html.twig', array(
            'progressNotes' => $pagination,
        ));
    }
    
    /**
     * Creates a new progressNote entity.
     *
     * @Route("/{id}/new", name="progress_note_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request, $id)
    {
        $progressNote = new Progressnote();
        $form = $this->createForm('AppBundle\Form\ProgressNoteForm', $progressNote);
        
        $goal = $this->getGoal($id);
        $progressNote->setGoal($goal);
        $progressNote->setUser($this->getUser());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            
            //calculate and set percent complete in progress note.  
            $goalUnits = $goal->getUnitsGoal();
            $pnuc = $progressNote->getUnitsComplete();
            $pnpc = $pnuc/$goalUnits*100;
            $progressNote->setCompletionPercentage($pnpc);
            
            //calculate and set total complete in GOAL
            $currentGoalTotalComplete = $goal->getTotalComplete();
            $newGoalTotalComplete = $pnuc + $currentGoalTotalComplete;
            $goal->setTotalComplete($newGoalTotalComplete);
            
            //calculate and set percent complete in GOAL
            $newGoalPercentComplete = $newGoalTotalComplete/$goalUnits*100;
            $goal->setPercentComplete($newGoalPercentComplete);
            
            $em->persist($progressNote);
            $em->persist($goal);
            $em->flush($progressNote);
            $em->flush($goal);
            return $this->redirectToRoute('showGoalAdmin', array('id' => $id));
        }

        return $this->render('progressnote/new.html.twig', array(
            'progressNote' => $progressNote,
            'form' => $form->createView(),
            'goal'  =>  $goal,
        ));
    }

    /**
     * Finds and displays a progressNote entity.
     *
     * @Route("/{id}", name="progress_note_show")
     * @Method("GET")
     */
    public function showAction(ProgressNote $progressNote)
    {
        $deleteForm = $this->createDeleteForm($progressNote);

        return $this->render('progressnote/show.html.twig', array(
            'progressNote' => $progressNote,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing progressNote entity.
     *
     * @Route("/{id}/edit", name="progress_note_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, ProgressNote $progressNote)
    {
        $deleteForm = $this->createDeleteForm($progressNote);
        $editForm = $this->createForm('AppBundle\Form\ProgressNoteForm', $progressNote);
        $editForm->handleRequest($request);
        $goal = $progressNote->getGoal();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('progress_note_show', array('id' => $progressNote->getId()));
        }

        return $this->render('progressnote/edit.html.twig', array(
            'progressNote' => $progressNote,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'goal'  =>  $goal
        ));
    }
    
    /**
     * Displays a form to edit an existing progressNote entity.
     *
     * @Route("/admin/progress-note/edit/{id}", name="editNoteAdmin")
     * @Method({"GET", "POST"})
     */
    public function editNoteAdminAction(Request $request, ProgressNote $progressNote)
    {
        $deleteForm = $this->createDeleteForm($progressNote);
        $editForm = $this->createForm('AppBundle\Form\ProgressNoteForm', $progressNote);
        $editForm->handleRequest($request);
        $goal = $progressNote->getGoal();

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();
            return new Response(json_encode(array('status'=>'success')));
//            return $this->redirectToRoute('progress_note_show', array('id' => $progressNote->getId()));
        }

        return $this->render('progressnote/editNoteAdmin.html.twig', array(
            'progressNote' => $progressNote,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
            'goal'  =>  $goal
        ));
    }

    /**
     * Deletes a progressNote entity.
     *
     * @Route("/{id}", name="progress_note_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, ProgressNote $progressNote)
    {
        $form = $this->createDeleteForm($progressNote);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($progressNote);
            $em->flush($progressNote);
        }

        return $this->redirectToRoute('showGoalAdmin', array('id' => $progressNote->getGoal()->getId()));
    }

    /**
     * Creates a form to delete a progressNote entity.
     *
     * @param ProgressNote $progressNote The progressNote entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(ProgressNote $progressNote)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('progress_note_delete', array('id' => $progressNote->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
