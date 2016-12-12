<?php

namespace AppBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\DependencyInjection\ContainerAwareInterface;
use Symfony\Component\DependencyInjection\ContainerInterface;
use AppBundle\Entity\User;

class UserFixtures extends AbstractFixture implements OrderedFixtureInterface, ContainerAwareInterface
{
    private $container;
    
    public function setContainer(ContainerInterface $container = null)
    {
        $this->container = $container;
    }
    
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('admin');
        $user->setUsernameCanonical('admin');
        $user->setEmail('patrick.hollis@gmail.com');
        $user->setEmailCanonical('patrick.hollis@gmail.com');
        $user->setEnabled(true);
        
//        $user->setSalt(md5(uniqid()));
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($user)
        ;
        $user->setPassword($encoder->encodePassword('admin', $user->getSalt()));
        
        $user->setLastLogin(new \DateTime());
        $user->setLocked(false);
        $user->setExpired(false);
        $user->setExpiresAt(null);
        $user->setConfirmationToken('1234567890abcdefg');
        $user->setPasswordRequestedAt(null);
//        $user->setRoles(null);
        $user->setCredentialsExpireAt(null);
        $user->setCredentialsExpired(false);
//        $user->setName('SuperAdmin');
        
        $manager->persist($user);
        
        $user_2 = new User();
        $user_2->setUsername('homeowner_1');
        $user_2->setUsernameCanonical('homeowner_1');
        $user_2->setEmail('homeowner_1@isp.com');
        $user_2->setEmailCanonical('homeowner_1@isp.com');
        $user_2->setEnabled(true);
        
//        $user->setSalt(md5(uniqid()));
        $encoder = $this->container
            ->get('security.encoder_factory')
            ->getEncoder($user_2)
        ;
        $user_2->setPassword($encoder->encodePassword('hoa1', $user_2->getSalt()));
        
        $user_2->setLastLogin(new \DateTime());
        $user_2->setLocked(false);
        $user_2->setExpired(false);
        $user_2->setExpiresAt(null);
        $user_2->setConfirmationToken('1234567890abcdefg');
        $user_2->setPasswordRequestedAt(null);
//        $user->setRoles(null);
        $user_2->setCredentialsExpireAt(null);
        $user_2->setCredentialsExpired(false);
        
        
        $manager->persist($user_2);
        
        $manager->flush();
        
        $this->addReference('user_1', $user);
        $this->addReference('user_2', $user_2);
        
    }
    
    public function getOrder()
    {
        return 1;
    }
}