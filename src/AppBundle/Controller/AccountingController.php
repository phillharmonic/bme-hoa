<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Account;
use AppBundle\Form\AccountForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AccountingController extends Controller
{
    
    
    /**
     * @Route(
     *      "/admin/accounting/new", 
     *      name="adminAccountingNew",
     * )
     */          
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $account = new Account();
        $form = $this->createForm(AccountForm::class, $account, array(
            'action' => $this->generateUrl('adminAccountingNew'),
            'method' => 'POST',
        ));
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->persist($account);
                $em->flush();
                return $this->redirect($this->generateUrl('adminAccountingIndex', array(
                )));
            }
        }
        
        return $this->render('accounting/new.html.twig', array(
             'form'  =>  $form->createView(),
        ));
    }
    
    
    /**
     * @Route("/admin/accounting/index", name="adminAccountingIndex")
     */        
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $accounts = $em->getRepository('AppBundle:Account')->findAll();
        
        return $this->render('accounting/index.html.twig', array(
            'accounts' => $accounts
        ));
    }
    
    /**
     * @Route(
     *      "/admin/accounting/show/{id}", 
     *      name="adminAccountingShow",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */       
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $account = $em->getRepository('AppBundle:Account')->findOneBy(array('id' => $id));
        
        return $this->render('accounting/show.html.twig', array(
            'account' => $account
        ));
    }
    
}