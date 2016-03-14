<?php

namespace ChrisScientistUserBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class ChrisScientistUserBundle extends Bundle
{
    public function getParent()
    {
        return 'FOSUserBundle' ;
    }
}
