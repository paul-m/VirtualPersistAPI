<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Response;

use Symfony\Component\HttpFoundation\Response;
use VirtualPersistAPI\VirtualPersistBundle\Response\VPADebugResponse;

/**
 * Response class for text/plain responses.
 *
 */
class TextPlainResponse extends Response {

  /**
   * Constructor.
   */
  public function __construct($content = '', $status = 200, array $headers = array())
  {
    parent::__construct($content, $status, $headers);
    $this->headers->set('Content-Type', 'text/plain;charset=utf-8', TRUE);
  }

}
