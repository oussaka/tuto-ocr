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
        // Récupérer une entité grâce au repository
        $doctrine = $this->getDoctrine() ;
        $em = $doctrine->getManager() ;
        $repository = $em->getRepository("ChrisScientistPlatformBundle:Advert") ;
        
        $advert = $repository->find($id) ;
        
        if( is_null($advert) )
        {
            throw new NotFoundHttpException("L'annonce dont l'ID est '" . $id . "' n'existe pas.") ;
        }
        
        return $this->render('ChrisScientistPlatformBundle:Advert:view.html.twig', array('advert'=>$advert)) ;
    }
    
    public function addAction(Request $request)
    {
        // Gérer une entité avec l'EntityManager
        $advert = new Advert() ;
        $advert->setTitle("Recherche développeur iOS") ;
        $advert->setAuthor("Start-up 2") ;
        $advert->setContent("Nous recherchons un développeur iOS...") ;
        
        $doctrine = $this->getDoctrine() ;
        $em = $doctrine->getManager() ;
        
        $em->persist($advert) ;
        
        // Remarque : l'objet '$advert2' n'a pas besoin d'être persister, puisque nous
        // récupérons l'objet via Doctrine, de cette manière il sait déjà qu'il doit
        // gérer l'entité.
        $advert2 = $em->getRepository("ChrisScientistPlatformBundle:Advert")->find(11) ;
        $advert2->setDate(new \DateTime) ;
        
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
