<?php

namespace ChrisScientistPlatformBundle\Controller ;

use Symfony\Component\HttpFoundation\Response ;

class AdvertController
{
    public function indexAction()
    {
        return new Response("Hello world ! by chris-scientist") ;
    }
}
