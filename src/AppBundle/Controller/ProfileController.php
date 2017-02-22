<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace AppBundle\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;

/**
 * Description of ProfileController
 *
 * @author User
 */
class ProfileController extends Controller {
    
    /**
     * @Route("/public/profile/show/{id}/{propId}", name="showProfilePublic")
     */      
    public function showProfilePublicAction($id, $propId){
        $em = $this->getDoctrine()->getManager();
        $property = $em->getRepository('AppBundle:Property')->find($propId);
        $user = $em->getRepository('AppBundle:User')->find($id);
//        $profile = $user->getProfile();
        if(is_null($user->getProfile())){
            $profile = 'not set';
        }else{
            $profile = $user->getProfile();
        }
        return $this->render('profile/showProfilePublic.html.twig', array(
            'user'  => $user,
            'profile'   => $profile,
            'property' => $property
        )); 
    }
}
