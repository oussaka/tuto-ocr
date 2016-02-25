<?php

namespace ChrisScientistPlatformBundle\Controller ;

use Symfony\Component\HttpFoundation\Response ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller ;  // Penser à inclure cette classe et à faire hériter notre contrôleur !

class AdvertController extends Controller
{
    public function indexAction()
    {
        // Générer une URL relative depuis le contrôleur
        $url = $this->get('router')->generate('chris_scientist_platform_view', array('id' => 33)) ;
        return new Response("L'URL de l'annonce d'ID 33 est : ".$url) ;
    }
    
    public function viewAction($id)
    {
        // Renvoyer une réponse rapide
        // en récupérant un paramètre de la route ($id)
        return new Response("Affichage de l'annonce dont l'ID est &laquo; ".$id." &raquo;.") ;
    }
}
