<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Tests\Entity;

use VirtualPersistAPI\VirtualPersistBundle\Entity\Role;

class RoleTest extends \PHPUnit_Framework_TestCase
{

  public function testCreate() {
    $this->assertNotNull(new Role());
  }

}
