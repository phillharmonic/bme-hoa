<?php

namespace AppBundle\Controller;

//use MainBundle\Entity\Property;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;

class PropertyController extends Controller
{
    
    /**
     * @Route("/public/properties/index", name="indexPropertiesPublic")
     */     
    public function indexPropertiesPublicAction()
    {
//        $em = $this->getDoctrine()
//                   ->getEntityManager();
//        $properties = $em->getRepository('MainBundle:Property')->findAll();
//        
//        return $this->render('MainBundle:Homeowners:index.html.twig', array(
//            'brandymill_homeowners'     => $properties,
//            'springbrook_homeowners'    => $properties,
//            'springflower_homeowners'   => $properties,
//        ));
        
//        $brandymillHomeowners = $em->createQueryBuilder()
//                    ->select('u')
//                    ->from('AppBundle:User',  'u')
//                    ->where('u.street = ?1')
//                    ->andWhere('u.vacate_date IS NULL')
//                    ->addOrderBy('u.housenumber', 'ASC')
//                    ->setParameter(1, 'Brandy Mill Drive')
//                    ->getQuery()
//                    ->getResult();
        
//        $springbrookHomeowners = $em->createQueryBuilder()
//                    ->select('u')
//                    ->from('AppBundle:User',  'u')
//                    ->where('u.street = ?1')
//                    ->andWhere('u.vacate_date IS NULL')
//                    ->addOrderBy('u.housenumber', 'ASC')
//                    ->setParameter(1, 'Spring Brook Court')
//                    ->getQuery()
//                    ->getResult();
        
//        $springflowerHomeowners = $em->createQueryBuilder()
//                    ->select('u')
//                    ->from('AppBundle:User',  'u')
//                    ->where('u.street = ?1')
//                    ->andWhere('u.vacate_date IS NULL')
//                    ->addOrderBy('u.housenumber', 'ASC')
//                    ->setParameter(1, 'Spring Flower Way')
//                    ->getQuery()
//                    ->getResult();
        
    /*  
     * 
     * TODO:    This index call retrieves ALL residential properties with ALL present and past homeowners.  
     *          Need to trim off the past homeowners.  
     *      
     */
        $em = $this->getDoctrine()->getManager();       
        $bmd = $em->getRepository('AppBundle:Property')->getPropertiesByStreet('Brandy Mill Drive', 'Residential');
        $sbc = $em->getRepository('AppBundle:Property')->getPropertiesByStreet('Spring Brook Court', 'Residential');
        $sfw = $em->getRepository('AppBundle:Property')->getPropertiesByStreet('Spring Flower Way', 'Residential');
        return $this->render('homeowners/index.html.twig', array(
            'bmproperty'     => $bmd,
            'sbproperty'    => $sbc,
            'sfproperty'   => $sfw,
        ));
    }
    
    /**
     * @Route(
     *      "/public/property/show/{id}", 
     *      name="showPropertyPublic",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */         
    public function showAction($id)
    {

        /*
         *  TODO:   This method is wrong.  It is grabbing users instead of properties for public viewing.  We need to be grabbing properties (because there is ONLY ONE PROPERTY
         *          as opposed to multiple users who may or may not currently reside at the property), and by virtue, you will get the currently assigned user object.  Then 
         *          design a public property page with associated (current residents) user(s).
         * 
         *  ALSO:   Condense the layout of this view.  Summarize and lump all the photos in an array and put in a carousel.
         */
        
        $em = $this->getDoctrine()->getManager();

//        This works, but it's just not the way to do it... but it might be a good example down the road
//        $query = $em->createQuery(
//            '
//                SELECT u
//                FROM MainBundle:User u
//                WHERE u.id = :id
//            '
//        )->setParameter('id', $id);
//        $homeowner = $query->setMaxResults(1)->getOneOrNullResult();
        
        //correct way: 
//        $homeowner = $em->getRepository('AppBundle:User')->findOneBy(array('id' => $id));
//        
//        $spouse = $em->getRepository('AppBundle:Dependents')->getUsersSpouse($homeowner);
//        $dependents = $em->getRepository('AppBundle:Dependents')->getUsersDependents($homeowner);
//        $vehicles = $em->getRepository('AppBundle:Vehicles')->getUsersVehicles($homeowner);
//        $pets = $em->getRepository('AppBundle:Pets')->getUsersPets($homeowner);
//        $property = $em->getRepository('AppBundle:Property')->getUsersProperty($homeowner);
        
        $property   = $em->getRepository('AppBundle:Property')->find($id);
        $homeowners = $property->getUser(); //this is a collection
        
//  Spouse: IF the homeowner(s) has a dependent designated as a SPOUSE and the spouse is not a co-homeowner, then list the spouse separately  
        
        $testAr = array();
        $spouses = new ArrayCollection();
        $dependents = new ArrayCollection();
        $children = new ArrayCollection();
        $pets = new ArrayCollection();
        $vhcls = new ArrayCollection();
        
        $testAr['props'][] = $property;
        $testAr['props'][] = $property;
        //OWNERS
        foreach($homeowners as $homeowner){
            $testAr['homeowners'][] = $homeowner;
        }   
        
        //SPOUSE & DEPENDENTS
        foreach($homeowners as $homeowner){
            if(!empty($homeowner->getDependents()) ){
                $dependents = $homeowner->getDependents();
                //foreach dependent check to see if it is a spouse
                foreach($dependents as $dependent){
                    //SPOUSE
                    if($dependent->getSpouse() == 1){
                        $spouses[] = $dependent;
                        $testAr['spouse'][] = $dependent;
                    }
                    //CHILDREN
                    else{
                        $children[] = $dependent;
                        $testAr['kids'][] = $dependent;
                    }
                }
            }
        }
            
        //PETS
        foreach($homeowners as $homeowner){
            if(!empty($homeowner->getPets())){
                foreach($homeowner->getPets() as $animal){
                    $pets[] = $animal;
                    $testAr['pets'][] = $animal;
                }
            }
        }        
        $animals = $em->getRepository('AppBundle:Pets')->removeDupes($pets);
        
        //VEHICLES
        foreach($homeowners as $homeowner){
            if(!empty($homeowner->getVehicles())){
                foreach($homeowner->getVehicles() as $car){
                    $vhcls[] = $car;
                    $testAr['cars'][] = $car;
                }
            }
        }    
        $cars = $em->getRepository('AppBundle:Vehicles')->removeDupes($vhcls);
        
//        $testAr = array(1,2,3,4,5,6,7,8,9,10,11,12);
        
        return $this->render('homeowners/show.html.twig', array(
            'property'   =>  $property,
            'homeowners' =>  $homeowners,
            'spouses'    =>  $spouses,
            'dependents' =>  $children,
            'vehicles'   =>  $cars,
            'pets'       =>  $animals,
            'testAr'     => $testAr,
        ));
    }
    
}