<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Response;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;

/**
 * Response class for VirtualPersistAPI.
 */
class VPADebugResponse extends Response {

  // Structured debug info.
  protected $debug;
  
  // The 'real' Request.
  // Can be NULL.
  protected $decorated;

  protected $requestType;

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

  public function setDebug($data) {
    $this->data = $data;
    return $this;
  }

  public function __call($name, $arguments) {
      // Note: value of $name is case sensitive.
      echo "Calling object method '$name' "
           . implode(', ', $arguments). "\n";
  }

  /**  As of PHP 5.3.0  */
  public static function __callStatic($name, $arguments) {
      // Note: value of $name is case sensitive.
      echo "Calling static method '$name' "
           . implode(', ', $arguments). "\n";
  }

}
