<?php

namespace ChrisScientistUserBundle\DataFixtures\ORM ;

use Doctrine\Common\DataFixtures\FixtureInterface ;
use Doctrine\Common\Persistence\ObjectManager ;
use ChrisScientistUserBundle\Entity\Utilisateur ;

class LoadUtilisateur implements FixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $listNames = array('user1', 'user2') ;
        
        foreach($listNames as $name)
        {
            $user = new Utilisateur() ;
            
            $user->setUsername($name) ;
            $user->setPassword($name) ;
            
            $user->setEmail($name . '@yopmail.com');
            $user->setEnabled(rand(true, false));
            $user->setRoles(array('ROLE_USER')) ;
            
            $manager->persist($user) ;
        }
        
        $manager->flush() ;
    }
}
