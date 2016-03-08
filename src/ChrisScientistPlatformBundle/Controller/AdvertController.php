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
        // Tester la création d'un formulaire
        $advert = new Advert() ;
        // Création du FormBuilder grâce au service form factory
        $formBuilder = $this->get('form.factory')->createBuilder('form', $advert) ;
        // Ajout des champs au formulaire
        $formBuilder->add('title', 'text')
                ->add('date', 'date')
                ->add('content', 'textarea')
                ->add('author', 'text')
                ->add('published', 'checkbox', array('required'=>false))        # avec l'option required définit à false, le champ est ainsi facultatif
                ->add('save', 'submit');
        // Génération du formulaire
        $form = $formBuilder->getForm() ;
        // Lier le formulaire et la requête : $advert contient ainsi les valeurs saisies par l'utilisateur
        $form->handleRequest($request) ;
        
        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager() ;
            $em->persist($advert) ;
            $em->flush() ;
            
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.') ;
            
            return $this->redirect($this->generateUrl('chris_scientist_platform_view', array( 'id' => $advert->getId() ))) ;
        }
        
        return $this->render('ChrisScientistPlatformBundle:Advert:add.html.twig',
                array('form' => $form->createView())) ;
    }
    
    public function editAction($id, Request $request)
    {
        $em = $this->getDoctrine()->getManager() ;
        
        // Tester la création d'un formulaire pour l'édition d'une entité
        $advert = $em->getRepository("ChrisScientistPlatformBundle:Advert")->find($id) ;
        // Création du FormBuilder grâce au service form factory
        $formBuilder = $this->get('form.factory')->createBuilder('form', $advert) ;
        // Ajout des champs au formulaire
        $formBuilder->add('title', 'text')
                ->add('date', 'date')
                ->add('content', 'textarea')
                ->add('author', 'text')
                ->add('published', 'checkbox', array('required'=>false))        # avec l'option required définit à false, le champ est ainsi facultatif
                ->add('save', 'submit');
        // Génération du formulaire
        $form = $formBuilder->getForm() ;
        // Lier le formulaire et la requête : $advert contient ainsi les valeurs saisies par l'utilisateur
        $form->handleRequest($request) ;
        
        if($form->isValid())
        {
            $em = $this->getDoctrine()->getManager() ;
            $em->persist($advert) ;
            $em->flush() ;
            
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistrée.') ;
            
            return $this->redirect($this->generateUrl('chris_scientist_platform_view', array( 'id' => $advert->getId() ))) ;
        }
        
        return $this->render('ChrisScientistPlatformBundle:Advert:add.html.twig',
                array('form' => $form->createView())) ;
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
