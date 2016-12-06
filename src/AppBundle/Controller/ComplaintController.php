<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Complaint;
use AppBundle\Form\ComplaintForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Doctrine\Common\Collections\ArrayCollection;

class ComplaintController extends Controller
{
    
    /**
     * @Route(
     *      "/complaint/new", 
     *      name="complaintNew",
     * )
     */       
    public function newAction(Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $complaint = new Complaint();
        $form = $this->createForm(ComplaintForm::class, $complaint, array(
            'action' => $this->generateUrl('complaintNew'),
            'method' => 'POST',
        ));
//        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);
//
            if ($form->isValid()) {
                $complaint->setUser($this->get('security.context')->getToken()->getUser());
//                $em->persist($account);
//                $em->flush();
//                return $this->redirect($this->generateUrl('MainBundle_Admin_Account_Index', array(
//                )));
            }
        }
        
        return $this->render('complaint/new.html.twig', array(
             'form'  =>  $form->createView(),
        ));
    }
    
//    public function indexAction()
//    {
//        $em = $this->getDoctrine()->getEntityManager();
//        $accounts = $em->getRepository('MainBundle:Account')->findAll();
//        
//        return $this->render('MainBundle:Accounting:index.html.twig', array(
//            'accounts' => $accounts
//        ));
//    }
//    
//    public function showAction($id)
//    {
//        $em = $this->getDoctrine()->getEntityManager();
//        $account = $em->getRepository('MainBundle:Account')->findOneBy(array('id' => $id));
//        
//        return $this->render('MainBundle:Accounting:show.html.twig', array(
//            'account' => $account
//        ));
//    }
    
}