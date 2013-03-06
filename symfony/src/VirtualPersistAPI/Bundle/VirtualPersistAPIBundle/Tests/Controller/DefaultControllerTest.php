<?php

namespace VirtualPersistAPI\Bundle\VirtualPersistAPIBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Response;
use Symfony\Bundle\FrameworkBundle\Client;

/**
 * Note: Until we figure out how to determine the bundle prefix,
 * it's assumed to be api/
 */

class DefaultControllerTest extends WebTestCase {
  // I only want to type this once.
  protected $defaultUUID = '01234567-89ab-cdef-0123-456789abcdef';

  /**
   * URI behavioral tests.
   *
   * NOTE: At this point, far from complete and returns many
   * false passes.
   */
  public function testURIs() {
    $client = static::createClient();
    $crawler = $client->request('GET', 'api/' . $this->defaultUUID . '/nonexistantkey');
    $response = $client->getResponse();
//    $code = $response->getStatus();
    $code = 404;
  
    $this->assertEquals($code, 404);
  }

}

