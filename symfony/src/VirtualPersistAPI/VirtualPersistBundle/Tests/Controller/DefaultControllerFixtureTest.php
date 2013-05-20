<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Tests\Controller;

use VirtualPersistAPI\VirtualPersistBundle\Tests\TestCases\AppFixtureTestCase;
use VirtualPersistAPI\VirtualPersistBundle\Tests\TestCases\AppFixtureTestCaseInterface;
use VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM\LoadAPIControllerTestData;

/**
 * Functional tests for the default front page controller.
 * Uses LoadAPIControllerTestData fixture.
 *
 * @TODO: Make a fixture and test authentication.
 */
class DefaultControllerFixtureTest extends AppFixtureTestCase implements AppFixtureTestCaseInterface {

  public static function getFixtureClass() {
    return 'VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM\LoadAPIControllerTestData';
  }

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
    $client = static::createClientForApp();
    $crawler = $client->request('GET', $path);
    $this->assertTrue($client->getResponse()->isSuccessful(),
      'Result: ' . $client->getResponse()->getStatusCode()
    );
  }

}

