<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class OfficialBusinessController extends Controller
{
   
    /**
     * @Route(
     *      "/official-business/show/", 
     *      name="officialBusinessShow"
     * )
     */       
    public function showAction()
    {
        return $this->render('officialBusiness/show.html.twig', array(
        ));
    }
    
    /**
     * @Route(
     *      "/protected/minutes/show/", 
     *      name="showMinutesProtected"
     * )
     */       
    public function showMinutesProtectedAction()
    {
        return $this->render('officialBusiness/showMinutesProtected.html.twig', array(
            
        ));
    }
    
    /**
     * @Route(
     *      "/protected/agenda/show/", 
     *      name="showAgendaProtected"
     * )
     */       
    public function showAgendaProtectedAction()
    {
        return $this->render('officialBusiness/showAgendaProtected.html.twig', array(
            
        ));
    }
    
}