<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

/**
 * Our prefix:
 * @Route("/api")
 */
class DefaultController extends Controller
{
    /**
     * @Route("/{uuid}/{category}/{key}")
     */
    public function getAction($uuid, $category, $key)
    {
      $tellme = 'uuid: ' . $uuid . ' category: ' . $category . ' key: ' . $key;
      $response = new Response();
//        $tellme,
//      200,
        //array('content-type' => 'text/plain')
  //    );
      $response->setContent($tellme);
      $request = Request::createFromGlobals();
      $response->prepare($request);
//      $response->send();
      return $response;
    }
}
