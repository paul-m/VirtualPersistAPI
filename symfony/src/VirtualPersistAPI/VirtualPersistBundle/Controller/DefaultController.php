<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('VirtualPersistAPIVirtualPersistBundle:Default:index.html.twig', array('name' => $name));
    }
}
