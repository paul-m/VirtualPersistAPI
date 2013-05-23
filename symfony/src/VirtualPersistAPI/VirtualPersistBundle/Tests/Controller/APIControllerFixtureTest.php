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
class APIControllerFixturePathTest extends AppFixtureTestCase implements AppFixtureTestCaseInterface {

  public static function getFixtureClass() {
    return 'VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM\LoadAPIControllerTestData';
  }

  /**
   * Data provider for paths that should result in 200
   */
  public function goodPathDataProvider() {
    return array(
      array(
        '/api/00000000-0000-0000-0000-000000000000/extantCategory/extantKey',
      ),
      array(
        '/api/categories/00000000-0000-0000-0000-000000000000',
      ),
      array(
        '/api/keys/00000000-0000-0000-0000-000000000000/extantCategory',
      ),
      array(
        '/api/user/00000000-0000-0000-0000-000000000000',
      ),
    );
  }

  /**
   * Data provider for paths that should result in 404
   *
   * User EEEEEEEE-EEEE-EEEE-EEEE-EEEEEEEEEEEE should exist, but is blocked.
   */
  public function blockedUserDataProvider() {
    return array(
      array(
        '/api/EEEEEEEE-EEEE-EEEE-EEEE-EEEEEEEEEEEE/extantCategory/extantKey',
      ),
      array(
        '/api/categories/EEEEEEEE-EEEE-EEEE-EEEE-EEEEEEEEEEEE',
      ),
      array(
        '/api/keys/EEEEEEEE-EEEE-EEEE-EEEE-EEEEEEEEEEEE/extantCategory',
      ),
      array(
        '/api/user/EEEEEEEE-EEEE-EEEE-EEEE-EEEEEEEEEEEE',
      ),
    );
  }


  /**
   * @dataProvider goodPathDataProvider
   * @TODO: Once the authentication system is in place,
   * this test should result in 401 or 500.
   */
  public function testPaths200($path = 'verybadpath') {
    // We assume the controller's prefix is /api
    $client = static::createClientForApp();
    $crawler = $client->request('GET', $path);
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(200, $status, "Status code: $status path: $path");
  }

  /**
   * @dataProvider blockedUserDataProvider
   *
   * This is a test for whether non-authorized requests for blocked user's data
   * results in 404. It should.
   */
  public function testPaths404($path = '') {
    // We assume the controller's prefix is /api
    $client = static::createClientForApp();
    $crawler = $client->request('GET', $path);
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(404, $status, "Status code: $status path: $path");
  }

}
