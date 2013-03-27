<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Symfony\Component\BrowserKit\Response;

/**
 * Functional tests for the VirtualPersistAPI controller.
 *
 * Note that we assume FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF
 * is always a bad UUID, and that 00000000-0000-0000-0000-000000000000
 * is good.
 *
 * @TODO: Make a fixture and test authentication.
 */
class APIControllerTest extends WebTestCase {

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
            '/api/FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF/nonexistantCategory/nonexistantKey',
        ),
        array(
            '/api/categories/FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF/',
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
  public function testPaths404($path) {
    // We assume the controller's prefix is /api
    $client = static::createClient();
    $crawler = $client->request('GET', $path);
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(404, $status, "Status code: $status");
  }

}

