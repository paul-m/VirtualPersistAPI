<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Tests\Controller;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

/**
 * Functional tests for the VirtualPersistAPI controller.
 *
 * Note that we assume FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF
 * is always a bad UUID, and that 00000000-0000-0000-0000-000000000000
 * is good.
 *
 * @TODO: Make a fixture and test authentication.
 */
class APIControllerTest extends WebTestCase
{

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
        '/api/FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF/nonexistantProperty',
      ),
      array(
        '/api/00000000-0000-0000-0000-000000000000/nonexistantProperty',
      ),
      array(
        '/api/FFFFFFFF-FFFF-FFFF-FFFF-FFFFFFFFFFFF/nonexistantProperty/nonexistantKey',
      ),
    );
  }

  public function goodPathDataProvider() {
    return array(
      array(
        '/api/00000000-0000-0000-0000-000000000000/extantProperty/extantKey',
      ),
      array(
        '/api/properties/00000000-0000-0000-0000-000000000000',
      ),
      array(
        '/api/keys/00000000-0000-0000-0000-000000000000/extantProperty',
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
    $this->assertTrue($client->getResponse()->isNotFound());
  }

}

