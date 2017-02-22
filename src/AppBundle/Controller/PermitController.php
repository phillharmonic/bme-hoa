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
use APY\DataGridBundle\Grid\Source\Entity;
use APY\DataGridBundle\Grid\Column\BooleanColumn;

/**
 * Description of PermitController
 *
 * @author User
 */
class PermitController extends Controller {

    /**
     * @Route(
     *      "/protected/permit/index/", 
     *      name="indexPermitProtected",
     *      requirements={
     *     }
     * )
     */  
    public function indexPermitProtectedAction(Request $request){    
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        $em = $this->getDoctrine()->getManager();       
        $permits = $em->getRepository('AppBundle:Permit')->findAll();
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $permits, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        
        return $this->render('permits/indexPermitProtected.html.twig', array(
            'permits'     => $pagination,
        ));
        
//        $source = new Entity('AppBundle:Permit');
//        $source->manipulateRow(function ($permit) {
//            $url = $this->generateUrl('showPermitProtected', array('id' =>   $permit->getField('id')));
//            
//            if ($permit->getField('type')) {
//                $permit->setField('type', "<a href='".$url."'>".$permit->getField('type')."</a>" );
//            }
//
//            return $permit;
//        });
//        // Get a Grid instance
//        $grid = $this->get('grid');
//        // create a column
//        $MyColumn = new BooleanColumn(array('id' => 'pending', 'title' => 'Pending', 'size' => '54', 'filterable' => true, 'sortable' => true));
//        // add this column to the 3rd position
//        $grid->addColumn($MyColumn, 4);
//        // Attach the source to the grid
//        $grid->setSource($source);
//        $grid->hideColumns(array('id', 'description', 'location', 'drawings', 'assoc_name', 'decision_date', 'decided_by'));
//        // Set the limits
//        $grid->setLimits(array(5, 10, 15));
//        // Set the default limit
//        $grid->setDefaultLimit(5);
//        // Return the response of the grid to the template
//        return $grid->getGridResponse('permits/indexPermitProtected.html.twig');
        
    }
    
    
    /**
     * @Route(
     *      "/protected/permit/show/{id}", 
     *      name="showPermitProtected",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */  
    public function showPermitProtectedAction($id){
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $em = $this->getDoctrine()->getManager ();
        $permit = $em->getRepository('AppBundle:Permit')->find($id);
        // get the submitted DESCRIPTION                
        $descStr    = $permit->getDescription();
        $descArray  = str_split($descStr, 130);

        // get the submitted LOCATION                
        $locStr    = $permit->getLocation();
        $locArray  = str_split($locStr, 130);
        
        
        return $this->render('permits/showPermitProtected.html.twig', array(
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
     * @Route("/protected/permit/new", name="newPermitProtected")
     */    
    public function newPermitProtectedAction(Request $request){
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        $permit = new Permit();
        $form = $this->createForm(PermitForm::class, $permit, array(
            'action' => $this->generateUrl('newPermitProtected'),
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
                
                return $this->redirect($this->generateUrl('indexPermitProtected'));
            }
        }

        return $this->render('permits/newPermitProtected.html.twig', array(
             'form'  =>  $form->createView(),
        ));
    }        
    
    /**
     * @Route("/user/permit/index", name="userPermitIndex")
     */ 
    public function userPermitIndexAction(){
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
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
