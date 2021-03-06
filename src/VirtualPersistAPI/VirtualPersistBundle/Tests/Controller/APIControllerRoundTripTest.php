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
        '11111111-1111-1111-1111-111111111111',
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
    $path = '/api/' . $uuid . '/' . $category . '/' . $key;
    $client = static::createClientForApp();

    $crawler = $client->request('POST', $path, array('data'=>$data));
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(200, $status, "Posted record to path: $path");

    $crawler = $client->request('GET', $path);
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(200, $status, "Retrieved record with code: $status");
    $result = $client->getResponse()->getContent();
    $this->assertEquals($data, $result, 'Round-trip.');

    // Modify the data
    $updatedData = 'updatedData';
    $crawler = $client->request('POST', $path, array('data'=>$updatedData));
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(200, $status, "Posted record to path: $path");

    // Check modified data
    $crawler = $client->request('GET', $path);
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(200, $status, "Retrieved record with code: $status");
    $result = $client->getResponse()->getContent();
    $this->assertEquals($updatedData, $result, 'Updated existing record.');

    // Store JSON
    $jsonArray = array(
      'uuid' => $uuid,
      'category' => $category,
      'key' => $key,
      'jsondata' => $data,
    );
    $updatedData = json_encode($jsonArray);
    $crawler = $client->request('POST', $path, array('data'=>$updatedData));
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(200, $status, "Posted JSON record to path: $path");

    // Check modified data
    $crawler = $client->request('GET', $path);
    $status = $client->getResponse()->getStatusCode();
    $this->assertEquals(200, $status, "Retrieved record with code: $status");
    // convert data back to JSON, using associative array option.
    $result = json_decode($client->getResponse()->getContent(), TRUE);
    $arrayDiff = array_diff_assoc($result, $jsonArray);
    $this->assertEquals(count($arrayDiff), 0, 'Updated with JSON.');
  }

}
