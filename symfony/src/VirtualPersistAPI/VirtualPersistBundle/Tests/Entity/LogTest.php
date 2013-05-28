<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Log;

use VirtualPersistAPI\VirtualPersistBundle\Entity\Log;
use VirtualPersistAPI\VirtualPersistBundle\Tests\TestCases\AppFixtureTestCase;
use VirtualPersistAPI\VirtualPersistBundle\Tests\TestCases\AppFixtureTestCaseInterface;

class LogEntityTest extends AppFixtureTestCase implements AppFixtureTestCaseInterface {

  public static function getFixtureClass() {
    return 'VirtualPersistAPI\VirtualPersistBundle\DataFixtures\ORM\LoadAPIControllerTestData';
  }

  /**
   * This test tries to persist a Log entity to the database.
   */
  public function testWriteLogEntity() {
    $doctrine = $this->getContainer()->get('doctrine');
    $entityManager = $doctrine->getEntityManager();

    $user = $doctrine
      ->getRepository('VirtualPersistBundle:User')
      ->findOneByUuid('00000000-0000-0000-0000-000000000000');

    $log = new Log();
    $log->setMessage('this is a message');
    $log->setType('test');
    $log->setUser($user);
    $entityManager->persist($log);
    $entityManager->flush();

    $this->assertNotEquals(0, $log->getId(), 'Log entity was written to the database.');
  }

}
