<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Group;

use VirtualPersistAPI\VirtualPersistBundle\Entity\Group;

class GroupEntityTest extends \PHPUnit_Framework_TestCase
{

  public function testCreate() {
    $this->assertNotNull(new Group());
  }

}
