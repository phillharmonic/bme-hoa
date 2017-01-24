<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Goal;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Goal controller.
 *
 */
class GoalController extends Controller
{
    /**
     * @Route(
     *      "/admin/goal/index", 
     *      name="indexGoalAdmin",
     *      requirements={
     *     }
     * )
     */      
    public function indexGoalAdminAction()
    {
        $em = $this->getDoctrine()->getManager();

        $goals = $em->getRepository('AppBundle:Goal')->findAll();

        return $this->render('goal/index.html.twig', array(
            'goals' => $goals,
        ));
    }

    /**
     * @Route(
     *      "/admin/goal/new", 
     *      name="newGoalAdmin",
     *      requirements={
     *     }
     * )
     */    
    public function newGoalAdminAction(Request $request)
    {
        $goal = new Goal();
        $form = $this->createForm('AppBundle\Form\GoalForm', $goal);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($goal);
            $em->flush($goal);

            return $this->redirectToRoute('showGoalAdmin', array('id' => $goal->getId()));
        }

        return $this->render('goal/new.html.twig', array(
            'goal' => $goal,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route(
     *      "/admin/goal/show/{id}", 
     *      name="showGoalAdmin",
     *      requirements={
     *           "id": "\d+"
     *     }
     * )
     */    
    public function showAction(Goal $goal)
    {
        $deleteForm = $this->createDeleteForm($goal);

        return $this->render('goal/show.html.twig', array(
            'goal' => $goal,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route(
     *      "/admin/goal/edit/{id}", 
     *      name="editGoalAdmin",
     *      requirements={
     *          "id": "\d+"
     *     }
     * )
     */    
    public function editGoalAdminAction(Request $request, Goal $goal)
    {
        $deleteForm = $this->createDeleteForm($goal);
        $editForm = $this->createForm('AppBundle\Form\GoalForm', $goal);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('editGoalAdmin', array('id' => $goal->getId()));
        }

        return $this->render('goal/edit.html.twig', array(
            'goal' => $goal,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * @Route(
     *      "/admin/goal/delete/{id}", 
     *      name="deleteGoalAdmin",
     *      requirements={
     *          "id": "\d+"
     *     }
     * )
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

        return $this->redirectToRoute('goal_admin_index');
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
            ->setAction($this->generateUrl('goal_admin_delete', array('id' => $goal->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
