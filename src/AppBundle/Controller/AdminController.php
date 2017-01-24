<?php


namespace AppBundle\Controller;
use AppBundle\Form\PropertyForm;
use AppBundle\Form\AdminUserForm;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class AdminController extends Controller
{

    
    /**
     * @Route("/admin/dashboard/show", name="showDashboardAdmin")
     */    
    public function showDashboardAdminAction()
    {
        
        return $this->render('admin/AdminLTE/dashboard.html.twig', array(
        ));
    }
    
    /**
     * @Route("/admin/calendar/show", name="showCalendarAdmin")
     */    
    public function calendarAction()
    {
        return $this->render('admin/AdminLTE/calendar.html.twig', array(
            
        ));
    }    
    
    /**
     * @Route("/admin/email/show", name="showEmailAdmin")
     */    
    public function emailAction()
    {
        return $this->render('admin/AdminLTE/email.html.twig', array(
            
        ));
    }       
    
    public function rolesAction(){
        return $this->render('MainBundle:Admin:roles.html.twig', array(
        )); 
    }
    
    
    
}