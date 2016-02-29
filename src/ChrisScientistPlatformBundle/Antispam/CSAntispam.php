<?php

namespace ChrisScientistPlatformBundle\Antispam ;

class CSAntispam
{
    public function isSpam($aText)
    {
        return ( strlen($aText) > 10 ) ;
    }
}
