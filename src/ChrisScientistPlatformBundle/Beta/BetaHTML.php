<?php

namespace ChrisScientistPlatformBundle\Beta ;

use Symfony\Component\HttpFoundation\Response ;

class BetaHTML
{
    public function displayBeta(Response $response, $remainingDays)
    {
        $content = $response->getContent() ;
        
        // Code à ajouter
        $html = '<span style="color:red;font-size:0.5em;" > - Beta J-' . (int) $remainingDays . ' !<span>' ;
        
        // Ajout du code dans la première balise H1
        $content = preg_replace('#<h1>(.*?)</h1>#iU', '<h1>$1'.$html.'</h1>', $content, 1) ;
        
        $response->setContent($content) ;
        
        return $response ;
    }
}
