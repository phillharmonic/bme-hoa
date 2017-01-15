<?php

namespace AppBundle\Controller\FinanceControllers\Y2016\q3;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class Y2016Q3Controller extends Controller
{

/**
     * @Route(
     *      "/protected/finance/2016/q3/income-statement/show/", 
     *      name="showIncomeStatementQ32016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showIncomeStatementQ32016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q3/showIncomeStatementProtected.html.twig', array(
        ));
    }    

/**
     * @Route(
     *      "/protected/finance/2016/q3/balance-sheet/show/", 
     *      name="showBalanceSheetQ32016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showBalanceSheetQ32016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q3/showBalanceSheetProtected.html.twig', array(
        ));
    }    

/**
     * @Route(
     *      "/protected/finance/2016/q3/AR/show/", 
     *      name="showArQ32016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showArQ32016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q3/showArProtected.html.twig', array(
        ));
    }    

/**
     * @Route(
     *      "/protected/finance/2016/q3/AP/show/", 
     *      name="showApQ32016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showApQ32016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q3/showApProtected.html.twig', array(
        ));
    }        
    
}