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
    public function indexComplaintProtectedAction(){
        $em = $this->getDoctrine()->getManager();
        
        $unresolvedComps = $em->getRepository('AppBundle:Complaint')->getUnresolvedComps();
        $resolvedComps = $em->getRepository('AppBundle:Complaint')->getResolvedComps();
        
        return $this->render('complaint/indexComplaintProtected.html.twig', array(
            'unresolvedComps' => $unresolvedComps,
            'resolvedComps' => $resolvedComps,
        ));
    }
    
    /**
     * @Route("/private/complaint/index", name="indexComplaintPrivate")
     */  
    public function indexComplaintPrivateAction(){
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
     * @Route("/complaint/new", name="complaintNew")
     */    
    public function newComplaintAction(Request $request)
    {
        $complaint = new Complaint();
        $photo = new Photos();
        $complaint->getPhotos()->add($photo);
        
        $form = $this->createForm(ComplaintForm::class, $complaint, array(
            'action' => $this->generateUrl('complaintNew'),
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
                
                return $this->redirect($this->generateUrl('exp'));
            }
        }

        return $this->render('complaint/newComplaint.html.twig', array(
             'form'  =>  $form->createView(),
        ));
    }    
}
