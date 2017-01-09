<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Photos;
use AppBundle\Entity\Dependents;
use AppBundle\Entity\Vehicles;
use AppBundle\Entity\Pets;
use AppBundle\Form\UserForm;
use AppBundle\Form\DependentsForm;
use AppBundle\Form\VehiclesForm;
use AppBundle\Form\PetsForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use AppBundle\Form\ChooseUsersPropertyForm;

class UserController extends Controller
{
    
    
    /**
     * @Route(
     *      "/private/user/edit/{id}", 
     *      name="editUserPrivate",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */         
    public function editAction(Request $request, $id){
        
    /*
     * TODO: YOU NEED TO PUT A CHECK IN HERE TO RESTRICT EDITS TO THE OWER OF THE ACCOUNT AND/OR THEIR SPOUSE ONLY
     */        
        
        $em = $this->getDoctrine()
                   ->getManager();
        $repository = $this->getDoctrine()->getRepository('AppBundle:User');
        $user = $repository->find($id);

        if (!$user && !$request->isMethod('POST')) {
            throw $this->createNotFoundException(
                    'No account found for id ' . $user->getId()
            );
        }
        
        //insert photos
        $originalPhotos = new ArrayCollection();

        // Create an ArrayCollection of the current Picture objects in the database
        foreach ($user->getPhotos() as $photo) {
            $originalPhotos->add($photo);
        }
        
        $form = $this->createForm(UserForm::class, $user);
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                
                // remove the relationship between the Picture and the User
                foreach ($originalPhotos as $photo) {
                    if (false === $user->getPhotos()->contains($photo)) {
                        // remove the User from the Photo
                        $photo->getPhotos()->removeElement($user);

                        // if it was a many-to-one relationship, remove the relationship like this
                        // $photo->setTask(null);

                        $em->persist($photo);

                        // if you wanted to delete the Photo entirely, you can also do that
                        // $em->remove($photo);
                    }
                }
                
                $em->flush();
                
                return $this->redirect($this->generateUrl('personalAccountShow', array(
                    'id'    => $user->getId(),
                )));
            }
            $em->refresh($user);
        }
        
        return $this->render('user/edit.html.twig', array(
            'user'      =>  $user, 
            'form'      =>  $form->createView(),
        ));
    }
    
}