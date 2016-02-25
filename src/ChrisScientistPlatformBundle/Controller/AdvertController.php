<?php

namespace ChrisScientistPlatformBundle\Controller ;

use Symfony\Component\HttpFoundation\Response ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller ;  // Penser à inclure cette classe et à faire hériter notre contrôleur !

class AdvertController extends Controller
{
    public function indexAction()
    {
        $content = $this->get('templating')->render('ChrisScientistPlatformBundle:Advert:index.html.twig') ;
        return new Response($content) ;
    }
    
    public function viewAction($id)
    {
        // Renvoyer une réponse rapide
        // en récupérant un paramètre de la route ($id)
        return new Response("Affichage de l'annonce dont l'ID est &laquo; ".$id." &raquo;.") ;
    }
}
