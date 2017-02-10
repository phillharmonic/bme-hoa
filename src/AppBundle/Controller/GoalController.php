<?php

namespace AppBundle\Controller;

use Doctrine\Common\Collections\Criteria;
use AppBundle\Entity\ProgressNote;
use AppBundle\Entity\Goal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;

/**
 * Goal controller.
 * 
 * @Route("admin/goal")
 */
class GoalController extends Controller
{
    /**
     * @Route("/index", name="indexGoalAdmin")
     * @Method("GET")
     */      
    public function indexGoalAdminAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $goals = $em->getRepository('AppBundle:Goal')->getTopGoals();;
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $goals, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            6/*limit per page*/
        );
        
        $goal = new Goal();
        $form = $this->createForm('AppBundle\Form\GoalForm', $goal, array(
            'action' => $this->generateUrl('newGoalAdmin', array(
            'method' => 'POST'
        ))));

        return $this->render('goal/indexGoalAdmin.html.twig', array(
            'goals' => $goals,
            'form'  => $form->createView(),
            'pager' => $pagination
        ));
    }

    /**
     * @Route("/new", name="newGoalAdmin")
     * @Method({"GET", "POST"})
     */    
    public function newGoalAdminAction(Request $request)
    {
        $goal = new Goal();
        $form = $this->createForm('AppBundle\Form\GoalForm', $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $goal->setUser($this->getUser());
            $em->persist($goal);
            $em->flush($goal);

            return $this->redirectToRoute('showGoalAdmin', array('id' => $goal->getId()));
        }

        return $this->render('goal/newGoalAdmin.html.twig', array(
            'goal' => $goal,
            'form' => $form->createView(),
        ));
    }

    public function correctGoalNumbers($progressNote){
        $pnUnits = $progressNote->getUnitsComplete();
        $goal = $progressNote->getGoal();
        $totalComplete = $goal->getTotalComplete();

        $newTotalComp = $totalComplete - $pnUnits; 
        $newPercentComp = $newTotalComp/$goal->getUnitsGoal()*100;
        
        $em = $this->getDoctrine()->getManager();
        
        $goal->setTotalComplete($newTotalComp);
        $goal->setPercentComplete($newPercentComp);
        
        $em->persist($goal);
        $em->flush($goal);
    }
    
    /**
     * Deletes a progressNote entity.
     *
     * @Route("/delete/{id}", name="deleteProgressNote")
     * @Method({"GET"})
     */    
    public function deleteProgressNote($id){
        
            $em = $this->getDoctrine()->getManager();
            $progressNote = $em->getRepository('AppBundle:ProgressNote')->find($id);
            $goal = $progressNote->getGoal()->getId();
            $this->correctGoalNumbers($progressNote);
            $em->remove($progressNote);
            $em->flush($progressNote);

        return $this->redirectToRoute('showGoalAdmin', array('id' => $goal));
    }
    
    /**
     * @Route("/show/{id}/{pnId}", name="showGoalAdmin")
     * @Method({"GET"})
     */    
    public function showGoalAdminAction(Request $request, Goal $goal, $pnId = null )
    {
        $deleteForm = $this->createDeleteForm($goal);
        $progressNotes = $goal->getProgressNotes();
        
        $newerCriteria = Criteria::create()->orderBy(array("created" => 'DESC'));  
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $progressNotes->matching($newerCriteria), /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        
        $progressNote = new ProgressNote();
        $form = $this->createForm('AppBundle\Form\ProgressNoteForm', $progressNote, array(
            'action' => $this->generateUrl('progress_note_new', array(
            'id'     => $goal->getId(),
            'method' => 'POST'
        ))));
        
        $editForm = $this->createForm('AppBundle\Form\GoalForm', $goal, array(
            'action' => $this->generateUrl('editGoalAdmin', array(
            'id'    => $goal->getId(),
            'method' => 'POST'
        ))));
        
        return $this->render('goal/showGoalAdmin.html.twig', array(
            'goal' => $goal,
            'delete_form' => $deleteForm->createView(),
            'notes' => $pagination,
            'form'  => $form->createView(), 
            'pnId'  => $pnId,
            'edit_form' =>  $editForm->createView(), 
        ));
    }

    /**
     * Displays a form to edit an existing progressNote entity.
     *
     * @Route("/{id}/edit", name="editGoalAdmin")
     * @Method({"GET", "POST"})
     */
    public function editGoalAdminAction(Request $request, Goal $goal)
    {
        $deleteForm = $this->createDeleteForm($goal);
        $editForm = $this->createForm('AppBundle\Form\GoalForm', $goal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('showGoalAdmin', array('id' => $goal->getId()));
        }

        return $this->render('goal/editGoalAdmin.html.twig', array(
            'goal' => $goal,
            'form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }    
    
    /**
     * @Route("/{id}", name="deleteGoalAdmin")
     * @Method("DELETE")
     */    
    public function deleteGoalAdminAction(Request $request, Goal $goal)
    {
        $form = $this->createDeleteForm($goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($goal);
            $em->flush($goal);
        }

        return $this->redirectToRoute('indexGoalAdmin');
    }

    /**
     * Creates a form to delete a goal entity.
     *
     * @param Goal $goal The goal entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Goal $goal)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('deleteGoalAdmin', array('id' => $goal->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
