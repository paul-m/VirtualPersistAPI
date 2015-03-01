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

class LoadRecordData extends AbstractFixture implements OrderedFixtureInterface
{

  public function recordFixtureDataSource() {
    $data = array();
    $oldDate = new \DateTime('2000-01-01');
    $dateInterval = new \DateInterval('P1M');
    $uuid = '6CA62CA0-5651-40AB-9EFD-43661889224A';
    $letters = array('a','b','c','d','e','f');
    foreach ($letters as $catLetter) {
      foreach ($letters as $keyLetter) {
        $newDate = clone $oldDate;
        $newDate->add($dateInterval);
        $oldDate = $newDate;
        $data[] = array(
          'owner_uuid' => $uuid,
          'category' => $catLetter,
          'aKey' => $keyLetter,
          'data' => $catLetter . $keyLetter,
          'timestamp' => $newDate,
        );
      }
    }
    return $data;
  }

  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    $data = $this->recordFixtureDataSource();
    // Have to keep a reference to all the user objects
    // or else they can't be flushed all at once.
    $records = array();
    foreach ($data as $item) {
      $record = new Record();
      $record//->setOwnerUuid($item['owner_uuid'])
        ->setCategory($item['category'])
        ->setKey($item['aKey'])
        ->setData($item['data'])
        ->setTimestamp(new \DateTime('now'))
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
