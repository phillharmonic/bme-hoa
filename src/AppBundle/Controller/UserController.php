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
use AppBundle\Form\AdminUserForm;

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
    
    /**
     * @Route(
     *      "/admin/user/index", 
     *      name="indexUserAdmin",
     * )
     */        
    public function indexUserAdminAction(){
        $em = $this->getDoctrine()->getManager();
        $users = $em->getRepository('AppBundle:User')->findAll();
        $currentUsers = $em->getRepository('AppBundle:User')->getAllCurrentHomeowners();
        $formerUsers = $em->getRepository('AppBundle:User')->getAllFormerHomeowners();
        $unassignedUsers = $em->getRepository('AppBundle:User')->getUnassignedUsers();
        $adminUsers = $em->getRepository('AppBundle:User')->getAdminUsers();
        
//        $roles = array();
//        $roles[] = 'ROLE_SUPER_ADMIN';
//        $roles[] = 'ROLE_ADMIN';
//        $roles[] = 'ROLE_TRUSTEE';
//        $roles[] = 'ROLE_MODERATOR';    
//        
//        $roles = implode(" ", $roles);
        
        return $this->render('user/indexUserAdmin.html.twig', array(
            'currentUsers' =>  $currentUsers, 'formerUsers' => $formerUsers, 'unassignedUsers' => $unassignedUsers,
            'adminUsers' => $adminUsers, 
            'users' => $users
//            'roles'=>$roles
        ));
    }
    
    
    /**
     * @Route(
     *      "/admin/user/edit/{id}", 
     *      name="editUserAdmin",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */          
    public function editUserAdminAction(Request $request, $id){
        $em = $this->getDoctrine()->getManager();
        $user = $em->getRepository('AppBundle:User')->find($id);
        $form = $this->createForm(AdminUserForm::class, $user);
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                
                //  if the checkbox 'expire user' is checked, do the following:
                if(!null == $form->get('expired')->getData()){
                    $user->setExpired(1);
                    $user->setExpiresAt(new \DateTime());
                    //  set credentials_expired to true
                    $user->setCredentialsExpired(1);
                    //  set credentials_expire_at to now()
                    $user->setCredentialsExpireAt(new \DateTime());
                    //  The user's account also needs to be expired:
                    $usersAccount = $user->getAccount();
                    //  set is_closed to true
                    $usersAccount->setIsClosed(1);
                    //  set closed_at to now()
                    $usersAccount->setClosedAt(new \DateTime());
                    
                    //unassign the user's property; can't.  There's no field for that.  It's based on vacate date.
                
                    $em->persist($usersAccount);
                    $em->persist($user);
                    $em->flush();
                    return $this->redirect($this->generateUrl('indexUserAdmin'));
                    
                }
                
                $em->persist($user);
                $em->flush();
                
                return $this->redirect($this->generateUrl('indexUserAdmin', array(
                )));
            }
            
        }
        
        return $this->render('user/editUserAdmin.html.twig', array(
            'form' =>  $form->createView(),
            'user' =>  $user
        ));
    }
    
    /**
     * @Route(
     *      "/admin/user/show/{id}", 
     *      name="showUserAdmin",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */       
    public function showUserAdminAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $property = $em->getRepository('AppBundle:Property')->findOneBy(array('id' => $id));
        // Residents of Property by Property Association & Vacate Date (not by user defined address):
        $currentOwners = new ArrayCollection();
        foreach($property->getUser() as $user){
            if($user->getVacateDate() == null){
                $currentOwners[] = $user;
            }
        }
        //dependents
        $dependents = $em->getRepository('AppBundle:Dependents')->getUniqueDependents($currentOwners);
        //pets
        $pets = $em->getRepository('AppBundle:Pets')->getUniquePets($currentOwners);
        //vehicles
        $vhcls = $em->getRepository('AppBundle:Vehicles')->getUniqueVehicles($currentOwners);
        //transactions (past 12 months)
        if(isset($currentOwners[0])){
            $transactions = $em->getRepository('AppBundle:Transactions')->getAccountTransactions($currentOwners[0]->getAccount(), 365);
        }else{
            $transactions = null;
        }
        
        return $this->render('user/showUserAdmin.html.twig', array(
            'property'      => $property, 
            'currentOwners' => $currentOwners, 
            'depsCol'       => $dependents, 
            'pets'          => $pets,
            'vhcls'         => $vhcls, 
            'transactions'  => $transactions
        ));
    }
    
}