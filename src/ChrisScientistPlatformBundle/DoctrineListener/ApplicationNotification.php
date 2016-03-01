<?php

namespace ChrisScientistPlatformBundle\DoctrineListener ;

use Doctrine\ORM\Event\LifecycleEventArgs ;
use ChrisScientistPlatformBundle\Entity\Application ;

class ApplicationNotification
{
    private $mailer ;
    private $fromAddressEmail ;
    
    public function __construct(\Swift_Mailer $aMailer, $aFromAddressEmail)
    {
        $this->mailer = $aMailer ;
        $this->fromAddressEmail = $aFromAddressEmail ;
    }
    
    public function postPersist(LifecycleEventArgs $args)
    {
        $entity = $args->getEntity() ;
        
        if( ! ($entity instanceof Application) )
        {
            return ;
        }
        
        $message = new \Swift_Message(
                "Nouvelle candidature",
                "Vous avez reçu une nouvelle candidature."
        ) ;
        
        $message->addTo($entity->getAdvert()->getAuthor())
                ->addFrom($this->fromAddressEmail) ;
        
        $this->mailer->send($message) ;
    }
}