<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @file
 * The LogArchive entity.
 */

/**
 * @ORM\Entity
 * @ORM\Table(name="LogArchive")
 */
class LogArchive {

  /**
   * @ORM\ID
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\ManyToOne(targetEntity="User")
   * @ORM\JoinColumn(name="user", referencedColumnName="id")
   */
  protected $user;

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


    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set type
     *
     * @param string $type
     * @return Log
     */
    public function setType($type)
    {
        $this->type = $type;

        return $this;
    }

    /**
     * Get type
     *
     * @return string 
     */
    public function getType()
    {
        return $this->type;
    }

    /**
     * Set message
     *
     * @param string $message
     * @return Log
     */
    public function setMessage($message)
    {
        $this->message = $message;

        return $this;
    }

    /**
     * Get message
     *
     * @return string 
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * Set timestamp
     *
     * @param \DateTime $timestamp
     * @return Log
     */
    public function setTimestamp($timestamp)
    {
        $this->timestamp = $timestamp;

        return $this;
    }

    /**
     * Get timestamp
     *
     * @return \DateTime 
     */
    public function getTimestamp()
    {
        return $this->timestamp;
    }


    /**
     * Set user
     *
     * @param \VirtualPersistAPI\VirtualPersistBundle\Entity\User $user
     * @return Log
     */
    public function setUser(\VirtualPersistAPI\VirtualPersistBundle\Entity\User $user)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \VirtualPersistAPI\VirtualPersistBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }
}
