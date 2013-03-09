<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;

use VirtualPersistAPI\VirtualPersistBundle\Entity\User;
use VirtualPersistAPI\VirtualPersistBundle\Entity\Record;

/**
 * Our prefix:
 * @Route("/api")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/{uuid}/{category}/{key}")
     * @Method({"GET"})
     */
    public function getAction($uuid, $category, $key)
    {
      $doctrine = $this->getDoctrine();
      
      $user = $doctrine
        ->getRepository('VirtualPersistBundle:User')
        ->findOneByUuid($uuid);

      $record = $doctrine
        ->getRepository('VirtualPersistBundle:Record')
        ->findOneByCategory($category);
      
      $tellme = 'uuid: ' . $uuid . ' category: ' . $category . ' key: ' . $key;
      if ($record) $tellme = $record->getData();
      
      $response = new Response();
      $response->setContent($tellme);
      $request = Request::createFromGlobals();
      $response->prepare($request);
      return $response;
    }
}
