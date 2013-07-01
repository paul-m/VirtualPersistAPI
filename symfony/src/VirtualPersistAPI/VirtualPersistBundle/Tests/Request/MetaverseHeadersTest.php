<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Tests\Request;

use Symfony\Component\HttpFoundation\HeaderBag;

use VirtualPersistAPI\VirtualPersistBundle\Request\MetaverseHeaders;

/**
 * Unit tests for the TextPlainResponse class.
 */
class MetaverseHeadersTest extends \PHPUnit_Framework_TestCase {

  /**
   * @expectedException ErrorException
   */
  public function testMetaverseHeadersCreateException() {
    $headers = new MetaverseHeaders();
  }

  public function testMetaverseHeadersCreate() {
    $headers = new HeaderBag(array());
    $metaverseHeaders = new MetaverseHeaders($headers);
    $this->assertNotNull($metaverseHeaders);
  }

  public function inworldHeadersDataProvider() {
    return array(
      array(
        array(
          'User-Agent' => 'Second Life LSL/12.09.07.264510 (http://secondlife.com)',
          'X-SecondLife-Shard' => 'Production',
        ),
        TRUE,
      ),
      array(
        array(
          'User-Agent' => 'Second Life LSL/12.09.07.264510 (http://secondlife.com)',
        ),
        FALSE,
      ),
      array(
        array(
          'X-SecondLife-Shard' => 'Production',
        ),
        FALSE,
      ),
      array(
        array(
          'foo' => 'bah',
        ),
        FALSE,
      ),
    );
  }

  /**
   * @dataProvider inworldHeadersDataProvider
   */
  public function testMetaverseHeadersIsInworld($headerArray, $result) {
    $headers = new HeaderBag($headerArray);
    // Test this two ways:
    // 1) create new MetaverseHeaders object
    $metaverseHeaders = new MetaverseHeaders($headers);
    $this->assertEquals($metaverseHeaders->isInworld(), $result);
    // 2) Through object chaining
    $this->assertEquals(MetaverseHeaders::create($headers)->isInworld(), $result);
  }

  public function inworldHeadersOwnerUUIDDataProvider() {
    return array(
      array(
        array(
          'User-Agent' => 'Second Life LSL/12.09.07.264510 (http://secondlife.com)',
          'X-SecondLife-Shard' => 'Production',
          'X-SecondLife-Owner-Key' => '11111111-1111-1111-1111-111111111111',
        ),
        '11111111-1111-1111-1111-111111111111',
      ),
    );
  }

  /**
   * @dataProvider inworldHeadersOwnerUUIDDataProvider
   */
  public function testMetaverseHeadersOwnerUUID($headerArray, $result) {
    $headers = new HeaderBag($headerArray);
    // Test this two ways:
    // 1) create new MetaverseHeaders object
    $metaverseHeaders = new MetaverseHeaders($headers);
    $this->assertEquals($metaverseHeaders->ownerKey(), $result);
    // 2) Through object chaining
    $this->assertEquals(MetaverseHeaders::create($headers)->ownerKey(), $result);
  }

  /**
   * This seemed like a good idea at the start.
   */
  public function getMetaverseHeadersDataProvider() {
    $metaverseHeaders = array(
      'User-Agent',
      'X-SecondLife-Shard',
      'X-SecondLife-Object-Name',
      'X-SecondLife-Object-Key',
      'X-SecondLife-Region',
      'X-SecondLife-Local-Position',
      'X-SecondLife-Local-Rotation',
      'X-SecondLife-Local-Velocity',
      'X-SecondLife-Owner-Name',
      'X-SecondLife-Owner-Key',
    );
    $providedData = array();
    $testCases = count($metaverseHeaders);
    while (1 <= $testCases) {
      $data = array();
      $randHeaderKeys = array_rand($metaverseHeaders, $testCases);
      if ($testCases <= 1) {
        // rand header key is not an array in this case.
        $data[$metaverseHeaders[$randHeaderKeys]] = 'not-empty';
      }
      else {
        foreach($randHeaderKeys as $key) {
          $header = $metaverseHeaders[$key];
          $data[$header] = 'not-empty';
        }
      }
      $providedData[] = array($data, $testCases);
      --$testCases;
    }
    return $providedData;
  }

  /**
   * @dataProvider getMetaverseHeadersDataProvider
   */
  public function testGetMetaverseHeaders($headerArray, $result) {
    $headers = new HeaderBag($headerArray);
    // Test this two ways:
    // 1) create new MetaverseHeaders object
    $metaverseHeaders = new MetaverseHeaders($headers);
    $this->assertEquals(count($metaverseHeaders->getMetaverseHeaders()), $result);
    // 2) Through object chaining
    $this->assertEquals(count(MetaverseHeaders::create($headers)->getMetaverseHeaders()), $result);
  }


}
