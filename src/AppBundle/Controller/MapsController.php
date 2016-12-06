<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class MapsController extends Controller
{
   
    /**
     * @Route(
     *      "/maps/show/", 
     *      name="mapsShow"
     * )
     */       
    public function showAction()
    {
        return $this->render('maps/show.html.twig', array(
        ));
    }
    
}