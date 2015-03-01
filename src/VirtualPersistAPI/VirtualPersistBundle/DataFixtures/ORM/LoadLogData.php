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
use VirtualPersistAPI\VirtualPersistBundle\Entity\Log;

class LoadLogData extends AbstractFixture implements OrderedFixtureInterface
{

  public function recordFixtureDataSource() {
    $data = array();
    $oldDate = new \DateTime();
    $dateInterval = new \DateInterval('P1M');
    $dateInterval->invert = 1;
    $letters = array('a','b','c','d','e','f');
    foreach ($letters as $catLetter) {
      foreach ($letters as $keyLetter) {
        $newDate = clone $oldDate;
        $newDate->add($dateInterval);
        $oldDate = $newDate;
        $data[] = array(
          'type' => $catLetter,
          'message' => $catLetter . $keyLetter,
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
    // Have to keep a reference to all the objects
    // or else they can't be flushed all at once.
    $records = array();
    foreach ($data as $item) {
      $record = new Log();
      $record->setType($item['type'])
        ->setMessage($item['message'])
        ->setTimestamp($item['timestamp'])
        ->setUser($manager
          ->merge($this->getReference('6CA62CA0-5651-40AB-9EFD-43661889224A'))
        );
      $records[] = $record;
      $manager->persist($record);
    }
    $manager->flush();
  }
  
  public function getOrder() {
    return 3;
  }
}
