<?php

namespace ChrisScientistUserBundle\Controller ;

use Symfony\Bundle\FrameworkBundle\Controller\Controller ;
use Symfony\Component\HttpFoundation\Request ;

class SecurityController extends Controller
{
    public function loginAction(Request $request)
    {
        if( $this->get('security.authorization_checker')->isGranted('IS_AUTHENTICATED_REMEMBERED'))
        {
            return $this->redirectToRoute('chris_scientist_platform_home') ;
        }
        
        $authenticationUtils = $this->get('security.authentication_utils') ;
        
        return $this->render('ChrisScientistUserBundle:Security:login.html.twig',
            array(
                'last_username' => $authenticationUtils->getLastUsername(),
                'error' => $authenticationUtils->getLastAuthenticationError(),
            )
        ) ;
    }
}
