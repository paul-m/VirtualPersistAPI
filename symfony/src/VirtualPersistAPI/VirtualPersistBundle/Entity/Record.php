<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

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
   * @ORM\ID
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;
  
  /**
   * @ORM\Column(type="string", length=36)
   */
  protected $owner_uuid;

  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $category;

  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $key;

  /**
   * @ORM\Column(type="text")
   */
  protected $data;


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
     * Set owner_uuid
     *
     * @param string $ownerUuid
     * @return Record
     */
    public function setOwnerUuid($ownerUuid)
    {
        $this->owner_uuid = $ownerUuid;
    
        return $this;
    }

    /**
     * Get owner_uuid
     *
     * @return string 
     */
    public function getOwnerUuid()
    {
        return $this->owner_uuid;
    }

    /**
     * Set category
     *
     * @param string $category
     * @return Record
     */
    public function setCategory($category)
    {
        $this->category = $category;
    
        return $this;
    }

    /**
     * Get category
     *
     * @return string 
     */
    public function getCategory()
    {
        return $this->category;
    }

    /**
     * Set key
     *
     * @param string $key
     * @return Record
     */
    public function setKey($key)
    {
        $this->key = $key;
    
        return $this;
    }

    /**
     * Get key
     *
     * @return string 
     */
    public function getKey()
    {
        return $this->key;
    }

    /**
     * Set data
     *
     * @param string $data
     * @return Record
     */
    public function setData($data)
    {
        $this->data = $data;
    
        return $this;
    }

    /**
     * Get data
     *
     * @return string 
     */
    public function getData()
    {
        return $this->data;
    }
}