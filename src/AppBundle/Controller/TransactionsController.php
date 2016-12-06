<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Transactions;
use AppBundle\Form\TransactionsForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Doctrine\Common\Collections\ArrayCollection;

class TransactionsController extends Controller
{
    
    /**
     * @Route(
     *      "/admin/transactions/new", 
     *      name="adminTransactionsNew",
     * )
     */      
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $transaction = new Transactions();
        $form = $this->createForm(TransactionsForm::class, $transaction, array(
            'action' => $this->generateUrl('adminTransactionsNew'),
            'method' => 'POST',
        ));
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em->persist($transaction);
                $em->flush();
                return $this->redirect($this->generateUrl('adminTransactionsIndex', array(
                )));
            }
        }
        
        return $this->render('transactions/new.html.twig', array(
             'form'  =>  $form->createView(),
        ));
    }
    
    /**
     * @Route(
     *      "/admin/transactions/index", 
     *      name="adminTransactionsIndex",
     * )
     */  
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();
        $transactions = $em->getRepository('AppBundle:Transactions')->findAll();
        
        return $this->render('transactions/index.html.twig', array(
            'transactions' => $transactions
        ));
    }
    
    
    /**
     * @Route(
     *      "/admin/transactions/show/{id}", 
     *      name="adminTransactionsShow",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */       
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $transaction = $em->getRepository('AppBundle:Transactions')->findOneBy(array('id' => $id));
        
        return $this->render('transactions/show.html.twig', array(
            'transaction' => $transaction
        ));
    }
    
    /**
     * @Route(
     *      "/admin/account/transactions/{id}", 
     *      name="adminAccountTransactions",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */    
    public function accountTransactionsAction($id){
        $em = $this->getDoctrine()->getManager();
        $account = $em->getRepository('AppBundle:Account')->findOneBy(array('id' => $id));
        $transactions = $em->getRepository('AppBundle:Transactions')->getAccountTransactions($id);
        
        return $this->render('transactions/accountTransactions.html.twig', array(
            'account'   => $account,    'transactions'  => $transactions
        ));
    }
    
}