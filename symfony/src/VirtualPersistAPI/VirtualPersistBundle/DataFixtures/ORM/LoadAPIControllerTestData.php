<?php

/**
 * @file
 * Fixture data for testing User objects.
 */

namespace VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\Persistence\ObjectManager;
use VirtualPersistAPI\VirtualPersistBundle\Entity\User;
use VirtualPersistAPI\VirtualPersistBundle\Entity\Record;

class LoadAPIControllerTestData extends AbstractFixture
{

  public function userFixtureDataSource() {
    // The same data for two users, one blocked and one not blocked.
    $users = array(
      array(
        'uuid' => '00000000-0000-0000-0000-000000000000',
        'password' => 'foo',
        'username' => 'thisUserExists',
        'email' => 'extant@foo.com',
        'is_active' => 1,
      ),
      array(
        'uuid' => '11111111-1111-1111-1111-111111111111',
        'password' => 'foo',
        'username' => 'anotherUser',
        'email' => 'another@foo.com',
        'is_active' => 1,
      ),
      array(
        'uuid' => '22222222-2222-2222-2222-222222222222',
        'password' => 'foo',
        'username' => 'categoryTestUser',
        'email' => 'category@foo.com',
        'is_active' => 1,
      ),
      array(
        'uuid' => 'EEEEEEEE-EEEE-EEEE-EEEE-EEEEEEEEEEEE',
        'password' => 'foo',
        'username' => 'thisUserIsBlocked',
        'email' => 'extantButBlocked@foo.com',
        'is_active' => 0,
      ),
    );
    $records = array(
      array(
        'owner_uuid' => '00000000-0000-0000-0000-000000000000',
        'category' => 'extantCategory',
        'aKey' => 'extantKey',
        'data' => 'extantData',
      ),
      array(
        'owner_uuid' => '11111111-1111-1111-1111-111111111111',
        'category' => 'anotherCategory',
        'aKey' => 'anotherKey',
        'data' => 'discoveryData',
      ),
      array(
        'owner_uuid' => '22222222-2222-2222-2222-222222222222',
        'category' => 'categoryTest',
        'aKey' => 'a',
        'data' => 'aData',
        'timestamp' => 1, // using 0 results in empty value for logic.
      ),
      array(
        'owner_uuid' => '22222222-2222-2222-2222-222222222222',
        'category' => 'categoryTest',
        'aKey' => 'b',
        'data' => 'bData',
        'timestamp' => 315554400, // 1980/1/1
      ),
      array(
        'owner_uuid' => '22222222-2222-2222-2222-222222222222',
        'category' => 'categoryTest',
        'aKey' => 'c',
        'data' => 'cData',
        'timestamp' => 978328800, // 2001/1/1
      ),
      array(
        'owner_uuid' => 'EEEEEEEE-EEEE-EEEE-EEEE-EEEEEEEEEEEE',
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
        ->setEmail($item['email'])
        ->setIsActive($item['is_active']);
      $this->addReference($user->getUuid(), $user);
      $items[] = $user;
      $manager->persist($user);
    }
    $manager->flush();
    
    $items = array();
    foreach ($data['Record'] as $item) {
      $record = new Record();
      $record//->setOwnerUuid($item['owner_uuid'])
        ->setCategory($item['category'])
        ->setKey($item['aKey'])
        ->setData($item['data'])
        ->setOwner($manager->merge($this->getReference($item['owner_uuid'])));
      $timestamp = new \DateTime('now');
      if (!empty($item['timestamp'])) {
        $timestamp->setTimestamp($item['timestamp']);
      }
      $record->setTimestamp($timestamp);
      $items[] = $record;
      $manager->persist($record);
    }
    $manager->flush();
  }
}
