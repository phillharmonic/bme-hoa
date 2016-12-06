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

class AccountController extends Controller
{
    
    public function addDependentAction(Request $request){
        $dependent = new Dependents();
        $photo = new Photos();
        $dependent->getPhotos()->add($photo);
        $user = $this->getUser();
        //send the entity manager to the Form - so we can assign default choices for related data:
        $form = $this->createForm(new DependentsForm($this->getDoctrine()->getManager()), $dependent);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $user->addDependent($dependent);
                $dependent->setUser($user);
                !isset($photo)?:$em->persist($photo);
                $em->persist($dependent);
                $em->flush();

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('MainBundle_Account_Show', array(
                    'id'    => $user->getId(),
                )));
        }}  

        return $this->render('MainBundle:Account:addDependent.html.twig' , array(
            'form' => $form->createView()
        ));
    }
        
    public function addPetAction(Request $request){
        $pet = new Pets();
        $photo = new Photos();
        $pet->getPhotos()->add($photo);
        $user = $this->getUser();
        //send the entity manager to the Form - so we can assign default choices for related data:
        $form = $this->createForm(new PetsForm($this->getDoctrine()->getManager()), $pet);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $user->addPet($pet);
                $pet->setUser($user);
                !isset($photo)?:$em->persist($photo);
                $em->persist($pet);
                $em->flush();

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('MainBundle_Account_Show', array(
                    'id'    => $user->getId(),
                )));
        }}  

        return $this->render('MainBundle:Account:addPet.html.twig' , array(
            'form' => $form->createView()
        ));
    }
    
    public function addVehicleAction(Request $request){
        $vehicle = new Vehicles();
        $photo = new Photos();
        $vehicle->getPhotos()->add($photo);
        $user = $this->getUser();
        //send the entity manager to the Form - so we can assign default choices for related data:
        $form = $this->createForm(new VehiclesForm($this->getDoctrine()->getManager()), $vehicle);

        if ($request->getMethod() == 'POST') {
            $form->handleRequest($request);
            if ($form->isValid()) {
                $em = $this->getDoctrine()->getEntityManager();
                $user->addVehicle($vehicle);
                $vehicle->setUser($user);
                !isset($photo)?:$em->persist($photo);
                $em->persist($vehicle);
                $em->flush();

                // Redirect - This is important to prevent users re-posting
                // the form if they refresh the page
                return $this->redirect($this->generateUrl('MainBundle_Account_Show', array(
                    'id'    => $user->getId(),
                )));
        }}  

        return $this->render('MainBundle:Account:addVehicle.html.twig' , array(
            'form' => $form->createView()
        ));
    }
    
    public function indexAction()
    {
        $user = $this->getUser();
        if (!$user) {
            throw $this->createNotFoundException('Unable to find specified user.');
        }
        return $this->render('MainBundle:Account:index.html.twig', array(
        'user'     =>  $user));
    }
    
    /**
     * @Route(
     *      "/personal/account/choose-property/{id}", 
     *      name="personalAccountChooseProperty",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */          
    public function chooseUsersProperty(Request $request, $id){
        $user = $this->getUser();
        if (!$user) {
            throw $this->createNotFoundException('Unable to find specified user.');
        }
        
        $result = "It works!";
        $em = $this->getDoctrine()->getManager();
//        $form = $this->createForm(ChooseUsersPropertyForm::class, $user);
        
        if ($request->isMethod('POST')) {
            $form->handleRequest($request);

            if ($form->isValid()) {
                
                $em->flush();
                return $this->redirect($this->generateUrl('personalAccountShow', array(
                    'id'    => $id
                )));
            }
        }
        
        return $this->render('account/chooseUsersProperty.html.twig', array(
            'result'    =>  $result,
//            'form'      =>  $form->createView(),
        ));
        
    }
    
    /**
     * @Route(
     *      "/personal/account/show/{id}", 
     *      name="personalAccountShow",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */      
    public function showAction($id){
        $user = $this->getUser();
        if (!$user) {
            throw $this->createNotFoundException('Unable to find specified user.');
        }
//        
//        this is the old account page.  It is crap.  The admin details were much better
//        
//        $em = $this->getDoctrine()->getManager();
//        
//        $spouse = $em->getRepository('AppBundle:Dependents')->getUsersSpouse($user);
//        $dependents = $em->getRepository('AppBundle:Dependents')->getUsersDependents($user);
//        $vehicles = $em->getRepository('AppBundle:Vehicles')->getUsersVehicles($user);
//        $pets = $em->getRepository('AppBundle:Pets')->getUsersPets($user);
//        
//        return $this->render('account/show.html.twig', array(
//            'user'          =>  $user,
//            'dependents'    =>  $dependents,
//            'spouse'        =>  $spouse[0],
//            'vehicles'      =>  $vehicles,
//            'pets'          =>  $pets
//        ));
        
//        $user = $this->getUser();
        
        /*
         *  Okay, here's what's going on here: a user (homeowner) can potentially own more than one property... and the 
         *  website was designed with that in mind.  Therefore, when you try user->getProperty (which works) you are 
         *  getting an array result.  Before a user can view the details of their property, they will need to choose which 
         *  property they want to view.  
         * 
         *  Solution: before the showAction, we add a chooseProperty page which has the correct property
         *           
         */
        
        $em = $this->getDoctrine()->getManager();
        $usersProperty = $em->getRepository('AppBundle:Property')->getUsersProperty($user);
        $property = $em->getRepository('AppBundle:Property')->findOneBy(array('id' => $usersProperty[0]->getId()));
        
//        $resultProp =  $em->getRepository('AppBundle:Property')->findOneBy(array('id' => 2));//$em->getRepository('AppBundle:Property')->findOneBy(array('id' => $usersProperty[0]->getId()));
//        $userAccount = $user->getAccount();
//        $result = $userAccount->getProperty()[0]; //$em->getRepository('AppBundle:Account')->findOneBy(array('id' => $userAccount->getId()))->getProperty()->getStatus();
        // Residents of Property by Property Association & Vacate Date (not by user defined address):
        $currentOwners = new ArrayCollection();
        foreach($property->getUser() as $owner){
            if($owner->getVacateDate() == null){
                $currentOwners[] = $owner;
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
        
        return $this->render('account/show.html.twig', array(
//            'result'        => $result,
            'property'      => $property, 
            'currentOwners' => $currentOwners, 
            'depsCol'       => $dependents, 
            'pets'          => $pets,
            'vhcls'         => $vhcls, 
            'transactions'  => $transactions
        ));
        
    }
    
    public function editAction(Request $request){
        $em = $this->getDoctrine()
                   ->getEntityManager();
        $user = $this->getUser();
        if (!$user && !$request->isMethod('POST')) {
            throw $this->createNotFoundException(
                    'No aaccount found for id ' . $user->getId()
            );
        }
        
        //insert photos
        $originalPhotos = new ArrayCollection();

        // Create an ArrayCollection of the current Picture objects in the database
        foreach ($user->getPhotos() as $photo) {
            $originalPhotos->add($photo);
        }
        
        $form = $this->createForm(new UserForm($em), $user);
        
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
                
                return $this->redirect($this->generateUrl('MainBundle_Account_Show', array(
                    'id'    => $user->getId(),
                )));
            }
            $em->refresh($user);
        }
        
        return $this->render('MainBundle:Account:edit.html.twig', array(
            'user'      =>  $user, 
            'form'      =>  $form->createView(),
        ));
    }
    
}