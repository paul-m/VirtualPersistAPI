<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Response;

use Symfony\Component\HttpFoundation\Response;

/**
 * Response class for LSLON.
 *
 * Borrows heavily from JsonResponse.
 */
class LslonResponse extends Response {

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
  public static function create($data = array(), $status = 200, $headers = array())
  {
    return new static($data, $status, $headers);
  }

  public function setData($data) {
    $this->data = $data;
    return $this;
  }
  
  

}
