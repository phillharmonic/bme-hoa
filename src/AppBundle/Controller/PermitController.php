<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Permit;
use AppBundle\Form\PermitForm;

/**
 * Description of PermitController
 *
 * @author User
 */
class PermitController extends Controller {

    /**
     * @Route(
     *      "/permit/index/", 
     *      name="permitIndex",
     *      requirements={
     *     }
     * )
     */  
    public function permitIndexAction(){
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager ();
        //unresolved permits
        $unresolvedPermits = $em->getRepository('AppBundle:Permit')->getAllUnresolvedPermits();
        
        //approved permits
        $approvedPermits = $em->getRepository('AppBundle:Permit')->getAllApprovedPermits();
        
        //denied permits
        $deniedPermits = $em->getRepository('AppBundle:Permit')->getAllDeniedPermits();
        
        return $this->render('permits/index.html.twig', array(
            'permits'   => $unresolvedPermits,
            'approved'  => $approvedPermits,
            'denied'    => $deniedPermits,
        ));
    }
    
    
    /**
     * @Route(
     *      "/admin/permit/show/{id}", 
     *      name="adminPermitShow",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */  
    public function adminPermitShowAction($id){
        $em = $this->getDoctrine()->getManager ();
        $permit = $em->getRepository('AppBundle:Permit')->find($id);
        // get the submitted DESCRIPTION                
        $descStr    = $permit->getDescription();
        $descArray  = str_split($descStr, 130);

        // get the submitted LOCATION                
        $locStr    = $permit->getLocation();
        $locArray  = str_split($locStr, 130);
        
        
        return $this->render('permits/adminPermitShow.html.twig', array(
            'permit'    => $permit,
            'descArray' => $descArray,
            'locArray'  => $locArray
        ));
    }    
    
    /**
     * @Route("/admin/permit/index", name="adminPermitIndex")
     */ 
    public function indexAdminAction(){
        $em = $this->getDoctrine()->getManager ();
        //unresolved permits
        $unresolvedPermits = $em->getRepository('AppBundle:Permit')->getUnresolvedPermits();
        
        //approved permits
        $approvedPermits = $em->getRepository('AppBundle:Permit')->getApprovedPermits();
        
        //denied permits
        $deniedPermits = $em->getRepository('AppBundle:Permit')->getDeniedPermits();
        
        return $this->render('permits/adminPermitIndex.html.twig', array(
            'permits'   => $unresolvedPermits,
            'approved'  => $approvedPermits,
            'denied'    => $deniedPermits,
        ));
    }
    
    /**
     * @Route("/permit/new", name="permitNew")
     */    
    public function permitNewAction(Request $request)
    {
        $permit = new Permit();
        $form = $this->createForm(PermitForm::class, $permit, array(
            'action' => $this->generateUrl('permitNew'),
            'method' => 'POST',
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                //handle the file upload
                    $file = $permit->getDrawings();
                    // Generate a unique name for the file before saving it
                    $fileName = md5(uniqid()).'.'.$file->guessExtension();
                    // Move the file to the directory where brochures are stored
                    $file->move(
                        $this->getParameter('permit_drawings_directory'),
                        $fileName
                    );
                    
                $permit->setDrawings($fileName);                
                $permit->setUser($this->getUser());
                $em = $this->getDoctrine()->getManager();
                $em->persist($permit);
                $em->flush();
                
                /*
                 * Variables for the email form: 
                 * 
                 *      Need to get the DESCRIPTION and parse it into 130 character bits
                 *      Need to get the LOCATION and parse it
                 * 
                 */
                
                // get the submitted DESCRIPTION                
                $descStr    = $permit->getDescription();
                $descArray  = str_split($descStr, 130);
                
                // get the submitted LOCATION                
                $locStr    = $permit->getLocation();
                $locArray  = str_split($locStr, 130);
                
                
                $message = \Swift_Message::newInstance();
                $message    ->setSubject('BME Permit Request')
                            ->setFrom($this->getUser()->getEmail())
                            ->setTo($this->container->getParameter('bmehoa.emails.contact_email'))
                            ->setBody(
                                $this->renderView(
                                    'emailTemplates/permit.html.twig',
                                    array(
                                        'permit'    => $permit,
                                        'descArray' => $descArray,
                                        'locArray'  => $locArray
                                    )
                                ),
                                'text/html'
                            )
                            ->attach(\Swift_Attachment::fromPath('../web/uploads/drawings/'.$fileName));
                $this->get('mailer')->send($message);
                
                $this->addFlash(
                    'notice',
                    'Your Permit Application was successfully submitted.'
                );
                
                return $this->redirect($this->generateUrl('exp'));
            }
        }

        return $this->render('permits/new.html.twig', array(
             'form'  =>  $form->createView(),
        ));
    }        
    
    /**
     * @Route("/user/permit/index", name="userPermitIndex")
     */ 
    public function userPermitIndexAction(){
        $user = $this->getUser();
        $em = $this->getDoctrine()->getManager ();        
        //unresolved permits
        $unresolvedPermits = $em->getRepository('AppBundle:Permit')->getUserUnresolvedPermits($user);
        
        //approved permits
        $approvedPermits = $em->getRepository('AppBundle:Permit')->getUserApprovedPermits($user);
        
        //denied permits
        $deniedPermits = $em->getRepository('AppBundle:Permit')->getUserDeniedPermits($user);
        
        return $this->render('permits/userPermitIndex.html.twig', array(
            'permits'   => $unresolvedPermits,
            'approved'  => $approvedPermits,
            'denied'    => $deniedPermits,
        ));
    }    
    
    }
