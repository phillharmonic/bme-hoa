<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;


class LegalController extends Controller
{
    
    /**
     * @Route("/legal/original_ccrs", name="legalOriginalCCRs")
     */
    public function ccrsAction(){
        return $this->render('legal/ccrs.html.twig');
    }
    
    /**
     * @Route("/legal/code_of_regs", name="legalCodeOfRegs")
     */
    public function codeOfRegulationsAction(){
        return $this->render('legal/codeOfRegulations.html.twig');
    }
    
    /**
     * @Route("/legal/contract_garden_and_landscape", name="contractGardenLandscape")
     */
    public function contractGardenLandscapeAction(){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/WINNSCAPES.pdf');
    }
    
    /**
     * @Route("/legal/contract_lawncare", name="contractLawncare")
     */
    public function contractLawncareAction(){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/CREATIVE.pdf');
    }
    
    /**
     * @Route("/legal/contract_pond_maintenance", name="contractPondMaint")
     */
    public function contractPondMaintAction(){
        return new BinaryFileResponse('bundles/main/files/brandymilllegaldocscontracts/AUQADOC.pdf');
    }
    
    /**
     * @Route("/legal/contract_sbs_management", name="contractSBSManagement")
     */
    public function contractSbsAction(){
        return $this->render('legal/contractSBSManagement.html.twig');
    }
    
    /**
     * @Route("/legal/current_ccrs", name="legalCurrentCCRs")
     */
    public function currentCcrsAction(){
        return $this->render('legal/currentccrs.html.twig');
    }
    
    /**
     * @Route("/legal", name="legalHome")
     */
    public function indexAction()
    {
        return $this->render('legal/index.html.twig', array(
        ));        
    }
    
    /**
     * @Route("/legal/first_amendment", name="legalFirstAmendment")
     */
    public function firstAmendmentAction(){
        return $this->render('legal/firstAmendment.html.twig');
    }
    
    /**
     * @Route("/legal/fourth_amendment", name="legalFourthAmendment")
     */    
    public function fourthAmendmentAction(){
        return $this->render('legal/fourthAmendment.html.twig');
    }
    
    /**
     * @Route("/legal/second_amendment", name="legalSecondAmendment")
     */    
    public function secondAmendmentAction(){
        return $this->render('legal/secondAmendment.html.twig');
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
    
    /**
     * @Route("/legal/third_amendment", name="legalThirdAmendment")
     */
    public function thirdAmendmentAction(){
        return $this->render('legal/thirdAmendment.html.twig');
    }
    
}