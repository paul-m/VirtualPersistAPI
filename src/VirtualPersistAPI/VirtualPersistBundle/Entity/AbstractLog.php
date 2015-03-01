<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @file
 * The AbstractLog entity.
 */

/**
 * @ORM\MappedSuperclass
 */
class AbstractLog {

  /**
   * @ORM\Id
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\Column(type="integer")
   */
  protected $user;

  /**
   * @ORM\Column(type="string", length=36)
   */
  protected $userUUID;

  /**
   * @ORM\Column(type="string", length=128)
   */
  protected $type;

  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $message;

  /**
   * @ORM\Column(type="datetime")
   */
  protected $timestamp;

  public function __construct() {
    $this->setTimestamp(new \DateTime('now'));
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
   * Get uuid
   *
   * @return integer
   */
  public function getUserUuid() {
    return $this->userUUID;
  }

  /**
   * Set type
   *
   * @param string $type
   * @return Log
   */
  public function setType($type) {
    $this->type = $type;

    return $this;
  }

  /**
   * Get type
   *
   * @return string
   */
  public function getType() {
    return $this->type;
  }

  /**
   * Set message
   *
   * @param string $message
   * @return Log
   */
  public function setMessage($message) {
    $this->message = $message;

    return $this;
  }

  /**
   * Get message
   *
   * @return string
   */
  public function getMessage() {
    return $this->message;
  }

  /**
   * Set timestamp
   *
   * @param \DateTime $timestamp
   * @return Log
   */
  public function setTimestamp($timestamp) {
    $this->timestamp = $timestamp;

    return $this;
  }

  /**
   * Get timestamp
   *
   * @return \DateTime
   */
  public function getTimestamp() {
    return $this->timestamp;
  }

  /**
   * Get readable timestamp
   *
   * @return \string
   */
  public function getReadableTimestamp() {
    return $this->timestamp->format('Y-m-d H:i:s');
    ;
  }

  /**
   * Set user
   *
   * @param \VirtualPersistAPI\VirtualPersistBundle\Entity\User $user
   * @return Log
   */
  public function setUser(\VirtualPersistAPI\VirtualPersistBundle\Entity\User $user) {
    $this->user = $user->getId();
    $this->userUUID = $user->getUuid();

    return $this;
  }

  /**
   * Get user
   *
   * @return \VirtualPersistAPI\VirtualPersistBundle\Entity\User
   */
  /*    public function getUser()
    {
    return $this->user;
    } */
}
