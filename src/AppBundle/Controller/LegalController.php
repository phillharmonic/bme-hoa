<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;


class LegalController extends Controller
{
    public function legalSubmenuAction($route){
        return $this->render('sidebars/legalSidebar.html.twig', array(
            'route' => $route,
        ));
    }
    /**
     * @Route("/public/legal/original-restrictions", name="originalRestrictionsLegalPublic")
     */
    public function originalRestrictionsLegalPublicAction(Request $request){
        return $this->render('legal/originalRestrictionsLegalPublic.html.twig', array(
            'route'    =>  $request->attributes->get('_route'),
        ));        
    }
    
    /**
     * @Route("/public/legal/regulations", name="regulationsLegalPublic")
     */
    public function regulationsLegalPublicAction(Request $request){
        return $this->render('legal/regulationsLegalPublic.html.twig', array(
            'route'    =>  $request->attributes->get('_route'),
        ));        
    }
    
    /**
     * @Route("/public/legal/landscape", name="landscapingLegalPublic")
     */
    public function landscapingLegalPublicAction(Request $request){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/WINNSCAPES.pdf');
    }
    
    /**
     * @Route("/public/legal/lawncare", name="lawncareLegalPublic")
     */
    public function lawncareLegalPublicAction(Request $request){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/CREATIVE.pdf');
    }
    
    /**
     * @Route("/public/legal/ponds", name="pondsLegalPublic")
     */
    public function pondsLegalPublicAction(Request $request){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/AUQADOC.pdf');
    }
    
    /**
     * @Route("/public/legal/management", name="managementLegalPublic")
     */
    public function managementLegalPublicAction(Request $request){
        return $this->render('legal/managementLegalPublic.html.twig', array(
            'route'    =>  $request->attributes->get('_route'),
        ));        
    }
    
    /**
     * @Route("/public/legal/current-restrictions", name="currentRestrictionsLegalPublic")
     */
    public function currentRestrictionsLegalPublicAction(Request $request){
        return $this->render('legal/currentRestrictionsLegalPublic.html.twig', array(
            'route'    =>  $request->attributes->get('_route'),
        ));        
    }
    
    /**
     * @Route("/public/legal/home", name="homeLegalPublic")
     */
    public function homeLegalPublicAction(Request $request)
    {
        return $this->render('legal/homeLegalPublic.html.twig', array(
            'route'    =>  $request->attributes->get('_route'),
        ));        
    }
    
    
    /**
     * @Route("/public/legal/amendment-1", name="amendment1LegalPublic")
     */
    public function amendment1LegalPublicAction(Request $request){
        return $this->render('legal/amendment-1.html.twig', array(
            'route'    =>  $request->attributes->get('_route'),
        ));        
    }    
    /**
     * @Route("/public/legal/amendment-2", name="amendment2LegalPublic")
     */    
    public function amendment2LegalPublicAction(Request $request){
        return $this->render('legal/amendment-2.html.twig', array(
            'route'    =>  $request->attributes->get('_route'),
        ));        
    }
    
    /**
     * @Route("/public/legal/amendment-3", name="amendment3LegalPublic")
     */
    public function amendment3LegalPublicAction(Request $request){
        return $this->render('legal/amendment-3.html.twig', array(
            'route'    =>  $request->attributes->get('_route'),
        ));        
    }
    
    /**
     * @Route("/public/legal/amendment-4", name="amendment4LegalPublic")
     */    
    public function amendment4LegalPublicAction(Request $request){
        
        return $this->render('legal/amendment-4.html.twig', array(
            'route'    =>  $request->attributes->get('_route'),
        ));
    }    
    
    /**
     * @Route("/legal/declarations_pdf", name="declarationsPDF")
     */
    public function servePDF_declarationsAction(){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/DECLARATIONS.pdf');
    }
    
    /**
     * @Route("/legal/code_of_regs_pdf", name="codeOfRegsPDF")
     */
    public function servePDF_codeOfRegsAction(){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/CODEOFREGS.pdf');
    }
    
    /**
     * @Route("/legal/first_amendment_pdf", name="firstAmendmentPDF")
     */
    public function servePDF_1stAmendmentAction(){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/1STAMENDMENT.pdf');
    }
    
    
    /**
     * @Route("/legal/second_amendment_pdf", name="secondAmendmentPDF")
     */
    public function servePDF_2ndAmendmentAction(){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/2NDAMENDMENT.pdf');
    }
    
    /**
     * @Route("/legal/third_amendment_pdf", name="thirdAmendmentPDF")
     */
    public function servePDF_3rdAmendmentAction(){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/3RDAMENDMENT.pdf');
    }
    
    /**
     * @Route("/legal/fourth_amendment_pdf", name="fourthAmendmentPDF")
     */
    public function servePDF_4thAmendmentAction(){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/4THAMENDMENT.pdf');
    }
    
    /**
     * @Route("/legal/sbs_contract_pdf", name="sbsContract")
     */
    public function servePDF_sbsManagementAction(){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/SBSMGT.pdf');
    }
    

    
}