<?php

namespace AppBundle\Controller\MinutesControllers;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Minutes;
use AppBundle\Form\MinutesForm;


class MinutesController extends Controller{
    
    public function getLast(){
        //returns the ID of the latest meeting minutes to be uploaded - used for menu navigation
        $repository = $this->getDoctrine()->getRepository('AppBundle:Minutes');
        return $repository->getIdOfLast();
    }
    
    /**
     * @Route(
     *      "/protected/minutes/show", 
     *      name="showMinutesProtected",
     *      requirements={
     *      }
     * )
     */       
    public function showMinutesProtectedAction()
    {        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        return $this->render('minutes/showMinutesProtected.html.twig', array(
        ));
    }
    
    /**
     * @Route(
     *      "/protected/minutes/show/{year}/quarter-{quarter}", 
     *      name="showQuarterlyMinutesProtected",
     *      requirements={
     *          "year": "\d+",
     *          "quarter": "\d+"
     *      }
     * )
     */       
    public function showQuarterlyMinutesProtectedAction($year, $quarter)
    {        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        $repository = $this->getDoctrine()->getRepository('AppBundle:Minutes');
        $minutes = $repository->getMinutesFor($year, $quarter);
        
        if (!$minutes) {
            throw $this->createNotFoundException(
                'No minutes found for id '.$year." ".$quarter
            );
        }
        
        return $this->render('minutes/showQuarterlyMinutesProtectedAction.html.twig', array(
            'minutes'   =>  $minutes,
            'year'      =>  $year,
            'quarter'   =>  $quarter
        ));
    }
    
    /**
     * @Route(
     *      "/admin/minutes/new/", 
     *      name="newMinutesAdmin",
     *      requirements={
     *     }
     * )
     */      
    public function newAction(Request $request){
        $minutes = new Minutes();
//        
        $form = $this->createForm(MinutesForm::class, $minutes, array(
            'action' => $this->generateUrl('newMinutesAdmin' ),
            'method' => 'POST',
        ));
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $minutes->setUser($this->getUser());
                $em->persist($minutes);
                $em->flush();
                
                $this->addFlash(
                    'notice',
                    'Minutes have been successfully uploaded.'
                );
                
                return $this->redirect($this->generateUrl('showMinutesProtected', array('id' => $minutes->getId())));
            }
        }
        
        
        return $this->render('minutes/newMinutesAdmin.html.twig', array(
            'form'  =>  $form->createView(),
        ));
    }
    
    /**
     * @Route(
     *      "/admin/minutes/edit/{id}", 
     *      name="editMinutesAdmin",
     *      requirements={
     *          "id": "\d+"
     *      }
     * )
     */       
    public function editMinutesAdminAction(Request $request, $id)
    {
        $repository = $this->getDoctrine()->getRepository('AppBundle:Minutes');
        $minutes = $repository->find($id);
        
        if (!$minutes) {
            throw $this->createNotFoundException(
                'No minutes found for id '.$id
            );
        }
        
        $form = $this->createForm(MinutesForm::class, $minutes, array(
            'action' => $this->generateUrl('editMinutesAdmin', array('id' => $minutes->getId()) ),
            'method' => 'POST',
        ));
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $minutes->setUser($this->getUser());
                $em->persist($minutes);
                $em->flush();
                
                $this->addFlash(
                    'notice',
                    'Minutes have been successfully updated.'
                );
                
                return $this->redirect($this->generateUrl('showMinutesProtected', array('id' => $minutes->getId())));
            }
        }
        
        return $this->render('minutes/editMinutesAdmin.html.twig', array(
            'form'  =>  $form->createView(),
            'minutes'   =>  $minutes
        ));
    }
    
    
    /**
    * @Route("/admin/minutes/delete/{id}",name="deleteMinutesAdmin")
    * @Method("DELETE")
    */ 
    public function deleteAction($id){
        $minutes = $this->getDoctrine()->getRepository('AppBundle:Minutes')->find($id); 

        if (!$minutes) {
            throw $this->createNotFoundException(
                'No minutes found for id '.$minutes
            );
        }
        $em = $this->getDoctrine()->getManager();
        $em->remove($minutes);
        $em->flush();
        return $this->redirect($this->generateUrl('showMinutesProtected', array('id' => $this->getLast())));
    }
}
