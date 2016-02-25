<?php

namespace ChrisScientistPlatformBundle\Controller ;

use Symfony\Component\HttpFoundation\Response ;
use Symfony\Bundle\FrameworkBundle\Controller\Controller ;  // Penser à inclure cette classe et à faire hériter notre contrôleur !

class AdvertController extends Controller
{
    public function indexAction()
    {
        // Afficher un page Twig depuis un contrôleur
        // avec un passage de paramètre (du contrôleur vers la vue)
        $content = $this->get('templating')->render('ChrisScientistPlatformBundle:Advert:index.html.twig', array('name' => 'Christopher')) ;
        return new Response($content) ;
    }
    
    public function viewAction($id)
    {
        // Renvoyer une réponse rapide
        // en récupérant un paramètre de la route ($id)
        return new Response("Affichage de l'annonce dont l'ID est &laquo; ".$id." &raquo;.") ;
    }
}
