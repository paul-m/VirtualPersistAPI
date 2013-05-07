<?php

/**
 * @file
 * Fixture data for testing User objects.
 */

namespace VirtualPersisAPI\VirtualPersistBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\FixtureInterface;
//use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use VirtualPersistAPI\VirtualPersistBundle\Entity\Record;

class LoadRecordData implements FixtureInterface
{

  public function userFixtureDataSource() {
  return array();
    $data = array(
      array(
        'uuid' => '6CA62CA0-5651-40AB-9EFD-43661889224A',
        'password' => 'foo',
        'username' => 'you',
        'email' => 'foo@foo.com',
      ),
      array(
        'uuid' => 'FF56D32A-DB4D-4E15-8C4C-29295118A61D',
        'password' => 'foo',
        'username' => 'me',
        'email' => 'foo2@foo.com',
      ),
    );
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
      $record = new User();
      $record->setUuid($record['uuid'])
        ->setPassword($record['password'])
        ->setUsername($record['username'])
        ->setEmail($record['email']);
      $records[] = $record;
      $manager->persist($record);
    }
    $manager->flush();
  }
  
  public function getOrder() {
    return 2;
  }
}
