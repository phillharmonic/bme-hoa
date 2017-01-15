<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Agenda;
use AppBundle\Form\AgendaForm;

/**
 * Description of ActionController
 *
 * @author User
 */
class AgendaController extends Controller{
    
    /**
     * @Route(
     *      "/admin/agenda/new", 
     *      name="newAgendaAdmin",
     *      requirements={
     *     }
     * )
     */      
    public function newAgendaAdminAction(Request $request){
        $agenda = new Agenda();
        
        $form = $this->createForm(AgendaForm::class, $agenda, array(
            'action' => $this->generateUrl('newAgendaAdmin', array(
            'method' => 'POST'
        ))));
        
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
        
        return $this->render('agenda/newAgendaAdmin.html.twig', array(
            'form'      =>  $form->createView(),
        ));
        
        
    }
}
