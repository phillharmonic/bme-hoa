<?php

namespace AppBundle\Controller\FinanceControllers;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class FinanceController extends Controller
{
    
    /**
     * @Route(
     *      "/protected/finance/home/", 
     *      name="homeFinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function homeFinanceProtectedAction()
    {
        return $this->render('finance/homeFinanceProtected.html.twig', array(
        ));
    }    
    
}