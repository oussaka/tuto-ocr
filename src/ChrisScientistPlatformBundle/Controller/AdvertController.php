<?php

namespace ChrisScientistPlatformBundle\Controller ;

use Symfony\Component\HttpFoundation\Response ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller ;  // Penser à inclure cette classe et à faire hériter notre contrôleur !
use Symfony\Component\HttpFoundation\Request ;  // Penser à inclure cette classe !
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException ; // Penser à inclure cette classe !
use ChrisScientistPlatformBundle\Entity\Advert ;

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
        // Gérer une entité avec l'EntityManager
        $advert = new Advert() ;
        $advert->setTitle("Recherche développeur Symfony 2") ;
        $advert->setAuthor("Start-up") ;
        $advert->setContent("Nous recherchons un développeur Symfony2 débutant...") ;
        
        //$doctrine = $this->get('doctrine') ;
        // Remarque : la ligne précédente est équivalente à la suivante
        // la nouvelle ligne permet d'obtenir l'autocomplétion.
        $doctrine = $this->getDoctrine() ;
        
        $em = $doctrine->getManager() ;
        //$em = $this->get('doctrine.orm.entity_manager') ; // Ligne équivalente à la précédente
        
        $em->persist($advert) ;
        $em->flush() ;
        
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
