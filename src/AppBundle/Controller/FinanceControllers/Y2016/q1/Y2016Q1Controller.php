<?php

namespace AppBundle\Controller\FinanceControllers\Y2016\q1;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class Y2016Q1Controller extends Controller
{
    
/**
     * @Route(
     *      "/protected/finance/2016/q1/income-statement/show/", 
     *      name="showIncomeStatementQ12016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showIncomeStatementQ12016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q1/showIncomeStatementProtected.html.twig', array(
        ));
    }    

/**
     * @Route(
     *      "/protected/finance/2016/q1/balance-sheet/show/", 
     *      name="showBalanceSheetQ12016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showBalanceSheetQ12016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q1/showBalanceSheetProtected.html.twig', array(
        ));
    }    

/**
     * @Route(
     *      "/protected/finance/2016/q1/AR/show/", 
     *      name="showArQ12016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showArQ12016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q1/showArProtected.html.twig', array(
        ));
    }    

/**
     * @Route(
     *      "/protected/finance/2016/q1/AP/show/", 
     *      name="showApQ12016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showApQ12016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q1/showApProtected.html.twig', array(
        ));
    }        
    
}