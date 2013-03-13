<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @file
 * The User entity.
 */


/**
 * @ORM\Entity(repositoryClass="UserRepsitory")
 * @ORM\Table(name="User")
 */
class User {
  /**
   * @ORM\ID
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
  
  /**
   * @ORM\Column(type="string", length=36)
   */
  protected $uuid;

  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $password;

  /**
   * NOTE: This will change.
   * __ORM\Column(type="string", length=255)
   */
  protected $permission;
    
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
     * Set uuid
     *
     * @param string $uuid
     * @return User
     */
    public function setUuid($uuid)
    {
        $this->uuid = $uuid;
    
        return $this;
    }

    /**
     * Get uuid
     *
     * @return string 
     */
    public function getUuid()
    {
        return $this->uuid;
    }

    /**
     * Set password
     *
     * @param string $password
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;
    
        return $this;
    }

    /**
     * Get password
     *
     * @return string 
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set permission
     *
     * @param string $permission
     * @return User
     */
    public function setPermission($permission)
    {
        $this->permission = $permission;
    
        return $this;
    }

    /**
     * Get permission
     *
     * @return string 
     */
    public function getPermission()
    {
        return $this->permission;
    }

    /**
     * Add records
     *
     * @param \VirtualPersistAPI\VirtualPersistBundle\Entity\Record $records
     * @return User
     */
    public function addRecord(\VirtualPersistAPI\VirtualPersistBundle\Entity\Record $records)
    {
        $this->records[] = $records;
    
        return $this;
    }

    /**
     * Remove records
     *
     * @param \VirtualPersistAPI\VirtualPersistBundle\Entity\Record $records
     */
    public function removeRecord(\VirtualPersistAPI\VirtualPersistBundle\Entity\Record $records)
    {
        $this->records->removeElement($records);
    }

    /**
     * Get records
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getRecords()
    {
        return $this->records;
    }
}