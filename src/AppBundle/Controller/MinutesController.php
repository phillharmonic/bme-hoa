<?php

namespace AppBundle\Controller;

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
     *      "/admin/minutes/index", 
     *      name="indexMinutesAdmin",
     *      requirements={
     *     }
     * )
     */      
    public function indexMinutesAdminAction(Request $request){
        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Minutes');
        $minutes = $repository->findAll();
        $latestMinutes = $repository->findOneBy(array('id' => $this->getLast()));
        
        $minute = new Minutes();
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $minutes, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        
        $form = $this->createForm(MinutesForm::class, $minute, array(
            'action' => $this->generateUrl('newMinutesAdmin', array(
            'method' => 'POST'
        ))));
        
        return $this->render('minutes/indexMinutesAdmin.html.twig', array(
            'minutes'   =>  $pagination,
            'latestMinutes'  =>  $latestMinutes,
            'form'  =>  $form->createView(),
        ));
    }
    
    public function minutesSubmenuAction($route){
        $agendas = $this->getDoctrine()->getRepository('AppBundle:Agenda')->findAll();
        
        return $this->render('sidebars/minutesSidebar.html.twig', array(
            'route' => $route,
            'agendas' => $agendas
        ));
    }
    
    /**
     * @Route(
     *      "/protected/minutes/home", 
     *      name="homeMinutesProtected",
     *      requirements={
     *      }
     * )
     */       
    public function homeMinutesProtectedAction()
    {        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        return $this->render('minutes/homeMinutesProtected.html.twig', array(
        ));
    }
    
    /**
     * @Route(
     *      "/admin/minutes/show/{id}", 
     *      name="showMinutesAdmin",
     *      requirements={
     *          "id": "\d+",
     *      }
     * )
     */       
    public function showMinutesAdminAction($id)
    {        
        $em = $this->getDoctrine()->getManager();
        $minutes = $em->getRepository('AppBundle:Minutes')->find($id);

        $form = $this->createForm(MinutesForm::class, $minutes, array(
            'action' => $this->generateUrl('editMinutesAdmin', array(
            'id'    =>  $id,
            'method' => 'POST'
        ))));
        
        return $this->render('minutes/showMinutesAdmin.html.twig', array(
            'minutes'    => $minutes, 
            'form'  => $form->createView()
        ));
    }  
    
    /**
     * @Route(
     *      "/protected/minutes/show/{year}/quarter-{quarter}", 
     *      name="showMinutesProtected",
     *      requirements={
     *          "year": "\d+",
     *          "quarter": "\d+"
     *      }
     * )
     */       
    public function showMinutesProtectedAction($year, $quarter)
    {        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        $repository = $this->getDoctrine()->getRepository('AppBundle:Minutes');
        $minutes = $repository->getMinutesFor($year, $quarter);
        
        $allMinutes = $repository->getMinutesForYear($year);
        
        if (!$minutes) {
            throw $this->createNotFoundException(
                'No minutes found for id '.$year." ".$quarter
            );
        }
        
        return $this->render('minutes/showMinutesProtectedAction.html.twig', array(
            'minutes'   =>  $minutes,
            'year'      =>  $year,
            'quarter'   =>  $quarter,
            'allMinutes' => $allMinutes
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
    public function newMinutesAdminAction(Request $request){
        $minutes = new Minutes();
        $form = $this->createForm(MinutesForm::class, $minutes, array(
            'action' => $this->generateUrl('newMinutesAdmin' ),
            'method' => 'POST',
        ));
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $minutes->setUser($this->getUser());
                $minutes->setTitle("[ ".$minutes->getYear()." ] Quarter-".$minutes->getQuarter());
                $em->persist($minutes);
                $em->flush();
                
                $this->addFlash(
                    'notice',
                    'Minutes have been successfully uploaded.'
                );
                
                return $this->redirect($this->generateUrl('indexMinutesAdmin'));
            }
        }
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
                $minutes->setTitle("[ ".$minutes->getYear()." ] Quarter-".$minutes->getQuarter());
                $em->persist($minutes);
                $em->flush();
                
                $this->addFlash(
                    'notice',
                    'Minutes have been successfully updated.'
                );
                
                return $this->redirect($this->generateUrl('indexMinutesAdmin'));
            }
        }
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
