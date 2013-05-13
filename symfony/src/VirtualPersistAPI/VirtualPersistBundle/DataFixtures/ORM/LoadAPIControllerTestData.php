<?php

/**
 * @file
 * Fixture data for testing User objects.
 */

namespace VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use VirtualPersistAPI\VirtualPersistBundle\Entity\User;
use VirtualPersistAPI\VirtualPersistBundle\Entity\Record;

class LoadAPIControllerTestData extends AbstractFixture // implements OrderedFixtureInterface
{

  public function userFixtureDataSource() {
    $users = array(
      array(
        'uuid' => '00000000-0000-0000-0000-000000000000',
        'password' => 'foo',
        'username' => 'thisUserExists',
        'email' => 'extant@foo.com',
      ),
    );
    $records = array(
      array(
        'owner_uuid' => '00000000-0000-0000-0000-000000000000',
        'category' => 'extantCategory',
        'aKey' => 'extantKey',
        'data' => 'extantData',
      ),
    );
    return array(
      'User' => $users,
      'Record' => $records,
    );
  }

  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    $data = $this->userFixtureDataSource();
    // Have to keep a reference to all the user objects
    // or else they can't be flushed all at once.
    $items = array();
    foreach ($data['User'] as $item) {
      $user = new User();
      $user->setUuid($item['uuid'])
        ->setPassword($item['password'])
        ->setUsername($item['username'])
        ->setEmail($item['email']);
      $this->addReference($user->getUuid(), $user);
      $items[] = $user;
      $manager->persist($user);
    }
    $manager->flush();
    
    $items = array();
    foreach ($data['Record'] as $item) {
      $record = new Record();
      $record->setOwnerUuid($item['owner_uuid'])
        ->setCategory($item['category'])
        ->setKey($item['aKey'])
        ->setData($item['data'])
        ->setTimestamp(new \DateTime('now'))
        ->setOwner($manager->merge($this->getReference($item['owner_uuid'])));
      $items[] = $record;
      $manager->persist($record);
    }
    $manager->flush();
  }
}
