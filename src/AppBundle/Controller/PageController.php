<?php

// src/AppBundle/Controller/LuckyController.php
namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use AppBundle\Entity\Enquiry;
use AppBundle\Entity\Complaint;
use AppBundle\Form\EnquiryForm;
use AppBundle\Form\ComplaintForm;
use Symfony\Component\HttpFoundation\Request;

class PageController extends Controller
{
    
    /**
     * @Route("/exp", name="exp")
     */
    public function expAction() 
    {
        return $this->render('pages/experiment.html.twig', array(
        ));
    }
    
    /**
     * @Route("/", name="home")
     */
    public function homeAction() 
    {
        $number = mt_rand(0, 100);
        
        return $this->render('pages/home.html.twig', array(
            'number' => $number,
        ));
        
    }
    
    /**
     * @Route("/test", name="test")
     */
    public function testAction() 
    {
        $str = "If you are interested in completing exterior improvements please be aware of the guidelines set by your Covenants and Deed Restrictions. For pre-approval and acceptance of your proposed improvements, please complete this form and submit to the management company for review. Upon verification that your proposed changes are within the guidelines of your Association, you will be notified, in writing, within 30 days of the receipt of your request at the management office. Your association account balance must be current and in good standing before an improvement will be approved.";
        
        $ar = str_split($str, 130);
        
        return $this->render('pages/test.twig', array(
            'var' => $ar,
        ));
        
    }

    /**
     * @Route("/contact", name="contact")
     */    
    public function contactAction(Request $request)
    {
        $enquiry = new Enquiry();
        $form = $this->createForm(EnquiryForm::class, $enquiry, array(
            'action' => $this->generateUrl('contact'),
            'method' => 'POST',
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $em->persist($enquiry);
                $em->flush();
                
                
                $message = \Swift_Message::newInstance();
                $message    ->setSubject($enquiry->getSubject())
                            ->setFrom($enquiry->getEmail())
                            ->setTo($this->container->getParameter('bmehoa.emails.contact_email'))
                            ->setBody(
                                $this->renderView(
                                    'emailTemplates/contactUs.html.twig',
                                    array('enquiry' => $enquiry)
                                ),
                                'text/html'
                            );
                $this->get('mailer')->send($message);
                
                $this->addFlash(
                    'notice',
                    'Your email was successfully sent.  Thank you!'
                );
                
                return $this->redirect($this->generateUrl('home'));
            }
        }

        return $this->render('pages/contact.html.twig', array(
             'form'  =>  $form->createView(),
        ));
    }    
       
    
    /**
     * @Route("/complaint/new", name="complaintNew")
     */    
    public function complaintAction(Request $request)
    {
        $complaint = new Complaint();
        $form = $this->createForm(ComplaintForm::class, $complaint, array(
            'action' => $this->generateUrl('complaintNew'),
            'method' => 'POST',
        ));

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                
                $em = $this->getDoctrine()->getManager();
                $complaint->setUser($this->getUser());
                $complaint->setAssignedTo('unassigned');
                $complaint->setIsResolved(0);
                $em->persist($complaint);
                $em->flush();
                
                
                $message = \Swift_Message::newInstance();
                $message    ->setSubject('New Complaint')
                            ->setFrom($this->getUser()->getEmail())
                            ->setTo($this->container->getParameter('bmehoa.emails.contact_email'))
                            ->setBody(
                                $this->renderView(
                                    'emailTemplates/complaint.html.twig',
                                    array('complaint' => $complaint)
                                ),
                                'text/html'
                            );
                $this->get('mailer')->send($message);
                
                $this->addFlash(
                    'notice',
                    'Your complaint was successfully submitted.  A response will be provided within 10 to 14 days.'
                );
                
                return $this->redirect($this->generateUrl('home'));
            }
        }

        return $this->render('pages/complaint.html.twig', array(
             'form'  =>  $form->createView(),
        ));
    }    
    
    public function footerAction(){
        return $this->render('pages/footer.html.twig', array(
        ));        
    }
}