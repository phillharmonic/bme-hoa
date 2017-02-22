<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Form\ComplaintForm;
use AppBundle\Entity\Complaint;
use AppBundle\Entity\Photos;
use AppBundle\Entity\Action;
use AppBundle\Form\ActionComplaintForm;
//use APY\DataGridBundle\Grid\Source\Entity;


class ComplaintController extends Controller{
    
    
    /**
     * @Route("/admin/complaint/show/{id}", 
     *      name="showComplaintAdmin",
     *      requirements={
     *          "id": "\d+"
     *     })
     */  
    public function showComplaintAdminAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $complaint = $em->getRepository('AppBundle:Complaint')->find($id);
        
        $action = new Action();
        $form = $this->createForm(ActionComplaintForm::class, $action, array(
            'action' => $this->generateUrl('showComplaintAdmin', array('id' =>   $id)),
            'method' => 'POST',
        ));
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                if(strpos($action->getAction(), 'PROBLEM RESOLVED') !== false){ 
                    $complaint->setIsResolved(true);
                    $complaint->setDateResolved(new \DateTime());
                    $complaint->setDateUpdated(new \DateTime());
                    $complaint->setAssignedTo('Complaint Committee');
                }
                else{ 
                    $complaint->setIsResolved(false);
                    $complaint->setDateResolved(null);
                    $complaint->setDateUpdated(new \DateTime());
                    $complaint->setAssignedTo('Complaint Committee');
                }
                $complaint->addAction($action);
                $em = $this->getDoctrine()->getManager();
                $em->persist($action);
                $em->flush();
                
                return $this->redirect($this->generateUrl('indexComplaintAdmin'));
            }
        }
        
        return $this->render('complaint/showComplaintAdmin.html.twig', array(
            'complaint'    =>  $complaint,
            'form'  => $form->createView(),
        ));
    }
    
    /**
     * @Route("/protected/complaint/show/{id}", 
     *      name="showComplaintProtected",
     *      requirements={
     *          "id": "\d+"
     *     })
     */  
    public function showComplaintProtectedAction($id){
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $em = $this->getDoctrine()->getManager();
        $complaint = $em->getRepository('AppBundle:Complaint')->find($id);
        
        return $this->render('complaint/showComplaintProtected.html.twig', array(
            'complaint'    =>  $complaint,
        ));
    }
    
    /**
     * @Route("/private/complaint/show/{id}", 
     *      name="showComplaintPrivate",
     *      requirements={
     *          "id": "\d+"
     *     })
     */  
    public function showComplaintPrivateAction($id){
        $em = $this->getDoctrine()->getManager();
        $complaint = $em->getRepository('AppBundle:Complaint')->find($id);
        
        return $this->render('complaint/showComplaintPrivate.html.twig', array(
            'complaint'    =>  $complaint,
        ));
    }    
    
    /**
     * @Route("/admin/complaint/index", name="indexComplaintAdmin")
     */  
    public function indexComplaintAdminAction(){
        $em = $this->getDoctrine()->getManager();
        
        $unresolvedComps = $em->getRepository('AppBundle:Complaint')->getUnresolvedComps();
        $resolvedComps = $em->getRepository('AppBundle:Complaint')->getResolvedComps();
        
        return $this->render('complaint/indexComplaintAdmin.html.twig', array(
            'unresolvedComps' => $unresolvedComps,
            'resolvedComps' => $resolvedComps,
        ));
    }
    
    /**
     * @Route("/protected/complaint/index", name="indexComplaintProtected")
     */  
    public function indexComplaintProtectedAction(Request $request){
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        $em = $this->getDoctrine()->getManager();       
        $complaints = $em->getRepository('AppBundle:Complaint')->findAll();
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $complaints, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        
        return $this->render('complaint/indexComplaintProtected.html.twig', array(
            'complaints'     => $pagination,
        ));
        
        // Creates a simple grid based on your entity (ORM)
        //$source = new Entity('AppBundle:Complaint');
        
//        $source->manipulateRow(function ($complaint) {
//            $url = $this->generateUrl('showComplaintProtected', array('id' =>   $complaint->getField('id')));
//            
//            if ($complaint->getField('type')) {
//                $complaint->setField('type', "<a href='".$url."'>".$complaint->getField('type')."</a>" );
//            }
//
//            return $complaint;
//        });
        
        // Get a Grid instance
        //$grid = $this->get('grid');
        // Attach the source to the grid
        //$grid->setSource($source);
        //$grid->hideColumns(array('id', 'assigned_to', 'details', 'reg_violated', 'defendent_name', 'defendent_address', 'date_resolved', 'date_updated'));
        // Set the limits
        //$grid->setLimits(array(2, 10, 15));
        // Set the default limit
        //$grid->setDefaultLimit(2);
        // Return the response of the grid to the template
        
        //return $grid->getGridResponse('complaint/indexComplaintProtected.html.twig');
    }
    
    /**
     * @Route("/private/complaint/index", name="indexComplaintPrivate")
     */  
    public function indexComplaintPrivateAction(){
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $em = $this->getDoctrine()->getManager();
        $user = $this->getUser();
        
        $unresolvedComps = $em->getRepository('AppBundle:Complaint')->getUnresolvedComps($user);
        $resolvedComps = $em->getRepository('AppBundle:Complaint')->getResolvedComps($user);
        
        return $this->render('complaint/indexComplaintPrivate.html.twig', array(
            'unresolvedComps' => $unresolvedComps,
            'resolvedComps' => $resolvedComps,
        ));
    }    
    
    
    /**
     * @Route("/protected/complaint/new", name="newComplaintProtected")
     */    
    public function newComplaintProtectedAction(Request $request) {
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        $complaint = new Complaint();
        $photo = new Photos();
        $complaint->getPhotos()->add($photo);
        
        $form = $this->createForm(ComplaintForm::class, $complaint, array(
            'action' => $this->generateUrl('newComplaintProtected'),
            'method' => 'POST',
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $complaint->setUser($this->getUser());
                $complaint->setAssignedTo('unassigned');
                $complaint->setIsResolved(0);
                !isset($photo)?:$em->persist($photo);
                $em->persist($complaint);
                $em->flush();
                
//                $this->container->getParameter('bmehoa.emails.contact_email')
                $message = \Swift_Message::newInstance();
                $message    ->setSubject('New Complaint')
                            ->setFrom($this->getUser()->getEmail())
                            ->setTo($this->container->getParameter('bmehoa.emails.contact_email'))
                            ->setBody(
                                $this->renderView(
                                    'emailTemplates/complaint.html.twig',
                                    array('complaint' => $complaint)
                                ),
                                'text/html'
                            );
                $this->get('mailer')->send($message);
                
                $this->addFlash(
                    'notice',
                    'Your complaint was successfully submitted.  A response will be provided within 10 to 14 days.'
                );
                
                return $this->redirect($this->generateUrl('home'));
            }
        }

        return $this->render('complaint/newComplaintProtected.html.twig', array(
             'form'  =>  $form->createView(),
        ));
    }    
}
