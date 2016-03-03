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
            throw new NotFoundHttpException("Page '".$page."' inexistante.") ;
        }
        
        $nbPerPage = 3 ;
        
        $listAdverts = $this->getDoctrine()
                ->getManager()
                ->getRepository("ChrisScientistPlatformBundle:Advert")
                ->getAdverts($page, $nbPerPage) ;
        
        $nbPages = ceil(count($listAdverts)/$nbPerPage) ;
        
        if($page > $nbPages)
        {
            throw $this->createNotFoundException("Page '".$page."' inexistante.") ;
        }
        
        return $this->render('ChrisScientistPlatformBundle:Advert:index.html.twig',
                array('listAdverts' => $listAdverts, 
                    'nbPages' => $nbPages, 
                    'page' => $page)) ;
    }
    
    public function viewAction($id, Request $request)
    {
        // Récupérer une entité grâce au repository
        $doctrine = $this->getDoctrine() ;
        $em = $doctrine->getManager() ;
        $advert = $em->find("ChrisScientistPlatformBundle:Advert", $id) ;
        
        if( is_null($advert) )
        {
            throw new NotFoundHttpException("L'annonce dont l'ID est '" . $id . "' n'existe pas.") ;
        }
        
        $listAdvertSkills = $em->getRepository("ChrisScientistPlatformBundle:AdvertSkill")->findByAdvert($advert) ;
        
        return $this->render('ChrisScientistPlatformBundle:Advert:view.html.twig', 
                array('advert'=>$advert, 'listAdvertSkills' => $listAdvertSkills)) ;
    }
    
    public function addAction(Request $request)
    {
        // Tester l'extension Slugglable
        $advert = new Advert() ;
        $advert->setTitle("Recherche développeur Symfony 2") ;
        $advert->setContent("Nous recherchons...") ;
        $advert->setAuthor("mon_adresse_mail@youhou.com") ;
        $em = $this->getDoctrine()->getManager() ;
        $em->persist($advert) ;
        $em->flush() ;
        
        if(true)
        {
            return new Response("Slug généré : " . $advert->getSlugTitle()) ;
        }
        
//        // Gérer une entité avec l'EntityManager
//        $advert = new Advert() ;
//        $advert->setTitle("Recherche développeur iOS") ;
//        $advert->setAuthor("Start-up 2") ;
//        $advert->setContent("Nous recherchons un développeur iOS...") ;
//        
//        $doctrine = $this->getDoctrine() ;
//        $em = $doctrine->getManager() ;
//        
//        $em->persist($advert) ;
//        
//        // Remarque : l'objet '$advert2' n'a pas besoin d'être persister, puisque nous
//        // récupérons l'objet via Doctrine, de cette manière il sait déjà qu'il doit
//        // gérer l'entité.
////        $advert2 = $em->getRepository("ChrisScientistPlatformBundle:Advert")->find(11) ;
////        $advert2->setDate(new \DateTime) ;
//        
//        $em->flush() ;
        
        if($request->isMethod('POST'))
        {
            $request->getSession()->getFlashBag()->add('info', 'Annonce bien enregistrée') ;
            
            return $this->redirectToRoute('chris_scientist_platform_view', array('id' => 33)) ;
        }
        
        return $this->render('ChrisScientistPlatformBundle:Advert:add.html.twig') ;
    }
    
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager() ;
        $advert = $em->getRepository("ChrisScientistPlatformBundle:Advert")->find($id) ;
        
        if( is_null($advert) )
        {
            throw $this->createNotFoundException("L'annonce dont l'ID est '" . $id . "' n'existe pas.") ;
        }
        
        return $this->render('ChrisScientistPlatformBundle:Advert:edit.html.twig', 
                array('advert' => $advert)) ;
    }
    
    public function deleteAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager() ;
        $advert = $em->getRepository("ChrisScientistPlatformBundle:Advert")->find($id) ;
        
        if( is_null($advert) )
        {
            throw $this->createNotFoundException("L'annonce dont l'ID est '" . $id . "' n'existe pas.") ;
        }
        
        if($request->isMethod("POST"))
        {
            $request->getSession()->getFlashBag()->add("info", "Annonce bien supprimée.") ;
            return $this->redirect($this->generateUrl('chris_scientist_platform_home')) ;
        }
        
        return $this->render('ChrisScientistPlatformBundle:Advert:delete.html.twig', 
                array('advert' => $advert)) ;
    }
}
