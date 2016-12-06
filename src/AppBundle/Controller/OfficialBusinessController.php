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
    
}