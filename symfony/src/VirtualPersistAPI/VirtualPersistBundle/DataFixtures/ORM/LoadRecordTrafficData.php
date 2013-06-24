<?php

/**
 * @file
 * Fixture data for testing User objects.
 */

namespace VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
//use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use VirtualPersistAPI\VirtualPersistBundle\Entity\Record;

class LoadRecordTrafficData extends AbstractFixture implements OrderedFixtureInterface
{

  public function trafficFixtureDataSource() {
    $data = array();
    $oldDate = new \DateTime('2000-01-01');
    $dateInterval = new \DateInterval('P1M');
    $uuid = '6CA62CA0-5651-40AB-9EFD-43661889224A';
    $regions = array('a','b','c','d','e','f');
    $count = 0;
    while ($count++ < 100) {
      foreach ($regions as $region) {
        $newDate = clone $oldDate;
        $newDate->add($dateInterval);
        $data[] = array(
          'owner_uuid' => $uuid,
          'category' => 'region_traffic',
          'aKey' => $region,
          'data' => rand(1,40),
          'timestamp' => $newDate,
        );
        $oldDate = $newDate;
      }
    }
    return $data;
  }

  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    $data = $this->trafficFixtureDataSource();
    // Have to keep a reference to all the user objects
    // or else they can't be flushed all at once.
    $records = array();
    foreach ($data as $item) {
      $record = new Record();
      $record//->setOwnerUuid($item['owner_uuid'])
        ->setCategory($item['category'])
        ->setKey($item['aKey'])
        ->setData($item['data'])
        ->setTimestamp($item['timestamp'])
        ->setOwner($manager->merge($this->getReference($item['owner_uuid'])));
      $records[] = $record;
      $manager->persist($record);
    }
    $manager->flush();
  }
  
  public function getOrder() {
    return 2;
  }
}
