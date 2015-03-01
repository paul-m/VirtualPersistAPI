# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.25)
# Database: vpa
# Generation Time: 2013-05-30 01:20:29 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Record
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Record`;

CREATE TABLE `Record` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `owner` int(11) NOT NULL,
  `category` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `aKey` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `data` longtext COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9C989AA7CF60E67C` (`owner`),
  CONSTRAINT `FK_9C989AA7CF60E67C` FOREIGN KEY (`owner`) REFERENCES `User` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `Record` WRITE;
/*!40000 ALTER TABLE `Record` DISABLE KEYS */;

INSERT INTO `Record` (`id`, `owner`, `category`, `aKey`, `data`, `timestamp`)
VALUES
	(1,1,'extantCategory','extantKey','extantData','2013-05-30 03:19:58'),
	(2,2,'anotherCategory','anotherKey','discoveryData','2013-05-30 03:19:58'),
	(3,3,'extantCategory','extantKey','extantData','2013-05-30 03:19:58'),
	(4,4,'a','a','aa','2013-05-30 03:19:58'),
	(5,4,'a','b','ab','2013-05-30 03:19:58'),
	(6,4,'a','c','ac','2013-05-30 03:19:58'),
	(7,4,'a','d','ad','2013-05-30 03:19:58'),
	(8,4,'a','e','ae','2013-05-30 03:19:58'),
	(9,4,'a','f','af','2013-05-30 03:19:58'),
	(10,4,'b','a','ba','2013-05-30 03:19:58'),
	(11,4,'b','b','bb','2013-05-30 03:19:58'),
	(12,4,'b','c','bc','2013-05-30 03:19:58'),
	(13,4,'b','d','bd','2013-05-30 03:19:58'),
	(14,4,'b','e','be','2013-05-30 03:19:58'),
	(15,4,'b','f','bf','2013-05-30 03:19:58'),
	(16,4,'c','a','ca','2013-05-30 03:19:58'),
	(17,4,'c','b','cb','2013-05-30 03:19:58'),
	(18,4,'c','c','cc','2013-05-30 03:19:58'),
	(19,4,'c','d','cd','2013-05-30 03:19:58'),
	(20,4,'c','e','ce','2013-05-30 03:19:58'),
	(21,4,'c','f','cf','2013-05-30 03:19:58'),
	(22,4,'d','a','da','2013-05-30 03:19:58'),
	(23,4,'d','b','db','2013-05-30 03:19:58'),
	(24,4,'d','c','dc','2013-05-30 03:19:58'),
	(25,4,'d','d','dd','2013-05-30 03:19:58'),
	(26,4,'d','e','de','2013-05-30 03:19:58'),
	(27,4,'d','f','df','2013-05-30 03:19:58'),
	(28,4,'e','a','ea','2013-05-30 03:19:58'),
	(29,4,'e','b','eb','2013-05-30 03:19:58'),
	(30,4,'e','c','ec','2013-05-30 03:19:58'),
	(31,4,'e','d','ed','2013-05-30 03:19:58'),
	(32,4,'e','e','ee','2013-05-30 03:19:58'),
	(33,4,'e','f','ef','2013-05-30 03:19:58'),
	(34,4,'f','a','fa','2013-05-30 03:19:58'),
	(35,4,'f','b','fb','2013-05-30 03:19:58'),
	(36,4,'f','c','fc','2013-05-30 03:19:58'),
	(37,4,'f','d','fd','2013-05-30 03:19:58'),
	(38,4,'f','e','fe','2013-05-30 03:19:58'),
	(39,4,'f','f','ff','2013-05-30 03:19:58');

/*!40000 ALTER TABLE `Record` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table User
# ------------------------------------------------------------

DROP TABLE IF EXISTS `User`;

CREATE TABLE `User` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `uuid` varchar(36) COLLATE utf8_unicode_ci NOT NULL,
  `salt` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_uuid` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `User` WRITE;
/*!40000 ALTER TABLE `User` DISABLE KEYS */;

INSERT INTO `User` (`id`, `password`, `username`, `email`, `uuid`, `salt`, `is_active`)
VALUES
	(1,'foo','thisUserExists','extant@foo.com','00000000-0000-0000-0000-000000000000','f6061632076266c9fd2439e13d35c300',1),
	(2,'foo','anotherUser','another@foo.com','11111111-1111-1111-1111-111111111111','b6c47e8d8683578bf8b51204e538e713',1),
	(3,'foo','thisUserIsBlocked','extantButBlocked@foo.com','EEEEEEEE-EEEE-EEEE-EEEE-EEEEEEEEEEEE','1a3578f022548438134125412e47f266',0),
	(4,'foo','you','foo@foo.com','6CA62CA0-5651-40AB-9EFD-43661889224A','35fd6af31727a3ce41f491b7e0f609d7',1),
	(5,'foo','me','foo2@foo.com','FF56D32A-DB4D-4E15-8C4C-29295118A61D','98f58b740f7905c910bbe476ba6da245',1);

/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;

DELIMITER ;;
/*!50003 SET SESSION SQL_MODE="" */;;
/*!50003 CREATE */ /*!50017 DEFINER=`root`@`localhost` */ /*!50003 TRIGGER `DeleteRecordsForDeletedUser` BEFORE DELETE ON `User` FOR EACH ROW begin
	delete from `Record`
	where `owner`= OLD.`id`;
end */;;
DELIMITER ;
/*!50003 SET SESSION SQL_MODE=@OLD_SQL_MODE */;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
