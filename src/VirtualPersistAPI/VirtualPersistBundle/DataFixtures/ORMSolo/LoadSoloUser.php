<?php

/**
 * @file
 * Fixture data for single Solo Mornington User objects.
 */

namespace VirtualPersisAPI\VirtualPersistBundle\DataFixtures\ORMSolo;

use Doctrine\Common\DataFixtures\AbstractFixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use VirtualPersistAPI\VirtualPersistBundle\Entity\User;

class LoadSoloUser extends AbstractFixture implements OrderedFixtureInterface
{

  public function userFixtureDataSource() {
    $data = array(
      array(
        'uuid' => '6d286553-59ae-409a-887d-ee75df67b834',
        'password' => 'solo',
        'username' => 'solo',
        'email' => 'solomornington@gmail.com',
      ),
    );
    return $data;
  }

  /**
   * {@inheritDoc}
   */
  public function load(ObjectManager $manager)
  {
    $data = $this->userFixtureDataSource();
    // Have to keep a reference to all the user objects
    // or else they can't be flushed all at once.
    $users = array();
    foreach ($data as $item) {
      $user = new User();
      $user->setUuid($item['uuid'])
        ->setPassword($item['password'])
        ->setUsername($item['username'])
        ->setEmail($item['email']);
      $this->addReference($user->getUuid(), $user);
      $users[] = $user;
      $manager->persist($user);
    }
    $manager->flush();
  }

  public function getOrder() {
    return 1;
  }
}
