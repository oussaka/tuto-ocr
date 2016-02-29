<?php

namespace ChrisScientistPlatformBundle\Controller ;

use Symfony\Component\HttpFoundation\Response ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller ;  // Penser à inclure cette classe et à faire hériter notre contrôleur !
use Symfony\Component\HttpFoundation\Request ;  // Penser à inclure cette classe !
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException ; // Penser à inclure cette classe !

class AdvertController extends Controller
{
    public function indexAction($page)
    {
        if($page < 1) {
            throw new NotFoundHttpException("Page &laquo; ".$page." &raquo; inexistante.") ;
        }
        
        return $this->render('ChrisScientistPlatformBundle:Advert:index.html.twig') ;
    }
    
    public function viewAction($id, Request $request)
    {
        return $this->render('ChrisScientistPlatformBundle:Advert:view.html.twig', array('id'=>$id)) ;
    }
    
    public function addAction(Request $request)
    {
        // Utilisation d'un service (fait maison)
        $antispam = $this->container->get('chris_scientist_platform.antispam') ;
        $text = 'abcdefghijklmn' ;
        if( $antispam->isSpam($text) )
        {
            throw new \Exception("Nous avons détecté votre message comme étant un spam, processus abandonné !") ;
        }
        
        if($request->isMethod('POST'))
        {
            $request->getSession()->getFlashBag()->add('info', 'Annonce bien enregistrée') ;
            
            return $this->redirectToRoute('chris_scientist_platform_view', array('id' => 33)) ;
        }
        
        return $this->render('ChrisScientistPlatformBundle:Advert:add.html.twig') ;
    }
    
    public function editAction($id, Request $request)
    {
        if($request->isMethod('POST'))
        {
            $request->getSession()->getFlashBag()->add('info', 'Annonce bien modifiée') ;
            
            return $this->redirectToRoute('chris_scientist_platform_view', array('id' => 33)) ;
        }
        
        return $this->render('ChrisScientistPlatformBundle:Advert:edit.html.twig') ;
    }
    
    public function deleteAction($id)
    {
        return $this->render('ChrisScientistPlatformBundle:Advert:delete.html.twig') ;
    }
}
