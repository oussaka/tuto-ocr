<?php

namespace ChrisScientistPlatformBundle\Antispam ;

class CSAntispam extends \Twig_Extension
{
    private $mailer ;
    private $locale ;
    private $minLengthText ;
    
    public function __construct(\Swift_Mailer $aMailer, $aMinLengthText)
    {
        $this->mailer = $aMailer ;
        $this->minLengthText = $aMinLengthText ;
    }
    
    public function setLocale($aLocale)
    {
        $this->locale = $aLocale ;
    }
    
    public function isSpam($aText)
    {
        return ( strlen($aText) < $this->minLengthText ) ;
    }
    
    public function getFunctions()
    {
        return array(
            new \Twig_SimpleFunction('checkIfSpam', array($this, 'isSpam'))
        ) ;
    }
    
    public function getName()
    {
        return 'CSAntispam' ;
    }
}
