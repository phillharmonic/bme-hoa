<?php

namespace AppBundle\Controller\FinanceControllers\Y2016\q4;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class Y2016Q4Controller extends Controller
{

/**
     * @Route(
     *      "/protected/finance/2016/q4/income-statement/show/", 
     *      name="showIncomeStatementQ42016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showIncomeStatementQ42016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q4/showIncomeStatementProtected.html.twig', array(
        ));
    }    

/**
     * @Route(
     *      "/protected/finance/2016/q4/balance-sheet/show/", 
     *      name="showBalanceSheetQ42016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showBalanceSheetQ42016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q4/showBalanceSheetProtected.html.twig', array(
        ));
    }    

/**
     * @Route(
     *      "/protected/finance/2016/q4/AR/show/", 
     *      name="showArQ42016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showArQ42016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q4/showArProtected.html.twig', array(
        ));
    }    

/**
     * @Route(
     *      "/protected/finance/2016/q4/AP/show/", 
     *      name="showApQ42016FinanceProtected",
     *      requirements={
     *     }
     * )
     */       
    public function showApQ42016FinanceProtectedAction()
    {
        return $this->render('finance/2016/q4/showApProtected.html.twig', array(
        ));
    }        
    
}