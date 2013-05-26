<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Tests\Controller;

use VirtualPersistAPI\VirtualPersistBundle\Tests\TestCases\AppFixtureTestCase;
use VirtualPersistAPI\VirtualPersistBundle\Tests\TestCases\AppFixtureTestCaseInterface;
use VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM\LoadAPIControllerTestData;

/**
 * Functional tests for the VirtualPersistAPI controller.
 *
 * Note that we assume that 11111111-1111-1111-1111-111111111111
 * is an existing user.
 *
 * @TODO: Make a fixture
 * @TODO: test authentication.
 */
class APIControllerDiscoveryTest extends AppFixtureTestCase implements AppFixtureTestCaseInterface {

  public static function getFixtureClass() {
    return 'VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM\LoadAPIControllerTestData';
  }

  /**
   * Test making a request based on discovering category and key.
   */
  public function testDiscovery() {
    // We assume the controller's prefix is /api
    $path = '/api/categories/11111111-1111-1111-1111-111111111111';
    $client = static::createClientForApp();
    $crawler = $client->request('GET', $path);
    $response = $client->getResponse();
    $this->assertEquals(200, $response->getStatusCode(), 'Got categories for path: ' . $path);
    
    $categories = json_decode($response->getContent());
    $category = reset($categories);
    $path = '/api/keys/11111111-1111-1111-1111-111111111111/' . $category;
    $crawler = $client->request('GET', $path);
    $response = $client->getResponse();
    $this->assertEquals(200, $response->getStatusCode(), 'Got keys for category: ' . $path);
    
    $keys = json_decode($response->getContent());
    $key = reset($keys);
    $path = '/api/11111111-1111-1111-1111-111111111111/' . $category . '/' . $key;
    $crawler = $client->request('GET', $path);
    $response = $client->getResponse();
    $this->assertEquals(200, $response->getStatusCode(), 'Got data for path: ' . $path);
    $this->assertEquals('discoveryData', $response->getContent());
  }

}
