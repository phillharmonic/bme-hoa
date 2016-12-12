<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use AppBundle\Entity\Roles;

class RolesFixtures extends AbstractFixture 
{
    public function load(ObjectManager $manager)
    {
        
//Roles:        
        
        $role1 = new Roles();
        $role1->setName('ROLE_SUPER_ADMIN');
        $role1->setDescription('A super-admin is god and can make changes universally without consent by anyone.  This role is reserved exclusively for the developer and maybe a webmaster.');
        $manager->persist($role1);
        
        $role2 = new Roles();
        $role2->setName('ROLE_ADMIN');
        $role2->setDescription("The admin role can make changes to everything but the code and database.  This would be a good place for the webmaster or management company designee who administers the site, but shouldn't be able to touch the code.");
        $manager->persist($role2);
        
        $role3 = new Roles();
        $role3->setName('ROLE_ACCOUNTANT');
        $role3->setDescription('The accountant role is reserved for the accountant and he can make changes to only admin-accounting sections of the website.  Those who aren\'t designated an accountant do not have admininstrative rights to the admin-accounting pages');
        $manager->persist($role3);
        
        $role4 = new Roles();
        $role4->setName('ROLE_TRUSTEE');
        $role4->setDescription('A trustee is granted a few administsrative powers, such as access to admin pages, but cannot make broad changes.  Is limited in what can be edited and deleted.  Is permitted to blog, moderate forums, and make some changes to the admin pages. ');
        $manager->persist($role4);
        
        $role5 = new Roles();
        $role5->setName('ROLE_MODERATOR');
        $role5->setDescription('A moderator is granted moderating privileges for forums and blogs.');
        $manager->persist($role5);
        
        $role6 = new Roles();
        $role6->setName('ROLE_HOMEOWNER');
        $role6->setDescription('The most typical role.  Is granted permission to view permitted all non-admin HOA pages when logged in.');
        $manager->persist($role6);
        
        $role7 = new Roles();
        $role7->setName('ROLE_GUEST');
        $role7->setDescription('A guest is an authenticated user, but one that is not logged in.  This is the designated role of John-Q Public... and is considered to be the anonymous user.');
        $manager->persist($role7);
        
        $role8 = new Roles();
        $role8->setName('ROLE_EXPIRED');
        $role8->setDescription('The designation of a homeowner\'s account after they have moved.  Restricts access to that of a guest... but allows designation of former users.');
        $manager->persist($role8);
        
        $manager->flush();
        
    }
    
}