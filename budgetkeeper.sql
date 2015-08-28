-- MySQL dump 10.13  Distrib 5.5.44, for debian-linux-gnu (i686)
--
-- Host: localhost    Database: budgetkeeper
-- ------------------------------------------------------
-- Server version	5.5.44-0ubuntu0.14.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `default_categories`
--

DROP TABLE IF EXISTS `default_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `default_categories` (
  `category_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `entry_type` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`category_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `default_categories`
--

LOCK TABLES `default_categories` WRITE;
/*!40000 ALTER TABLE `default_categories` DISABLE KEYS */;
/*!40000 ALTER TABLE `default_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entries`
--

DROP TABLE IF EXISTS `entries`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entries` (
  `entry_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `category` int(11) NOT NULL,
  `description` varchar(200) NOT NULL,
  `date` datetime NOT NULL,
  `amount` float NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `entry_type` int(11) NOT NULL,
  `account` int(11) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`entry_id`),
  KEY `FK_entries_users_userid_idx` (`user_id`),
  KEY `FK_entries_entrytypes_entrytype_idx` (`entry_type`),
  CONSTRAINT `FK_entries_entrytypes_entrytype` FOREIGN KEY (`entry_type`) REFERENCES `entry_types` (`entry_type_id`) ON UPDATE CASCADE,
  CONSTRAINT `FK_entries_users_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entries`
--

LOCK TABLES `entries` WRITE;
/*!40000 ALTER TABLE `entries` DISABLE KEYS */;
INSERT INTO `entries` VALUES (1,2,2,'Going Home','2015-08-22 19:20:55',12,1,2,0,'2015-08-22 19:21:27','2015-08-22 11:21:27'),(2,2,2,'Commute to Office','2015-08-27 09:00:00',12,1,2,0,'2015-08-27 09:17:22','2015-08-27 01:17:22'),(3,2,3,'Lunch','2015-08-27 12:00:00',72,1,2,0,'2015-08-27 12:36:03','2015-08-27 04:36:03'),(4,3,4,'going somewhere','2015-08-27 14:15:00',14,1,2,0,'2015-08-27 15:52:59','2015-08-27 07:55:58'),(5,3,5,'gummybear','2015-08-27 14:20:00',66,1,2,0,'2015-08-27 15:54:03','2015-08-27 07:55:58'),(6,3,5,'chicken','2015-08-27 14:31:00',66,1,2,0,'2015-08-27 15:54:23','2015-08-27 07:59:39'),(7,3,4,'uwi','2015-08-27 16:00:00',44,1,2,0,'2015-08-27 15:54:35','2015-08-27 07:54:35'),(8,3,4,'Break','2015-08-27 21:00:00',50,1,2,0,'2015-08-28 14:29:22','2015-08-28 06:29:22');
/*!40000 ALTER TABLE `entries` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `entry_types`
--

DROP TABLE IF EXISTS `entry_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `entry_types` (
  `entry_type_id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `status` int(11) DEFAULT '1',
  PRIMARY KEY (`entry_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `entry_types`
--

LOCK TABLES `entry_types` WRITE;
/*!40000 ALTER TABLE `entry_types` DISABLE KEYS */;
INSERT INTO `entry_types` VALUES (0,'adjustment',0),(1,'income',1),(2,'expenses',1);
/*!40000 ALTER TABLE `entry_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `settings` (
  `settings_id` int(11) NOT NULL AUTO_INCREMENT,
  `description` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`settings_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `settings`
--

LOCK TABLES `settings` WRITE;
/*!40000 ALTER TABLE `settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `settings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `status`
--

DROP TABLE IF EXISTS `status`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `status` (
  `status_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`status_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `status`
--

LOCK TABLES `status` WRITE;
/*!40000 ALTER TABLE `status` DISABLE KEYS */;
INSERT INTO `status` VALUES (0,'disabled / pending'),(1,'enabled / approved'),(2,'deleted / void');
/*!40000 ALTER TABLE `status` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `user_id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(45) NOT NULL,
  `password` varchar(45) NOT NULL,
  `salt` varchar(45) NOT NULL,
  `email` varchar(45) NOT NULL,
  `firstname` varchar(45) NOT NULL,
  `lastname` varchar(45) NOT NULL,
  `status` int(11) NOT NULL DEFAULT '1',
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`user_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','8a8cb7da3e578c220e269a86f48577678e32b3af','fdc44f285','admin@admin.com','admin','admin',0,'2015-08-22 15:25:57','2015-08-22 07:25:57'),(2,'wormi','b9dec9bcd3e3c0a12717f8eadaba76204b101e52','beef3c0a4','iceblast01@gmail.com','Bryan','Co',1,'2015-08-22 18:48:25','2015-08-22 10:48:25'),(3,'dummy','69d689f4b63a2c0bdd50454d639aef265a403067','a746290cb','dummy@dumdum.com','dummy','dumdum',1,'2015-08-27 15:46:30','2015-08-27 07:46:30');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_accounts`
--

DROP TABLE IF EXISTS `users_accounts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_accounts` (
  `users_acounts_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `description` varchar(45) NOT NULL,
  `status` int(11) NOT NULL,
  `isdefault` int(11) NOT NULL,
  `date_created` varchar(45) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`users_acounts_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_accounts`
--

LOCK TABLES `users_accounts` WRITE;
/*!40000 ALTER TABLE `users_accounts` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_accounts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_categories`
--

DROP TABLE IF EXISTS `users_categories`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_categories` (
  `users_categories_id` int(11) NOT NULL AUTO_INCREMENT,
  `user_id` int(11) NOT NULL,
  `description` varchar(100) NOT NULL,
  `entry_type` int(11) NOT NULL,
  `status` int(11) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`users_categories_id`),
  KEY `fk_userscategories_entrytypes_entrytypeid_idx` (`entry_type`),
  KEY `fk_userscategories_users_userid_idx` (`user_id`),
  CONSTRAINT `fk_userscategories_entrytypes_entrytype` FOREIGN KEY (`entry_type`) REFERENCES `entry_types` (`entry_type_id`) ON UPDATE CASCADE,
  CONSTRAINT `fk_userscategories_users_userid` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON UPDATE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_categories`
--

LOCK TABLES `users_categories` WRITE;
/*!40000 ALTER TABLE `users_categories` DISABLE KEYS */;
INSERT INTO `users_categories` VALUES (2,2,'Transportation',2,1,'2015-08-22 18:51:19','2015-08-22 10:51:19'),(3,2,'Food',2,1,'2015-08-22 18:51:39','2015-08-22 10:51:39'),(4,3,'Transportation',2,1,'2015-08-22 18:51:39','2015-08-27 07:47:45'),(5,3,'Food',2,1,'2015-08-22 18:51:39','2015-08-27 07:47:45');
/*!40000 ALTER TABLE `users_categories` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users_settings`
--

DROP TABLE IF EXISTS `users_settings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users_settings` (
  `settings_id` int(11) NOT NULL,
  `users_id` int(11) NOT NULL,
  `value` varchar(100) NOT NULL,
  `status` int(11) NOT NULL,
  `date_modified` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`settings_id`,`users_id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users_settings`
--

LOCK TABLES `users_settings` WRITE;
/*!40000 ALTER TABLE `users_settings` DISABLE KEYS */;
/*!40000 ALTER TABLE `users_settings` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2015-08-28 15:53:50
