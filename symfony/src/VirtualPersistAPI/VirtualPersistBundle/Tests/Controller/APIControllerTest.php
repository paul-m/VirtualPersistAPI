<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
//use Symfony\Component\BrowserKit\Response;

//use VirtualPersistAPI\VirtualPersistBundle\Tests\Testing\EnvironmentTestCase;
//use VirtualPersistAPI\VirtualPersistBundle\Tests\TestCases\AppTestCase;

use Doctrine\Common\DataFixtures\Loader;
//use MyDataFixtures\LoadUserData;
use VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM\LoadAPIControllerTestData;
use Doctrine\Common\DataFixtures\Executor\ORMExecutor;
use Doctrine\Common\DataFixtures\Purger\ORMPurger;

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
class APIControllerPathTest extends WebTestCase {

  public function setUp() {
    $client = static::createClient();
    $em = static::$kernel->getContainer()->get('doctrine.orm.entity_manager');
    
    $purger = new ORMPurger($em);
    $purger->setPurgeMode(ORMPurger::PURGE_MODE_DELETE);

    $executor = new ORMExecutor($em, $purger);

    $loader = new Loader();
    $loader->addFixture(new LoadAPIControllerTestData());

    $executor->execute($loader->getFixtures(), FALSE);
  }

  /**
   * Data provider for paths that should result in 404
   */
  public function badPathDataProvider() {
    return array(
        array(
            '/api',
        ),
        array(
            '/api/FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF',
        ),
        array(
            '/api/00000000-0000-0000-0000-000000000000',
        ),
        array(
            '/api/FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF/nonexistantCategory',
        ),
        array(
            '/api/00000000-0000-0000-0000-000000000000/nonexistantCategory',
        ),
        array(
            '/api/categories/FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF/',
        ),
        array(
            '/api/FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF/nonexistantCategory/nonexistantKey',
        ),
        array(
            '/api/keys/FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF/nonexistantCategory',
        ),
    );
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
    );
  }

  /**
   * @dataProvider badPathDataProvider
   * @TODO: Once the authentication system is in place,
   * this test should result in 401 or 500.
   */
  public function testPaths404($path = '') {
    // We assume the controller's prefix is /api
    $client = static::createClient();
    $crawler = $client->request('GET', $path);
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(404, $status, "Status code: $status path: $path");
  }

  /**
   * @dataProvider goodPathDataProvider
   * @TODO: Once the authentication system is in place,
   * this test should result in 401 or 500.
   */
  public function testPaths200($path = 'verybadpath') {
    // We assume the controller's prefix is /api
    $client = static::createClient();
    $crawler = $client->request('GET', $path);
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(200, $status, "Status code: $status path: $path");
  }
}
