<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class LegalController extends Controller
{
    
    /**
     * @Route("/public/legal/original-restrictions", name="originalRestrictionsLegalPublic")
     */
    public function originalRestrictionsLegalPublicAction(){
        return $this->render('legal/originalRestrictionsLegalPublic.html.twig');
    }
    
    /**
     * @Route("/public/legal/regulations", name="regulationsLegalPublic")
     */
    public function regulationsLegalPublicAction(){
        return $this->render('legal/regulationsLegalPublic.html.twig');
    }
    
    /**
     * @Route("/public/legal/landscape", name="landscapingLegalPublic")
     */
    public function landscapingLegalPublicAction(){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/WINNSCAPES.pdf');
    }
    
    /**
     * @Route("/public/legal/lawncare", name="lawncareLegalPublic")
     */
    public function lawncareLegalPublicAction(){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/CREATIVE.pdf');
    }
    
    /**
     * @Route("/public/legal/ponds", name="pondsLegalPublic")
     */
    public function pondsLegalPublicAction(){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/AUQADOC.pdf');
    }
    
    /**
     * @Route("/public/legal/management", name="managementLegalPublic")
     */
    public function managementLegalPublicAction(){
        return $this->render('legal/managementLegalPublic.html.twig');
    }
    
    /**
     * @Route("/public/legal/current-restrictions", name="currentRestrictionsLegalPublic")
     */
    public function currentRestrictionsLegalPublicAction(){
        return $this->render('legal/currentRestrictionsLegalPublic.html.twig');
    }
    
    /**
     * @Route("/public/legal/home", name="homeLegalPublic")
     */
    public function homeLegalPublicAction()
    {
        return $this->render('legal/homeLegalPublic.html.twig', array(
        ));        
    }
    
    
    /**
     * @Route("/public/legal/amendment-1", name="amendment1LegalPublic")
     */
    public function amendment1LegalPublicAction(){
        return $this->render('legal/amendment-1.html.twig');
    }    
    /**
     * @Route("/public/legal/amendment-2", name="amendment2LegalPublic")
     */    
    public function amendment2LegalPublicAction(){
        return $this->render('legal/amendment-2.html.twig');
    }
    
    /**
     * @Route("/public/legal/amendment-3", name="amendment3LegalPublic")
     */
    public function amendment3LegalPublicAction(){
        return $this->render('legal/amendment-3.html.twig');
    }
    
    /**
     * @Route("/public/legal/amendment-4", name="amendment4LegalPublic")
     */    
    public function amendment4LegalPublicAction(){
        return $this->render('legal/amendment-4.html.twig');
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