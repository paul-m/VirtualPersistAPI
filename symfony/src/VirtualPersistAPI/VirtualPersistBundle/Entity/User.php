<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Entity;

use Symfony\Component\Security\Core\User\AdvancedUserInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
//use Symfony\Component\Security\Core\User\EquatableInterface;

/**
 * @file
 * The User entity.
 */

/**
 * @ORM\Entity(repositoryClass="UserRepsitory")
 * @ORM\Table(
    name="User",
    uniqueConstraints={
      @ORM\UniqueConstraint(
        name="user_uuid",columns={"uuid"}
      )
    })
 */
class User { //implements AdvancedUserInterface, \Serializable {

  /**
   * @ORM\ID
   * @ORM\Column(type="integer")
   * @ORM\GeneratedValue(strategy="AUTO")
   */
  protected $id;

  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $password;

  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $username;

  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $email;

  /**
   * @ORM\Column(type="string", length=36)
   */
  protected $uuid;

  /**
   * @ORM\Column(type="string", length=255)
   */
  protected $salt;

  /**
   * @ORM\Column(name="is_active", type="boolean")
   */
  private $isActive;
  
  /**
   * @ORM\OneToMany(targetEntity="Record", mappedBy="owner_id")
   */
  private $records;
  
  public function __construct() {
    $this->records = new ArrayCollection();
      $this->isActive = true;
      $this->salt = md5(uniqid(null, true));
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
   * Set uuid
   *
   * @param string $uuid
   * @return User
   */
  public function setUuid($uuid) {
    $this->uuid = $uuid;

    return $this;
  }

  /**
   * Get uuid
   *
   * @return string 
   */
  public function getUuid() {
    return $this->uuid;
  }

  public function setEmail($email) {
    $this->email = $email;

    return $this;
  }

  public function getEmail() {
    return $this->email;
  }

  /**
   * Set password
   *
   * @param string $password
   * @return User
   */
  public function setPassword($password) {
    $this->password = $password;

    return $this;
  }

  /**
   * Get password
   *
   * @return string 
   */
  public function getPassword() {
    return $this->password;
  }

  /**
   * Set permission
   *
   * @param string $permission
   * @return User
   */
  public function setPermission($permission) {
    $this->permission = $permission;

    return $this;
  }

  /**
   * Get permission
   *
   * @return string 
   */
  public function getPermission() {
    return $this->permission;
  }


    /**
     * @inheritDoc
     */
    public function getUsername()
    {
        return $this->username;
    }

  /**
   * Set permission
   *
   * @param string $permission
   * @return User
   */
  public function setUsername($name) {
    $this->username = $name;

    return $this;
  }

    /**
     * @inheritDoc
     */
    public function getSalt()
    {
        return $this->salt;
    }

    /**
     * @inheritDoc
     */
    public function eraseCredentials()
    {
    }

    /**
     * @see \Serializable::serialize()
     */
    public function serialize()
    {
        return serialize(array(
            $this->id,
        ));
    }

    /**
     * @see \Serializable::unserialize()
     */
    public function unserialize($serialized)
    {
        list (
            $this->id,
        ) = unserialize($serialized);
    }

    public function isAccountNonExpired()
    {
        return true;
    }

    public function isAccountNonLocked()
    {
        return true;
    }

    public function isCredentialsNonExpired()
    {
        return true;
    }

    public function isEnabled()
    {
        return $this->isActive;
    }

}

