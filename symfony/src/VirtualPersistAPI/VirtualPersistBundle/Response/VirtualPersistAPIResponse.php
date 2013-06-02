<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Response;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Response class for VirtualPersistAPI.
 */
class VirtualPersistAPIResponse extends Response {

  protected $data;
  
  /**
   * Constructor.
   *
   * @param mixed   $data    The response data
   * @param integer $status  The response status code
   * @param array   $headers An array of response headers
   */
  public function __construct($data = array(), $status = 200, $headers = array())
  {
    parent::__construct('', $status, $headers);
  
    $this->setData($data);
  }
  
  /**
  * {@inheritDoc}
  */
  public static function createForRequest(Request $request, $data = array(), $status = 200, $headers = array())
  {
    $response = new static($data, $status, $headers);
/*    $debug = $request->request->get('debug');
    if ($debug) {
      $response->headers->set('X-VPA-Debug', 'debuggy!', TRUE);
    }*/
    return $response;
  }

  public function setData($data) {
    $this->data = $data;
    return $this;
  }

}
