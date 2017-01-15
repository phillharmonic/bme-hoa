<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Comment;
use AppBundle\Form\CommentForm;


class CommentController extends Controller{
    
    /**
     * @Route(
     *      "/protected/comment/new/{id}", 
     *      name="newCommentProtected",
     *      requirements={
     *          "id": "\d+"
     *     }
     * )
     */      
    public function newCommentProtectedAction(Request $request, $id){
        
        if (!$this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_FULLY')) {
            throw $this->createAccessDeniedException();
        }
        
        $blog = $this->getBlog($id);
        $comment = new Comment();
        $comment->setBlog($blog);
        
        $form = $this->createForm(CommentForm::class, $comment, array(
            'action' => $this->generateUrl('newCommentProtected', array('id' => $id) ),
            'method' => 'POST',
        ));
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                $em = $this->getDoctrine()->getManager();
                $comment->setUser($this->getUser());
                $comment->setBlog($blog);
                $em->persist($comment);
                $em->flush();
                
                $this->addFlash(
                    'notice',
                    'Your COMMENT was successfully posted.'
                );
                
                return $this->redirect($this->generateUrl('home'));
            }
        }
        
        
        return $this->render('comment/newCommentProtected.html.twig', array(
            'form'  =>  $form->createView(),
            'blog'  =>  $blog,
        ));
    }
    
    protected function getBlog($id)
    {
        $em = $this->getDoctrine()->getManager();
        $blog = $em->getRepository('AppBundle:Blog')->find($id);
        
        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }

        return $blog;
    }
    
}
