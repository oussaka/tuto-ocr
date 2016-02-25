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
        // Récupérer le paramètre "tag" dans l'URL
        $tag = $request->query->get('tag') ;
        
        // Renvoyer une réponse rapide
        // en récupérant un paramètre de la route ($id)
        return new Response("Affichage de l'annonce dont l'ID est &laquo; ".$id." &raquo;. "
                . "Le paramètre &laquo; tag &raquo; vaut &laquo; ".$tag." &raquo;.") ;
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
