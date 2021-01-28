-- MySQL dump 10.13  Distrib 8.0.19, for osx10.12 (x86_64)
--
-- Host: localhost    Database: Camagru
-- ------------------------------------------------------
-- Server version	8.0.19

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
SET TIME_ZONE='+00:00';
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `CommentLikes`
--

DROP TABLE IF EXISTS `CommentLikes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `CommentLikes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `cid` int unsigned NOT NULL,
  `uid` int unsigned NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `CommentLikes`
--

LOCK TABLES `CommentLikes` WRITE;
/*!40000 ALTER TABLE `CommentLikes` DISABLE KEYS */;
/*!40000 ALTER TABLE `CommentLikes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Comments`
--

DROP TABLE IF EXISTS `Comments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Comments` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uid` int unsigned NOT NULL,
  `pid` int unsigned NOT NULL,
  `Comment` varchar(255) NOT NULL,
  `likes` int unsigned NOT NULL DEFAULT '0',
  `Date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Comments`
--

LOCK TABLES `Comments` WRITE;
/*!40000 ALTER TABLE `Comments` DISABLE KEYS */;
/*!40000 ALTER TABLE `Comments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `PostLikes`
--

DROP TABLE IF EXISTS `PostLikes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `PostLikes` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `pid` int unsigned NOT NULL,
  `uid` int unsigned NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `PostLikes`
--

LOCK TABLES `PostLikes` WRITE;
/*!40000 ALTER TABLE `PostLikes` DISABLE KEYS */;
/*!40000 ALTER TABLE `PostLikes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Posts`
--

DROP TABLE IF EXISTS `Posts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Posts` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `uid` int unsigned NOT NULL,
  `link` varchar(200) NOT NULL,
  `likes` int unsigned NOT NULL DEFAULT '0',
  `Date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Posts`
--

LOCK TABLES `Posts` WRITE;
/*!40000 ALTER TABLE `Posts` DISABLE KEYS */;
/*!40000 ALTER TABLE `Posts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `Users`
--

DROP TABLE IF EXISTS `Users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `Users` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `login` varchar(20) NOT NULL,
  `firstname` varchar(20) NOT NULL,
  `lastname` varchar(20) NOT NULL,
  `photoid` int unsigned NOT NULL DEFAULT '0',
  `email` varchar(50) NOT NULL,
  `active` enum('true','false') NOT NULL DEFAULT 'false',
  `notif` enum('true','false') NOT NULL DEFAULT 'true',
  `pwd` varchar(255) NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `Users`
--

LOCK TABLES `Users` WRITE;
/*!40000 ALTER TABLE `Users` DISABLE KEYS */;
INSERT INTO `Users` VALUES (1,'ali-zaynoune','ali','ali',0,'ali@ali.com','false','false','b0c0f1cbe3c345594e6e2df6133d812ef2868e5875a6ac7bb9ff0f1e1474ecbe3f876503ef115de937551a3d114afd476b845e10d9b0c56cf65ade294e1e44dc','2021-01-25 17:26:02'),(2,'ali-zaynoune2','ali','zaynoune',0,'simo@simo.com','false','false','ee099310b7f4ee7e32b03ce73493065ff9fcc69a88131b6c876d52e776025bec94c836a75bb840bad579b33313d1edde0c96cfcba3490319d95c348e245a5bcc','2021-01-26 10:45:21'),(3,'alizaynoune','ali','zaynoune',0,'simo@simo.com2','false','false','b0c0f1cbe3c345594e6e2df6133d812ef2868e5875a6ac7bb9ff0f1e1474ecbe3f876503ef115de937551a3d114afd476b845e10d9b0c56cf65ade294e1e44dc','2021-01-26 10:48:44'),(4,'alializaynoun','ali','zaynoune',0,'ali@ali.ma','false','false','b0c0f1cbe3c345594e6e2df6133d812ef2868e5875a6ac7bb9ff0f1e1474ecbe3f876503ef115de937551a3d114afd476b845e10d9b0c56cf65ade294e1e44dc','2021-01-26 10:57:44');
/*!40000 ALTER TABLE `Users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2021-01-27 14:35:28