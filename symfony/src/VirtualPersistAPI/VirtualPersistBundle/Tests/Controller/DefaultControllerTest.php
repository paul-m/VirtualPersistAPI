<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Functional tests for the default front page controller.
 *
 * @TODO: Make a fixture and test authentication.
 */
class DefaultControllerTest extends WebTestCase {

  public function goodPathDataProvider() {
    return array(
        array(
            '/',
        ),
    );
  }

  /**
   * @dataProvider goodPathDataProvider
   */
  public function testPaths200($path) {
    // We assume the controller's prefix is /api
    $client = static::createClient();
    $crawler = $client->request('GET', $path);
    $this->assertTrue($client->getResponse()->isSuccessful(),
      'Result: ' . $client->getResponse()->getStatusCode()
    );
  }

}

