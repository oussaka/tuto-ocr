<?php

namespace ChrisScientistPlatformBundle\Beta ;

use Symfony\Component\HttpFoundation\Response ;
use Symfony\Component\HttpKernel\Event\FilterResponseEvent ;
use Symfony\Component\HttpKernel\HttpKernelInterface ;

class BetaListener
{
    protected $betaHTML ;
    
    protected $endDate ;
    
    public function __construct(BetaHTML $aBetaHTML, $aEndDate)
    {
        $this->betaHTML = $aBetaHTML ;
        $this->endDate = new \DateTime($aEndDate) ;
    }
    
    public function processBeta(FilterResponseEvent $event)
    {
        if( ! $event->isMasterRequest() )
        {
            return ;
        }
        
        $remainingDays = $this->endDate->diff(new \DateTime())->format('%d') ;
        
        if($remainingDays <= 0)
        {
            return ;
        }
        
        $response = $this->betaHTML->displayBeta($event->getResponse(), $remainingDays) ;
        $event->setResponse($response) ;
    }
}