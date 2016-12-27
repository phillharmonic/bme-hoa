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
use AppBundle\Entity\Action;
use AppBundle\Form\ActionForm;

/**
 * Description of ActionController
 *
 * @author User
 */
class ActionController extends Controller{
    
    /**
     * @Route(
     *      "/admin/permit/action/new/{id}", 
     *      name="adminPermitActionNew",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */      
    public function adminPermitActionNew(Request $request, $id){
        $em = $this->getDoctrine()->getManager ();
        $permit = $em->getRepository('AppBundle:Permit')->find($id);
        
        $action = new Action();
        $form = $this->createForm(ActionForm::class, $action, array(
            'action' => $this->generateUrl('adminPermitActionNew', array('id' =>   $id)),
            'method' => 'POST',
        ));
        
        //for previous actions - we need to sort them by date, with newest first:
        // TODO: get this working
//        $actions = $em->getRepository('AppBundle:Action')->getSortedActionsForPermit($permit);
        
        // get the submitted DESCRIPTION                
        $descStr    = $permit->getDescription();
        $descArray  = str_split($descStr, 130);

        // get the submitted LOCATION                
        $locStr    = $permit->getLocation();
        $locArray  = str_split($locStr, 130);
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                if(strpos($action->getAction(), 'DENIED') !== false){ 
                    $permit->setDecidedBy($action->getAction());
                    $permit->setIsDenied(true);
                    $permit->setIsApproved(false);
                    $permit->setDecisionDate(new \DateTime());
                }
                elseif(strpos($action->getAction(), 'APPROVED') !== false){ 
                    $permit->setDecidedBy($action->getAction());
                    $permit->setIsDenied(false);
                    $permit->setIsApproved(true);
                    $permit->setDecisionDate(new \DateTime());
                }
                $permit->addAction($action);
                $em = $this->getDoctrine()->getManager();
                $em->persist($action);
                $em->flush();
                
                return $this->redirect($this->generateUrl('adminPermitIndex'));
            }
        }
        
        return $this->render('actions/adminPermitActionNew.html.twig', array(
            'form'      =>  $form->createView(),
//            'actions'   =>  $actions,
            'permit'    =>  $permit,
            'id'        =>  $id,
            'descArray' =>  $descArray,
            'locArray'  =>  $locArray,
        ));
        
        
    }
}
