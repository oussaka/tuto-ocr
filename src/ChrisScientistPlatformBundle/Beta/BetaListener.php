<?php

namespace ChrisScientistPlatformBundle\Beta ;

use Symfony\Component\HttpFoundation\Response ;

class BetaListener
{
    protected $betaHTML ;
    
    protected $endDate ;
    
    public function __construct(BetaHTML $aBetaHTML, $aEndDate)
    {
        $this->betaHTML = $aBetaHTML ;
        $this->endDate = new \DateTime($aEndDate) ;
    }
    
    public function processBeta()
    {
        $remainingDays = $this->endDate->diff(new \DateTime())->format('%d') ;
        
        if($remainingDays <= 0)
        {
            return ;
        }
    }
}