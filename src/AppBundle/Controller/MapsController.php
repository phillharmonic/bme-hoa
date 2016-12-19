<?php

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

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
    
    /**
     * @Route("/maps/bme-districts-map-pdf", name="bme-districts-map-pdf")
     */
    public function pdfBmeDistrictsMapAction(){
        return new BinaryFileResponse('bundles/main/files/bme-districts.pdf');
    }          
    
}