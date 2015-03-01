<?php

namespace VirtualPersistAPI\VirtualPersistBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @file
 * The Log entity.
 */

/**
 * @ORM\Entity(repositoryClass="LogRepository")
 * @ORM\Table(name="Log")
 */
class Log extends AbstractLog {
}
