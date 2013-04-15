<?php
namespace VirtualPersistAPI\VirtualPersistBundle\Entity;

//use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

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
class User { //implements UserInterface {

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
   * @ORM\Column(type="string", length=255)
   */
  protected $salt;

  /**
   * NOTE: This will change.
   * __ORM\Column(type="string", length=255)
   */
  protected $permission;

  /**
   * @_ORM\OneToMany(targetEntity="Record", mappedBy="owner_uuid")
   */
//  protected $records;
  
/*  public function __construct() {
    $this->records = new \Doctrine\Common\Collections\ArrayCollection();
  }*/

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

}

