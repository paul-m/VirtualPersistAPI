<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

use VirtualPersistAPI\VirtualPersistBundle\Controller\APIController;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Component\HttpFoundation\Request;

/**
 * Functional tests for the VirtualPersistAPI inworld headers.
 */
class APIControllerInworldHeaderTest extends WebTestCase {

  public function inworldHeadersDataProvider() {
    return array(
      array(
        array(
          'User-Agent' => 'Second Life LSL/12.09.07.264510 (http://secondlife.com)',
          'X-SecondLife-Shard' => 'Production',
        ),
        TRUE,
      ),
      array(
        array(
          'User-Agent' => 'Second Life LSL/12.09.07.264510 (http://secondlife.com)',
        ),
        FALSE,
      ),
      array(
        array(
          'X-SecondLife-Shard' => 'Production',
        ),
        FALSE,
      ),
      array(
        array(
          'foo' => 'bah',
        ),
        FALSE,
      ),
    );
  }

  /**
   * @dataProvider inworldHeadersDataProvider
   */
  public function testRequestIsInworld($headers, $result) {
    $request = new Request();
    $request->headers = new HeaderBag($headers);
    $controller = new APIController();
    
    $this->assertEquals($controller->requestIsInworld($request), $result);
  }

  /**
   * @dataProvider inworldHeadersDataProvider
   */
  public function t_estInworldHeaders($headers, $result) {
    // do something here.
    $request = new Request();
    $request->headers = new HeaderBag($headers);
    $controller = new APIController();
    
    $this->assertEquals($controller->requestIsInworld($request), $result);
  }

}
