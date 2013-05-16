<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Log;

use VirtualPersistAPI\VirtualPersistBundle\Entity\Log;

class LogEntityTest extends \PHPUnit_Framework_TestCase
{

  public function testCreate() {
    $this->assertNotNull(new Log());
  }

}
