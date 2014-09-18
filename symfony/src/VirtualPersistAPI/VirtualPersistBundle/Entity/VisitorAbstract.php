<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="Visitor")
 * @ORM\InheritanceType("SINGLE_TABLE")
 * @ORM\DiscriminatorColumn(name="type", type="string", length=1)
 * @ORM\DiscriminatorMap({"a" = "VisitorArrival", "d" = "VisitorDeparture"})
 */
class VisitorAbstract {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\Column(type="string", length=36)
   */
  protected $uuid;

  /**
   * @ORM\Column(type="datetime")
   */
  protected $timestamp;

  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $region;

}
