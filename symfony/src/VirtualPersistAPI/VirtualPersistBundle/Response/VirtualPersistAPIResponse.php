<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Response;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Response class for VirtualPersistAPI.
 *
 * Handle JSON and LSLON responses. Include some metrics if requested.
 */
class VirtualPersistAPIResponse extends JsonResponse {

  protected $data;

  /**
  * {@inheritDoc}
  */
  public static function createForRequest(Request $request, $data = array(), $status = 200, $headers = array())
  {
    $response = new static($data, $status, $headers);
    $debug = $request->request->get('debug');
    if ($debug) {
      $response->headers->set('X-VPA-Debug', 'eventy!', TRUE);
    }
    return $response;
  }

}
