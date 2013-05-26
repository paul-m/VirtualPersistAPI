<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Tests\Controller;

use VirtualPersistAPI\VirtualPersistBundle\Tests\TestCases\AppFixtureTestCase;
use VirtualPersistAPI\VirtualPersistBundle\Tests\TestCases\AppFixtureTestCaseInterface;
use VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM\LoadAPIControllerTestData;
use Doctrine\Common\DataFixtures\Loader;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

//use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;


/**
 * Functional tests for the VirtualPersistAPI controller.
 *
 * Note that we assume FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF
 * is always a bad UUID, and that 00000000-0000-0000-0000-000000000000
 * is good.
 *
 * @TODO: Make a fixture
 * @TODO: test authentication.
 */
class APIControllerDeleteTest extends AppFixtureTestCase implements AppFixtureTestCaseInterface {

  public static function getFixtureClass() {
    return 'VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM\LoadAPIControllerTestData';
  }

  /**
   * Test data to post
   */
  public function deleteTheseRecordsNoErrors() {
    return array(
      array(
        '00000000-0000-0000-0000-000000000000',
        'extantCategory',
        'extantKey',
      ),
    );
  }

  /**
   * Test data to post
   */
  public function deleteTheseRecordsBadUser() {
    return array(
      array(
        'FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF',
        'extantCategory',
        'extantKey',
      ),
    );
  }

  /**
   * @dataProvider deleteTheseRecordsNoErrors
   */
  public function testDelete($uuid, $category, $key) {
    // We assume the controller's prefix is /api
    $path = "/api/$uuid/$category/$key";
    $client = static::createClientForApp();
    $crawler = $client->request('DELETE', $path);
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(200, $status, "Deleted record for path: $path");
  }

  /**
   * @dataProvider deleteTheseRecordsBadUser
   */
  public function testBadDelete($uuid, $category, $key) {
    // We assume the controller's prefix is /api
    $path = "/api/$uuid/$category/$key";
    $client = static::createClientForApp();
    $crawler = $client->request('DELETE', $path);
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(404, $status, "Deleted record for path: $path");
  }

}
