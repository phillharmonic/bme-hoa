<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Blog;
use AppBundle\Form\BlogForm;
use Symfony\Component\HttpFoundation\File\File;


class BlogController extends Controller{
    
    /**
     * @Route(
     *      "/admin/blog/new/", 
     *      name="newBlogAdmin",
     *      requirements={
     *     }
     * )
     */      
    public function newBlogAdminAction(Request $request){
        $em = $this->getDoctrine()->getManager ();
        $blog = new Blog();
        $form = $this->createForm(BlogForm::class, $blog, array(
            'action' => $this->generateUrl('newBlogAdmin'),
            'method' => 'POST',
        ));
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                //handle the file upload
                    $file = $blog->getImage();
                    // Generate a unique name for the file before saving it
                    $fileName = md5(uniqid()).'.'.$file->guessExtension();
                    // Move the file to the directory where brochures are stored
                    $file->move(
                        $this->getParameter('blog_images'),
                        $fileName
                    );
                    
                $blog->setUser($this->getUser());
                $blog->setImage($fileName);
                $em->persist($blog);
                $em->flush();
                
                $this->addFlash(
                    'notice',
                    'Your Blog Post was successfully posted.'
                );
                
                return $this->redirect($this->generateUrl('indexBlogPublic'));
            }
        }
        
        
        return $this->render('blog/newBlogAdmin.html.twig', array(
            'form'  =>  $form->createView(),
        ));
    }
    
    /**
     * @Route(
     *      "/admin/blog/edit/{id}", 
     *      name="editBlogAdmin",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */      
    public function editBlogAdminAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager ();
        $blog = $em->getRepository('AppBundle:Blog')->find($id);
        $blog->setImage(new File($this->getParameter('blog_images')."/".$blog->getImage()));
        $form = $this->createForm(BlogForm::class, $blog, array(
            'action' => $this->generateUrl('editBlogAdmin', array('id' => $id)),
            'method' => 'POST',
        ));
        
        $user = $this->getUser();
        
        if (!$user && !$request->isMethod('POST')) {
            throw $this->createNotFoundException(
                    'No blog post found for id ' 
            );
        }
        
        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);

            if ($form->isValid()) {
                //handle the file upload
                    $file = $blog->getImage();
                    // Generate a unique name for the file before saving it
                    $fileName = md5(uniqid()).'.'.$file->guessExtension();
                    // Move the file to the directory where brochures are stored
                    $file->move(
                        $this->getParameter('blog_images'),
                        $fileName
                    );
                    
                $blog->setImage($fileName);
                $blog->setUser($blog->getUser());                
                $em->persist($blog);
                $em->flush();
                
                $this->addFlash(
                    'notice',
                    'Your Blog Post was successfully posted.'
                );
                
                return $this->redirect($this->generateUrl('exp'));
            }
        }
        
        
        return $this->render('blog/editBlogAdmin.html.twig', array(
            'form'  =>  $form->createView(),
            'blog'   => $blog,
        ));
    }
    
    /**
     * @Route(
     *      "/public/blog/show/{id}", 
     *      name="showBlogPublic",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */      
    public function showBlogPublicAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager ();
        $blog = $em->getRepository('AppBundle:Blog')->find($id);
        
        $blogTags = $blog->getTags();
        $tags = explode(", ", $blogTags);
        
        if (!$blog) {
            throw $this->createNotFoundException('Unable to find Blog post.');
        }
        
        $comments = $em->getRepository('AppBundle:Comment')->getCommentsForBlog($blog->getId());
        
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $comments, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            10/*limit per page*/
        );
        
        return $this->render('blog/showBlogPublic.html.twig', compact('blog', 'tags', 'pagination'));

    }
    
    /**
     * @Route(
     *      "/home/", 
     *      name="home",
     *      requirements={
     *     }
     * )
     */      
    public function indexBlogPublicAction(Request $request){
        $em = $this->getDoctrine()->getManager ();
        $posts = $em->getRepository('AppBundle:Blog')->getAllSorted();
        $paginator  = $this->get('knp_paginator');
        $pagination = $paginator->paginate(
            $posts, /* query NOT result */
            $request->query->getInt('page', 1)/*page number*/,
            3/*limit per page*/
        );
        return $this->render('blog/indexBlogPublic.html.twig', compact('posts', 'pagination'));
    }
}
