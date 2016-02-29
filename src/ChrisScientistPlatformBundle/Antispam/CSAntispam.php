<?php

namespace ChrisScientistPlatformBundle\Antispam ;

class CSAntispam
{
    private $mailer ;
    private $locale ;
    private $minLengthText ;
    
    public function __construct(\Swift_Mailer $aMailer, $aLocale, $aMinLengthText)
    {
        $this->mailer = $aMailer ;
        $this->locale = $aLocale ;
        $this->minLengthText = $aMinLengthText ;
    }
    
    public function isSpam($aText)
    {
        return ( strlen($aText) < $this->minLengthText ) ;
    }
}
