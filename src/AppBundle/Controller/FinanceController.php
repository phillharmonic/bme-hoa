<?php

namespace AppBundle\Controller;
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
        $fiscalYears = [2017, 2016, 2015, 2014, 2013];
        
        return $this->render('finance/homeFinanceProtected.html.twig', array(
            'fiscalYears' => $fiscalYears
        ));
    }    
    
    /**
     * @Route(
     *      "/protected/finance/{year}/index/", name="indexFinanceProtected"
     * )
     */       
    public function indexFinanceProtectedAction($year)
    {
        $fiscalYears = [2017, 2016, 2015, 2014, 2013];
        $quarters = [1, 2, 3, 4];
        
        return $this->render('finance/indexFinanceProtected.html.twig', array(
            'currentYear'   =>  $year,
            'fiscalYears'   => $fiscalYears,
            'quarters'      => $quarters
        ));
    }        
    
    /**
     * @Route(
     *      "/protected/finance/{year}/{quarter}/incomeStatement/", name="incomeStatementFinanceProtected"
     * )
     */       
    public function incomeStatementFinanceProtectedAction($year, $quarter)
    {
        $fiscalYears = [2017, 2016, 2015, 2014, 2013];
        $quarters = [1, 2, 3, 4];
        
        return $this->render('finance/incomeStatementFinanceProtected.html.twig', array(
            'currentYear'   =>  $year,
            'fiscalYears'   =>  $fiscalYears,
            'quarters'      =>  $quarters,
            'quarter'       =>  $quarter
        ));
    }     
    
    /**
     * @Route(
     *      "/protected/finance/{year}/{quarter}/balanceSheet/", name="balanceSheetFinanceProtected"
     * )
     */       
    public function balanceSheetFinanceProtectedAction($year, $quarter)
    {
        $fiscalYears = [2017, 2016, 2015, 2014, 2013];
        $quarters = [1, 2, 3, 4];
        
        return $this->render('finance/balanceSheetFinanceProtected.html.twig', array(
            'currentYear'   =>  $year,
            'fiscalYears'   =>  $fiscalYears,
            'quarters'      =>  $quarters,
            'quarter'       =>  $quarter
        ));
    }     
    
    /**
     * @Route(
     *      "/protected/finance/{year}/{quarter}/accountsReceivable/", name="accountsReceivableFinanceProtected"
     * )
     */       
    public function accountsReceivableFinanceProtectedAction($year, $quarter)
    {
        $fiscalYears = [2017, 2016, 2015, 2014, 2013];
        $quarters = [1, 2, 3, 4];
        
        return $this->render('finance/accountsReceivableFinanceProtected.html.twig', array(
            'currentYear'   =>  $year,
            'fiscalYears'   =>  $fiscalYears,
            'quarters'      =>  $quarters,
            'quarter'       =>  $quarter
        ));
    }     
    
    /**
     * @Route(
     *      "/protected/finance/{year}/{quarter}/accountsPayable/", name="accountsPayableFinanceProtected"
     * )
     */       
    public function accountsPayableFinanceProtectedAction($year, $quarter)
    {
        $fiscalYears = [2017, 2016, 2015, 2014, 2013];
        $quarters = [1, 2, 3, 4];
        
        return $this->render('finance/accountsPayableFinanceProtected.html.twig', array(
            'currentYear'   =>  $year,
            'fiscalYears'   =>  $fiscalYears,
            'quarters'      =>  $quarters,
            'quarter'       =>  $quarter
        ));
    }     
    
}