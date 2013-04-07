<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Tests\Response;

use VirtualPersistAPI\VirtualPersistBundle\Response\TextPlainResponse;

/**
 * Unit tests for the TextPlainResponse class.
 */
class TextPlainResponseTest extends \PHPUnit_Framework_TestCase {

  public function testTextPlainResponse() {
    $response = new TextPlainResponse('text', 200);
    $this->assertEquals(
      $response->headers->get('content-type'),
      'text/plain;charset=utf-8'
    );
  }

}

