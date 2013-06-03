<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Response;

use VirtualPersistAPI\VirtualPersistBundle\Response\LslonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * VPAResponseFactory creates a response of the appropriate type,
 * given a request object.
 */

class VPAResponseFactory {
  private function __create() {
    throw new \Exception('Do not instantiate this factory.');
  }
  
  public static function responseForRequest(Request $request) {
    // Default to plain-vanila Response
    $response = new Response();

    // Get the request parameter bag
    $requestBag = $request->request;

    $type = $requestBag->('type');
    if ('json' == $type) $response = new JsonResponse;
    if ('lslon' == $type) $response = new LslonResponse;
    // Shim the 
    if ($requestBag->get('debug')) {
      $response = new VPADebugResponse();
      $response->decorateThisResponse($response);
    }
    return $response;
  }
}
