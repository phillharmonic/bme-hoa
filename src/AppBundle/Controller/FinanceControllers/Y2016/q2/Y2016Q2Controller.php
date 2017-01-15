<?php

namespace AppBundle\Controller\FinanceControllers\Y2016\q2;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class Y2016Q2Controller extends Controller
{

/**
     * @Route(
     *      "/protected/finance/2016/q2/income-statement/show/", 
     *      name="showIncomeStatementQ22016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showIncomeStatementQ22016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q2/showIncomeStatementProtected.html.twig', array(
        ));
    }    

/**
     * @Route(
     *      "/protected/finance/2016/q2/balance-sheet/show/", 
     *      name="showBalanceSheetQ22016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showBalanceSheetQ22016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q2/showBalanceSheetProtected.html.twig', array(
        ));
    }    

/**
     * @Route(
     *      "/protected/finance/2016/q2/AR/show/", 
     *      name="showArQ22016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showArQ22016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q2/showArProtected.html.twig', array(
        ));
    }    

/**
     * @Route(
     *      "/protected/finance/2016/q2/AP/show/", 
     *      name="showApQ22016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showApQ22016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q2/showApProtected.html.twig', array(
        ));
    }        
    
}