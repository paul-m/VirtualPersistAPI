<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Entity;

use VirtualPersistAPI\VirtualPersistBundle\Entity\Record;

class RecordEntityTest extends \PHPUnit_Framework_TestCase
{

  public function testCreate() {
    $this->assertNotNull(new Record());
  }

}
