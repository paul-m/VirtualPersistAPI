# ************************************************************
# Sequel Pro SQL dump
# Version 4096
#
# http://www.sequelpro.com/
# http://code.google.com/p/sequel-pro/
#
# Host: localhost (MySQL 5.5.25-log)
# Database: vpa
# Generation Time: 2013-05-15 21:22:37 +0000
# ************************************************************


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;


# Dump of table Log
# ------------------------------------------------------------

DROP TABLE IF EXISTS `Log`;

CREATE TABLE `Log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B7722E258D93D649` (`user`),
  CONSTRAINT `FK_B7722E258D93D649` FOREIGN KEY (`user`) REFERENCES `User` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

LOCK TABLES `Log` WRITE;
/*!40000 ALTER TABLE `Log` DISABLE KEYS */;

INSERT INTO `Log` (`id`, `user`, `type`, `message`, `timestamp`)
VALUES
	(1,2,'a','aa','2013-04-15 23:22:12'),
	(2,2,'a','ab','2013-03-15 23:22:12'),
	(3,2,'a','ac','2013-02-15 23:22:12'),
	(4,2,'a','ad','2013-01-15 23:22:12'),
	(5,2,'a','ae','2012-12-15 23:22:12'),
	(6,2,'a','af','2012-11-15 23:22:12'),
	(7,2,'b','ba','2012-10-15 23:22:12'),
	(8,2,'b','bb','2012-09-15 23:22:12'),
	(9,2,'b','bc','2012-08-15 23:22:12'),
	(10,2,'b','bd','2012-07-15 23:22:12'),
	(11,2,'b','be','2012-06-15 23:22:12'),
	(12,2,'b','bf','2012-05-15 23:22:12'),
	(13,2,'c','ca','2012-04-15 23:22:12'),
	(14,2,'c','cb','2012-03-15 23:22:12'),
	(15,2,'c','cc','2012-02-15 23:22:12'),
	(16,2,'c','cd','2012-01-15 23:22:12'),
	(17,2,'c','ce','2011-12-15 23:22:12'),
	(18,2,'c','cf','2011-11-15 23:22:12'),
	(19,2,'d','da','2011-10-15 23:22:12'),
	(20,2,'d','db','2011-09-15 23:22:12'),
	(21,2,'d','dc','2011-08-15 23:22:12'),
	(22,2,'d','dd','2011-07-15 23:22:12'),
	(23,2,'d','de','2011-06-15 23:22:12'),
	(24,2,'d','df','2011-05-15 23:22:12'),
	(25,2,'e','ea','2011-04-15 23:22:12'),
	(26,2,'e','eb','2011-03-15 23:22:12'),
	(27,2,'e','ec','2011-02-15 23:22:12'),
	(28,2,'e','ed','2011-01-15 23:22:12'),
	(29,2,'e','ee','2010-12-15 23:22:12'),
	(30,2,'e','ef','2010-11-15 23:22:12'),
	(31,2,'f','fa','2010-10-15 23:22:12'),
	(32,2,'f','fb','2010-09-15 23:22:12'),
	(33,2,'f','fc','2010-08-15 23:22:12'),
	(34,2,'f','fd','2010-07-15 23:22:12'),
	(35,2,'f','fe','2010-06-15 23:22:12'),
	(36,2,'f','ff','2010-05-15 23:22:12');

/*!40000 ALTER TABLE `Log` ENABLE KEYS */;
UNLOCK TABLES;


# Dump of table LogArchive
# ------------------------------------------------------------

DROP TABLE IF EXISTS `LogArchive`;

CREATE TABLE `LogArchive` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `user` int(11) DEFAULT NULL,
  `type` varchar(128) COLLATE utf8_unicode_ci NOT NULL,
  `message` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `timestamp` datetime NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_B9D5D3F18D93D649` (`user`),
  CONSTRAINT `FK_B9D5D3F18D93D649` FOREIGN KEY (`user`) REFERENCES `User` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;



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
	(1,'foo','thisUserExists','extant@foo.com','00000000-0000-0000-0000-000000000000','2aa07457c9e340dec1ba76d85935594f',1),
	(2,'foo','you','foo@foo.com','6CA62CA0-5651-40AB-9EFD-43661889224A','2f34c4e9cd3134641fe822277d3f60fd',1),
	(3,'foo','me','foo2@foo.com','FF56D32A-DB4D-4E15-8C4C-29295118A61D','88dde9c20f9ca0759b605cde85af9623',1);

/*!40000 ALTER TABLE `User` ENABLE KEYS */;
UNLOCK TABLES;



/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;
/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
