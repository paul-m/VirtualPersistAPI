<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Functional tests for the VirtualPersistAPI controller.
 *
 * These tests are against an app with no fixture or even a database.
 *
 * Note that we assume FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF
 * is always a bad UUID, and that 00000000-0000-0000-0000-000000000000
 * is good.
 *
 * @TODO: Make a fixture
 * @TODO: test authentication.
 */
class APIControllerPathTest extends WebTestCase {

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
        '/api/categories/FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF',
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
   * Data provider for paths that should result in 405 in POST requests
   */
  public function _405PathDataProvider() {
    return array(
      array(
        '/api/categories/FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF',
      ),
      array(
        '/api/keys/FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF/nonexistantCategory',
      ),
    );
  }


  /**
   * @dataProvider _405PathDataProvider
   * Test post-not-allowed paths.
   */
  public function test405PostPaths($path = '') {
    // We assume the controller's prefix is /api
    $client = static::createClient();
    $crawler = $client->request('POST', $path, array('data'=>'someData'));
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(405, $status, "Status code: $status path: $path");    
  }

  /**
   * Test posting some data when there's no database.
   */
  public function testBadPost() {
    // We assume the controller's prefix is /api
    $path = '/api/FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF/noCat/nokey';
    $client = static::createClient();
    $crawler = $client->request('POST', $path, array('data'=>'someData'));
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(404, $status, "Status code: $status path: $path");
  }

  /**
   * Test deleting some data when there's no database.
   */
  public function testBadDelete() {
    // We assume the controller's prefix is /api
    $path = '/api/FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF/noCat/nokey';
    $client = static::createClient();
    $crawler = $client->request('DELETE', $path);
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(404, $status, "Status code: $status path: $path");
  }
}
