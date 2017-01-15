<?php

namespace AppBundle\Controller\FinanceControllers\Y2016;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class Finance2016Controller extends Controller
{
    
    /**
     * @Route(
     *      "/protected/finance/2016/summary/show/", 
     *      name="showSummary2016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showSummary2016FinanceProtectedAction()
    {
        return $this->render('finance/2016/showSummary2016FinanceProtected.html.twig', array(
        ));
    }        
   
}