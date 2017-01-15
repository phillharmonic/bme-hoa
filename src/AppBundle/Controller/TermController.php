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
     *      "/public/board/show", 
     *      name="showBoardPublic",
     *      requirements={
     *     }
     * )
     */      
    public function showBoardPublicAction(){
        
        $em = $this->getDoctrine()->getManager();
        $bods = $em->getRepository('AppBundle:User')->getCurrentBoard();
        
        return $this->render('term/showBoardPublic.html.twig', array(
            'bods'       =>  $bods,
        ));
        
    }    
    
    /**
     * @Route(
     *      "/private/board/show/{id}", 
     *      name="showBoardPrivate",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */      
    public function showBoardPrivateAction($id){
        $user = $this->getUser();
        if (!$user) {
            throw $this->createNotFoundException('Unable to find specified term.');
        }
        return $this->render('term/showBoardPrivate.html.twig', array(
            'terms'      => $user->getTerm(),
            'user'       => $user
        ));
        
    }
    
    /**
     * @Route(
     *      "/private/board/new", 
     *      name="newBoardPrivate",
     *      requirements={
     *     }
     * )
     */      
    public function newBoardPrivatection(Request $request){
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
                return $this->redirect($this->generateUrl('showBoardPrivate', array(
                    'id'    => $user->getId(),
                )));
        }}  

        return $this->render('term/newBoardPrivate.html.twig', array(
            'form' => $form->createView() 
        ));
        
    }
    
/**
     * @Route(
     *      "/private/board/edit/{id}", 
     *      name="editBoardPrivate",
     *      requirements={
     *          "id": "\d+"
     *     }
     * )
     */      
    public function editBoardPrivateAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $term = $em->getRepository('AppBundle:Term')->find($id);
//        $photo = new Photos();
//        $term->getPhotos()->add($photo);
//        $term->addPhoto($photo);
        $user = $this->getUser();
        
        if (!$user && !$request->isMethod('POST')) {
            throw $this->createNotFoundException(
                    'No term found for id ' 
            );
        }
//        
//        //send the entity manager to the Form - so we can assign default choices for related data:
        $form = $this->createForm(TermForm::class, $term);
//
//        if ($request->getMethod() == 'POST') {
//            $form->handleRequest($request);
//            if ($form->isValid()) {
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

        return $this->render('term/editBoardPrivate.html.twig', array(
            'form' => $form->createView() 
        ));
        
    }    
    
}