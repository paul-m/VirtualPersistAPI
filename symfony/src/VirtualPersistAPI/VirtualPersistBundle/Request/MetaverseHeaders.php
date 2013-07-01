<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Request;

use Symfony\Component\HttpFoundation\HeaderBag;

/**
 * SL/Metaverse-oriented header helper class.
 */
class MetaverseHeaders {

  protected $headers;
  
  /**
   * Constructor.
   *
   * @param HeaderBag   $headers An array of response headers
   */
  public function __construct(HeaderBag $headers) {
    $this->setHeaders($headers);
  }
  
  /**
   * Factory. Helpful for object chaining.
   *
   * @param HeaderBag   $headers An array of response headers
   */
  public static function create(HeaderBag $headers) {
    return new static($headers);
  }

  public function setHeaders(HeaderBag $headers) {
    $this->headers = $headers;
    return $this;
  }

  public static function metaverseHeaders() {
    return array(
      'User-Agent',
      'X-SecondLife-Shard',
      'X-SecondLife-Object-Name',
      'X-SecondLife-Object-Key',
      'X-SecondLife-Region',
      'X-SecondLife-Local-Position',
      'X-SecondLife-Local-Rotation',
      'X-SecondLife-Local-Velocity',
      'X-SecondLife-Owner-Name',
      'X-SecondLife-Owner-Key',
    );
  }

  /**
   * Primitive header query method.
   *
   * @param string $headerString The header you're looking for.
   * @return mixed The value of the header.
   * @throws \LogicException if the header isn't found.
   */
  protected function headerQuery($headerString) {
    if ($value = $this->headers->get($headerString, NULL)) {
      return $value;
    }
    throw new \LogicException('Not valid metaverse headers, unable to find ' . $headerString);
  }

  public function getMetaverseHeaders() {
    $result = array();
    foreach (static::metaverseHeaders() as $header) {
      $value = NULL;
      try {
        $value = $this->headerQuery($header);
        $result[$header] = $value;
      } catch (\Exception $e) { }
    }
    return $result;
  }

  /**
   * Determine if a request came from in-world.
   *
   * @todo: Improve user-agent checking.
   */
  public function isInworld() {
    try {
      $agent = $this->headerQuery('User-Agent');
      $shard = $this->headerQuery('X-SecondLife-Shard');
      return ($agent && $shard);
    } catch (\Exception $e) { }
    return FALSE;
  }

  /**
   * Get the UUID of the object owner
   */
  public function ownerKey() {
    return $this->headerQuery('X-SecondLife-Owner-Key');
  }

}
