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
class APIController extends Controller
{
    /**
     * @Route("/{uuid}/{category}/{key}", requirements={"uuid" = "[a-fA-F0-9]{8}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{4}-[a-fA-F0-9]{12}"})
     * @Method({"GET"})
     */
    public function getAction($uuid, $category, $key)
    {
      $doctrine = $this->getDoctrine();
      $record = $doctrine
        ->getRepository('VirtualPersistBundle:Record')
        ->findOneByUUIDCategoryKey($uuid, $category, $key);
      
      // Did we get a record?
      if ($record) {
        $user = $doctrine
          ->getRepository('VirtualPersistBundle:User')
          ->findOneByUuid($uuid);
        if ($user) { // if($user->has_authentication)
          $tellme = 'uuid: ' . $uuid . ' category: ' . $category . ' key: ' . $key;
          if ($record) $tellme = $record->getData();
          
          $response = new Response();
          $response->setContent($tellme);
          $request = Request::createFromGlobals();
          $response->prepare($request);
          return $response;
        }
      }
      
      return new Response ('No Such Item.', 404);//, array('content-type' => 'text/plain'));
    }
}

