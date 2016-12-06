<?php

// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PageController extends Controller
{
    /**
     * @Route("/", name="home")
     */
    public function homeAction() 
    {
        $number = mt_rand(0, 100);
        
        return $this->render('pages/home.html.twig', array(
            'number' => $number,
        ));
        
    }
    
    public function footerAction(){
        return $this->render('pages/footer.html.twig', array(
        ));        
    }
}