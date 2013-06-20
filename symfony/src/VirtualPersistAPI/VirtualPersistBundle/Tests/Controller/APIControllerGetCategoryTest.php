<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Tests\Controller;

use VirtualPersistAPI\VirtualPersistBundle\Tests\TestCases\AppFixtureTestCase;
use VirtualPersistAPI\VirtualPersistBundle\Tests\TestCases\AppFixtureTestCaseInterface;
use VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM\LoadAPIControllerTestData;

/**
 * Functional tests for the VirtualPersistAPI controller.
 *
 * Note that we assume FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF
 * is always a bad UUID, and that 00000000-0000-0000-0000-000000000000
 * is in the fixture.
 *
 * @TODO: test authentication.
 */
class APIControllerGetCategoryTest extends AppFixtureTestCase implements AppFixtureTestCaseInterface {

  public static function getFixtureClass() {
    return 'VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM\LoadAPIControllerTestData';
  }

  /**
   * Test data to delete.
   */
  public function categoryTestDataProvider() {
    return array(
      array(
        '22222222-2222-2222-2222-222222222222',
        'categoryTest',
      ),
    );
  }

  /**
   * @dataProvider categoryTestDataProvider
   */
  public function testDelete($uuid, $category) {
    // We assume the controller's prefix is /api
    $path = "/api/$uuid/$category";
    $client = static::createClientForApp();

    $crawler = $client->request('GET', $path);
    $response = $client->getResponse();
    $status = $response->getStatusCode();
    $this->assertEquals(200, $status, 'Confirmed record exists:' . $path);
    $this->assertEquals('{"category":"categoryTest","results":[{"a":"aData"},{"b":"bData"},{"c":"cData"}]}',
      $response->getContent(),
      'JSON category response is correct'
    );
  }

}
