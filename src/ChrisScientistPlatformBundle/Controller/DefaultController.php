<?php

namespace ChrisScientistPlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('ChrisScientistPlatformBundle:Default:index.html.twig');
    }
}
