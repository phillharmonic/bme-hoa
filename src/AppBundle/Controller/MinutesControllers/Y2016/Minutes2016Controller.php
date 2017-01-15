<?php

namespace AppBundle\Controller\MinutesControllers\Y2016;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Symfony\Component\HttpFoundation\Request;


class Minutes2016Controller extends Controller{
    
    
    /**
     * @Route(
     *      "/protected/minutes/2016/agenda/show", 
     *      name="showAgenda2016Protected",
     *      requirements={
     *      }
     * )
     */       
    public function showAgenda2016ProtectedAction()
    {        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        return $this->render('minutes/2016/showAgenda2016Protected.html.twig', array(
            'year'  => '2016'
        ));
    }
    
    
}
