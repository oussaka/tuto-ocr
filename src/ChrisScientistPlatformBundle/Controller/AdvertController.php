<?php

namespace ChrisScientistPlatformBundle\Controller ;

use Symfony\Component\HttpFoundation\Response ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller ;  // Penser à inclure cette classe et à faire hériter notre contrôleur !
use Symfony\Component\HttpFoundation\Request ;  // Penser à inclure cette classe !

class AdvertController extends Controller
{
    public function indexAction()
    {
        $content = $this->get('templating')->render('ChrisScientistPlatformBundle:Advert:index.html.twig') ;
        return new Response($content) ;
    }
    
    public function viewAction($id, Request $request)
    {
        // Manipuler la session
        $session = $request->getSession() ;
        $userId = $session->get('user_id') ;    // Récupérer le valeur de la variable 'user_id'
        $session->set('user_id', 33) ;
        return new Response("La variable &laquo; user_id &raquo; (de la session) valait &laquo; ".$userId." &raquo;.") ;
    }
    
    public function addAction()
    {
        return new Response("Pour ajouter une annonce, revenez plus tard...") ;
    }
    
    public function editAction($id)
    {
        return new Response("Pour modifier l'annonce ".$id.", revenez plus tard...") ;
    }
    
    public function deleteAction($id)
    {
        return new Response("Pour supprimer l'annonce ".$id.", revenez plus tard...") ;
    }
}
