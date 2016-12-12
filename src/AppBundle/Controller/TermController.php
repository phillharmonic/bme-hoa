<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Photos;
use AppBundle\Entity\Term;
use AppBundle\Form\TermForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class TermController extends Controller
{
    
    /**
     * @Route(
     *      "/board-of-directors/show", 
     *      name="boardOfDirectorsShow",
     *      requirements={
     *     }
     * )
     */      
    public function boardShowAction(){
        
        $user = $this->getUser();
        $directors = null;
        
        $em = $this->getDoctrine()->getManager();
        $bods = $em->getRepository('AppBundle:User')->getCurrentBoard();
        
        return $this->render('term/boardShow.html.twig', array(
            'directors'      => $directors,
            'bods'       =>  $bods,
            'user'  =>  $user
        ));
        
    }    
    
    /**
     * @Route(
     *      "/trustee/term/show/{id}", 
     *      name="trusteeTermShow",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */      
    public function showAction($id){
        $user = $this->getUser();
        if (!$user) {
            throw $this->createNotFoundException('Unable to find specified term.');
        }
        return $this->render('term/show.html.twig', array(
            'terms'      => $user->getTerm(),
            'user'       => $user
        ));
        
    }
    
    /**
     * @Route(
     *      "/trustee/term/new", 
     *      name="trusteeTermNew",
     *      requirements={
     *     }
     * )
     */      
    public function newAction(Request $request){
        $term = new Term();
        $photo = new Photos();
//        $term->getPhotos()->add($photo);
        $term->addPhoto($photo);
        $user = $this->getUser();
        
        if (!$user && !$request->isMethod('POST')) {
            throw $this->createNotFoundException(
                    'No term found for id ' 
            );
        }
        
        //send the entity manager to the Form - so we can assign default choices for related data:
        $form = $this->createForm(TermForm::class, $term);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $user->addTerm($term);
                $term->setUser($user);
                !isset($photo)?:$em->persist($photo);
                $em->persist($term);
                $em->flush();

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('trusteeTermShow', array(
                    'id'    => $user->getId(),
                )));
        }}  

        return $this->render('term/new.html.twig', array(
            'form' => $form->createView() 
        ));
        
    }
    
/**
     * @Route(
     *      "/trustee/term/edit/{id}", 
     *      name="trusteeTermEdit",
     *      requirements={
     *          "id": "\d+"
     *     }
     * )
     */      
    public function editAction(Request $request){
//        $term = new Term();
//        $photo = new Photos();
////        $term->getPhotos()->add($photo);
//        $term->addPhoto($photo);
//        $user = $this->getUser();
//        
//        if (!$user && !$request->isMethod('POST')) {
//            throw $this->createNotFoundException(
//                    'No term found for id ' 
//            );
//        }
//        
//        //send the entity manager to the Form - so we can assign default choices for related data:
//        $form = $this->createForm(TermForm::class, $term);
//
//        if ($request->getMethod() == 'POST') {
//            $form->handleRequest($request);
//            if ($form->isValid()) {
//                $em = $this->getDoctrine()->getManager();
//                $user->addTerm($term);
//                $term->setUser($user);
//                !isset($photo)?:$em->persist($photo);
//                $em->persist($term);
//                $em->flush();
//
//                // Redirect - This is important to prevent users re-posting
//                // the form if they refresh the page
//                return $this->redirect($this->generateUrl('trusteeTermShow', array(
//                    'id'    => $user->getId(),
//                )));
//        }}  

        return $this->render('term/edit.html.twig', array(
//            'form' => $form->createView() 
        ));
        
    }    
    
}