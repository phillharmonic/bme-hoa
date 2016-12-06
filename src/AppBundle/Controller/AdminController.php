<?php


namespace AppBundle\Controller;
//use MainBundle\Entity\User;
//use MainBundle\Entity\Photos;
//use MainBundle\Entity\Dependents;
use AppBundle\Form\PropertyForm;
use AppBundle\Form\AdminUserForm;
//use MainBundle\Form\DependentsForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{
    
    /**
     * @Route("/admin", name="admin")
     */    
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager ();
        $properties = $em->getRepository('AppBundle:Property')->findAll();
        
        return $this->render('admin/index.html.twig', array(
            'bmproperty'                => $properties,
            'springbrook_homeowners'    => $properties,
            'springflower_homeowners'   => $properties,
        ));
    }
    
    /**
     * @Route(
     *      "/admin/show/{id}", 
     *      name="adminShow",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */       
    public function showAction($id)
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
        $transactions = $em->getRepository('AppBundle:Transactions')->getAccountTransactions($currentOwners[0]->getAccount(), 365);
        
        return $this->render('admin/show.html.twig', array(
            'property'      => $property, 
            'currentOwners' => $currentOwners, 
            'depsCol'       => $dependents, 
            'pets'          => $pets,
            'vhcls'         => $vhcls, 
            'transactions'  => $transactions
        ));
    }
    
    /**
     * @Route(
     *      "/admin/propert/edit/{id}", 
     *      name="propertyEdit",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */       
    public function propertyEditAction(Request $request, $id)
    {
        //insert photos
        $originalPhotos = new ArrayCollection();
        
        $em = $this->getDoctrine()->getManager();
        $property = $em->getRepository('AppBundle:Property')->find($id);
        
        $originalUsers = new ArrayCollection();
        
        // Create an ArrayCollection of the current Picture objects in the database
        foreach ($property->getPhotos() as $photo) {
            $originalPhotos->add($photo);
        }
        
        $form = $this->createForm(PropertyForm::class, $property);
        
        // Create an ArrayCollection of the current user objects in the database
        foreach ($property->getUser() as $user) {
            $originalUsers->add($user);
        }
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                
                // remove the relationship between the Property and the User
                foreach ($originalUsers as $user) {
                    if (false === $property->getUser()->contains($user)) {
                        // remove the User from the Property
                        $property->getUser()->removeElement($user);
                        $em->persist($user);
                    }
                }
                // remove the relationship between the Property and the Picture
                foreach ($originalPhotos as $photo) {
                    if (false === $property->getPhotos()->contains($photo)) {
                        // remove the User from the Photo
                        $property->getPhotos()->removeElement($photo);

                        // if it was a many-to-one relationship, remove the relationship like this
                        // $photo->setTask(null);

                        $em->persist($photo);

                        // if you wanted to delete the Photo entirely, you can also do that
                        // $em->remove($photo);
                    }
                }
                $em->flush();
                return $this->redirect($this->generateUrl('adminShow', array(
                    'id'    => $id
                )));
            }
        }
        
        return $this->render('admin/propertyEdit.html.twig', array(
            'prop'  =>  $property,
            'form'  =>  $form->createView(),
        ));
    }
    
    public function rolesAction(){
        return $this->render('MainBundle:Admin:roles.html.twig', array(
        )); 
    }
    
    
    /**
     * @Route(
     *      "/admin/user/index", 
     *      name="adminUserIndex",
     * )
     */        
    public function usersIndexAction(){
        $em = $this->getDoctrine()->getManager();
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
        
        return $this->render('admin/usersIndex.html.twig', array(
            'currentUsers' =>  $currentUsers, 'formerUsers' => $formerUsers, 'unassignedUsers' => $unassignedUsers,
            'adminUsers' => $adminUsers, 
//            'roles'=>$roles
        ));
    }
    
    
    /**
     * @Route(
     *      "/admin/user/edit/{id}", 
     *      name="adminUserEdit",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */          
    public function editUserAction(Request $request, $id){
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
                    return $this->redirect($this->generateUrl('adminUserIndex', array(
                    )));
                    
                }
                
                $em->persist($user);
                $em->flush();
                
                return $this->redirect($this->generateUrl('adminUserIndex', array(
                )));
            }
            
        }
        
        return $this->render('admin/userEdit.html.twig', array(
            'form' =>  $form->createView(),
            'user' =>  $user
        ));
    }
}