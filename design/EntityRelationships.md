VirtualPersistAPI Entity Relationships
======================================

Currently...
------------

There are two entities in this system thus far: User and Record. They are connected by a foreign key in the Record table (owner_id), which refers to the id of the User.

The entities are managed through the Doctrine ORM system, which uses PHP comment annotations to define entities, their tables, and their columns.

The PHP files which use this system are in this directory: https://github.com/paul-m/VirtualPersistAPI/tree/master/symfony/src/VirtualPersistAPI/VirtualPersistBundle/Entity

For instance, the Record entity is simply a class in PHP which has been marked as representing a table in the database. The many-to-one relationship between this entity and User is annotated this way:

    /**
     * @ORM\Column(type="integer")
     * @ORM\ManyToOne(targetEntity="User")
     * @ORM\JoinColumn(name="owner_id", referencedColumnName="id", nullable=false)
     */
    protected $owner_id;

Here is a graphical diagram of the relationship between User and Record, generated with MySQL Workbench:

![vpa_erd.png](/Users/paul/VirtualPersistAPI/design/vpa_erd.png "vpa_erd.png")

Here is some MySQL which generates these entities and their relationship:

    SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0;
    SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0;
    SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='TRADITIONAL,ALLOW_INVALID_DATES';
    
    CREATE SCHEMA IF NOT EXISTS `vpa` DEFAULT CHARACTER SET latin1 ;
    USE `vpa` ;
    
    -- -----------------------------------------------------
    -- Table `vpa`.`User`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `vpa`.`User` (
      `id` INT(11) NOT NULL AUTO_INCREMENT ,
      `uuid` VARCHAR(36) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
      `password` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
      `salt` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
      PRIMARY KEY (`id`) )
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8
    COLLATE = utf8_unicode_ci;
    
    CREATE UNIQUE INDEX `user_uuid` ON `vpa`.`User` (`uuid` ASC) ;
    
    
    -- -----------------------------------------------------
    -- Table `vpa`.`Record`
    -- -----------------------------------------------------
    CREATE  TABLE IF NOT EXISTS `vpa`.`Record` (
      `id` INT(11) NOT NULL AUTO_INCREMENT ,
      `category` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
      `aKey` VARCHAR(255) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
      `data` LONGTEXT CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
      `owner_id` INT(11) NOT NULL ,
      `owner_uuid` VARCHAR(36) CHARACTER SET 'utf8' COLLATE 'utf8_unicode_ci' NOT NULL ,
      `timestamp` DATETIME NOT NULL ,
      PRIMARY KEY (`id`) ,
      CONSTRAINT `owner_id`
        FOREIGN KEY (`owner_id` )
        REFERENCES `vpa`.`User` (`id` )
        ON DELETE NO ACTION
        ON UPDATE NO ACTION)
    ENGINE = InnoDB
    DEFAULT CHARACTER SET = utf8
    COLLATE = utf8_unicode_ci;
    
    CREATE INDEX `owner_id_idx` ON `vpa`.`Record` (`owner_id` ASC) ;
    
    
    
    SET SQL_MODE=@OLD_SQL_MODE;
    SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS;
    SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS;

What's Next?
------------

In the future, we'll likely have a Roles table and a join table for it. This will be connected to the User table through the join table, so that Roles can stay normalized, and Users can have many Roles. This aspect of the design isn't finalized so maybe not.
