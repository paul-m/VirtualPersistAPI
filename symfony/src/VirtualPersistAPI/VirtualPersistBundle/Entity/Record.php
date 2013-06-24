<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\HttpFoundation\HeaderBag;

/**
 * @file
 * The Record entity.
 */

/**
 * @ORM\Entity(repositoryClass="RecordRepsitory")
 * @ORM\Table(name="Record")
 */
class Record {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\ManyToOne(targetEntity="User")
   * @ORM\JoinColumn(name="owner", referencedColumnName="id", nullable=false)
   */
  protected $owner;

  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $category;

  /**
   * Using aKey as the column name, because key is a reserved word.
   * @ORM\Column(type="string", length=255)
   */
  protected $aKey;

  /**
   * @ORM\Column(type="text")
   */
  protected $data;

  /**
   * @ORM\Column(type="datetime")
   */
  protected $timestamp;

  public function __construct() {
    $this->setTimestamp(new \DateTime('now'));
  }

  public function setTimestamp($timestamp) {
    $this->timestamp = $timestamp;
    return $this;
  }
  
  public function getTimestamp() {
    return $this->timestamp;
  }

  /**
   * Get id
   *
   * @return integer 
   */
  public function getId() {
    return $this->id;
  }

  /**
   * Set owner_uuid
   *
   * @param string $ownerUuid
   * @return Record
   */
  public function setOwnerUuid($ownerUuid) {
    $this->owner_uuid = $ownerUuid;

    return $this;
  }
  
  public function getOwner() {
    return $this->owner;
  }
  
  public function setOwner($owner) {
    $this->owner = $owner;
    return $this;
  }

  /**
   * Get owner_uuid
   *
   * @return string 
   */
  public function getOwnerUuid() {
    return $this->owner_uuid;
  }

  /**
   * Set category
   *
   * @param string $category
   * @return Record
   */
  public function setCategory($category) {
    $this->category = $category;

    return $this;
  }

  /**
   * Get category
   *
   * @return string 
   */
  public function getCategory() {
    return $this->category;
  }

  /**
   * Set key
   *
   * @param string $key
   * @return Record
   */
  public function setKey($key) {
    $this->aKey = $key;

    return $this;
  }

  /**
   * Get key
   *
   * @return string 
   */
  public function getKey() {
    return $this->aKey;
  }

  /**
   * Set data
   *
   * @param string $data
   * @return Record
   */
  public function setData($data) {
    $this->data = $data;

    return $this;
  }

  /**
   * Get data
   *
   * @return string 
   */
  public function getData() {
    return $this->data;
  }

}