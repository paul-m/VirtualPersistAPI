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
class APIControllerRoundTripTest extends AppFixtureTestCase implements AppFixtureTestCaseInterface {

  public static function getFixtureClass() {
    return 'VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM\LoadAPIControllerTestData';
  }

  /**
   * Test data to post
   */
  public function postTheseRecords() {
    return array(
      array(
        '00000000-0000-0000-0000-000000000000',
        'extantCategory',
        'extantKey',
        'goodData',
      ),
    );
  }

  /**
   * @dataProvider postTheseRecords
   */
  public function testRoundTrip($uuid, $category, $key, $data) {
    // We assume the controller's prefix is /api
    $path = "/api/$uuid/$category/$key";
    $client = static::createClientForApp();
    $crawler = $client->request('POST', $path, array('data'=>$data));
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(200, $status, "Posted record to path: $path");
    
    $crawler = $client->request('GET', $path);
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(200, $status, "Retrieved record with code: $status");
    $result = $client->getResponse()->getContent();
    $this->assertEquals($data, $result, 'Round-trip.');
  }

}
