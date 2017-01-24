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
    
    public function getLast(){
        //returns the ID of the latest meeting minutes to be uploaded - used for menu navigation
        $repository = $this->getDoctrine()->getRepository('AppBundle:Agenda');
        return $repository->getIdOfLast();
    }
    
    /**
     * @Route(
     *      "/admin/agenda/index", 
     *      name="indexAgendaAdmin",
     *      requirements={
     *     }
     * )
     */      
    public function indexAgendaAdminAction(){
        $repository = $this->getDoctrine()->getManager()->getRepository('AppBundle:Agenda');
        $agendas = $repository->findAll();
        $latestAgenda = $this->getLast();
        
        $agenda = new Agenda();
        
        $form = $this->createForm(AgendaForm::class, $agenda, array(
            'action' => $this->generateUrl('newAgendaAdmin', array(
            'method' => 'POST'
        ))));
        
        return $this->render('agenda/indexAgendaAdmin.html.twig', array(
            'agendas'   =>  $agendas,
            'latestAgenda'  =>  $latestAgenda,
            'form'  =>  $form->createView(),
        ));
    }
    
    /**
     * @Route(
     *      "/admin/agenda/edit/{id}", 
     *      name="editAgendaAdmin",
     *      requirements={
     *          "id": "\d+"
     *      }
     * )
     */     
    public function editAgendaAdminAction(Request $request, $id){
        $repository = $this->getDoctrine()->getRepository('AppBundle:Agenda');
        $agenda = $repository->find($id);
        
        if (!$agenda) {
            throw $this->createNotFoundException(
                'No agenda found for id '.$id
            );
        }
        
        $form = $this->createForm(AgendaForm::class, $agenda, array(
            'action' => $this->generateUrl('editAgendaAdmin', array(
            'id'    =>  $id,
            'method' => 'POST'
        ))));
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $agenda->setCreator($this->getUser());
                $em->persist($agenda);
                $em->flush();
                
                $this->addFlash(
                    'notice',
                    'Agenda has been successfully updated.'
                );
                
                return $this->redirect($this->generateUrl('showAgendaAdmin', array('id' => $agenda->getId())));
            }
        }
    }
    
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
                $em = $this->getDoctrine()->getManager();
                $agenda->setCreator($this->getUser());
                $em->persist($agenda);
                $em->flush();
                
                return $this->redirect($this->generateUrl('indexAgendaAdmin'));
            }
        }
        else{
            throw $this->createNotFoundException('The NEW action you triggered can only be a POST.  There is no NEW twig template.  New actions are created directly in the index action.');
        }
    }
    
    /**
     * @Route(
     *      "/protected/agenda/show/{year}", 
     *      name="showAgendaProtected",
     *      requirements={
     *          "year": "\d+",
     *          "route" : "\d+"
     *      }
     * )
     */       
    public function showAgendaProtectedAction($route, $year)
    {        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        $em = $this->getDoctrine()->getManager();
        $agenda = $em->getRepository('AppBundle:Agenda')->findOneBy(array('year' => $year));
        
        $minutes = $em->getRepository('AppBundle:Minutes')->getMinutesForYear($year);
        
        return $this->render('agenda/showAgendaProtected.html.twig', array(
            'year'      => $year,
            'route'     => $route,
            'agenda'    => $agenda, 
            'minutes'   => $minutes
        ));
    }    
    
    /**
     * @Route(
     *      "/admin/agenda/show/{id}", 
     *      name="showAgendaAdmin",
     *      requirements={
     *          "id": "\d+",
     *      }
     * )
     */       
    public function showAgendaAdminAction($id)
    {        
        $em = $this->getDoctrine()->getManager();
        $agenda = $em->getRepository('AppBundle:Agenda')->find($id);

        $form = $this->createForm(AgendaForm::class, $agenda, array(
            'action' => $this->generateUrl('editAgendaAdmin', array(
            'id'    =>  $id,
            'method' => 'POST'
        ))));
        
        return $this->render('agenda/showAgendaAdmin.html.twig', array(
            'agenda'    => $agenda, 
            'form'  => $form->createView()
        ));
    }  
    
}
