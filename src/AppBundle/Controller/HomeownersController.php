<?php

namespace AppBundle\Controller;

//use MainBundle\Entity\Property;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
//use Symfony\Component\HttpFoundation\Request;
//use Doctrine\Common\Collections\ArrayCollection;

class HomeownersController extends Controller
{
    
    /**
     * @Route("/homeowners/index", name="homeownersIndex")
     */     
    public function indexAction()
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
        
        
        /* This index call ONLY retrieves CURRENT HOMEOWNERS */
        
        
        $em = $this->getDoctrine()->getManager();       
        
        $brandymillHomeowners = $em->createQueryBuilder()
                    ->select('u')
                    ->from('AppBundle:User',  'u')
                    ->where('u.street = ?1')
                    ->andWhere('u.vacate_date IS NULL')
                    ->addOrderBy('u.housenumber', 'ASC')
                    ->setParameter(1, 'Brandy Mill Drive')
                    ->getQuery()
                    ->getResult();
        
        $springbrookHomeowners = $em->createQueryBuilder()
                    ->select('u')
                    ->from('AppBundle:User',  'u')
                    ->where('u.street = ?1')
                    ->andWhere('u.vacate_date IS NULL')
                    ->addOrderBy('u.housenumber', 'ASC')
                    ->setParameter(1, 'Spring Brook Court')
                    ->getQuery()
                    ->getResult();
        
        $springflowerHomeowners = $em->createQueryBuilder()
                    ->select('u')
                    ->from('AppBundle:User',  'u')
                    ->where('u.street = ?1')
                    ->andWhere('u.vacate_date IS NULL')
                    ->addOrderBy('u.housenumber', 'ASC')
                    ->setParameter(1, 'Spring Flower Way')
                    ->getQuery()
                    ->getResult();
        
        return $this->render('homeowners/index.html.twig', array(
            'brandymill_homeowners'     => $brandymillHomeowners,
            'springbrook_homeowners'    => $springbrookHomeowners,
            'springflower_homeowners'   => $springflowerHomeowners,
        ));
    }
    
    /**
     * @Route(
     *      "/homeowners/show/{id}", 
     *      name="homeownersShow",
     *      requirements={
     *         "id": "\d+"
     *     }
     * )
     */         
    public function showAction($id)
    {
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
        $homeowner = $em->getRepository('AppBundle:User')->findOneBy(array('id' => $id));
        
        $spouse = $em->getRepository('AppBundle:Dependents')->getUsersSpouse($homeowner);
        $dependents = $em->getRepository('AppBundle:Dependents')->getUsersDependents($homeowner);
        $vehicles = $em->getRepository('AppBundle:Vehicles')->getUsersVehicles($homeowner);
        $pets = $em->getRepository('AppBundle:Pets')->getUsersPets($homeowner);
        $property = $em->getRepository('AppBundle:Property')->getUsersProperty($homeowner);
        
        return $this->render('homeowners/show.html.twig', array(
            'homeowner'     =>  $homeowner,
            'spouse'        =>  $spouse[0],
            'dependents'    =>  $dependents,
            'vehicles'      =>  $vehicles,
            'pets'          =>  $pets,
            'property'      =>  $property[0]
        ));
    }
    
}