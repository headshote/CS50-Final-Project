-- MySQL dump 10.13  Distrib 5.5.28, for Linux (i686)
--
-- Host: localhost    Database: pset7
-- ------------------------------------------------------
-- Server version	5.5.28

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
-- Table structure for table `pmessages`
--

DROP TABLE IF EXISTS `pmessages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pmessages` (
  `tousr` int(10) unsigned NOT NULL,
  `fromusr` int(10) unsigned NOT NULL,
  `date` datetime NOT NULL,
  `msg` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pmessages`
--

LOCK TABLES `pmessages` WRITE;
/*!40000 ALTER TABLE `pmessages` DISABLE KEYS */;
INSERT INTO `pmessages` VALUES (13,14,'2013-03-28 19:46:44','This message is private'),(13,14,'2013-03-28 19:47:10','And his message as well'),(14,12,'2013-03-28 19:49:02','Pst!'),(12,14,'2013-03-28 19:57:22','I\'ll just write this here'),(12,14,'2013-03-29 07:52:28','New private message'),(12,14,'2013-05-12 09:54:15','Ur a faget'),(12,18,'2013-07-09 08:31:22','BOOOOOOOOOOOOOOOOOO');
/*!40000 ALTER TABLE `pmessages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `shares`
--

DROP TABLE IF EXISTS `shares`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `shares` (
  `id` int(10) unsigned NOT NULL,
  `symbol` varchar(255) NOT NULL,
  `shares` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`,`symbol`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `shares`
--

LOCK TABLES `shares` WRITE;
/*!40000 ALTER TABLE `shares` DISABLE KEYS */;
INSERT INTO `shares` VALUES (1,'DVA',15),(7,'A',10),(7,'AAPL',12),(7,'R',23),(10,'A',41),(10,'DVA',21),(10,'DVN',1337),(10,'S',12),(15,'AAPL',10),(15,'GOOG',1);
/*!40000 ALTER TABLE `shares` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `hash` varchar(255) NOT NULL,
  `cash` decimal(65,4) unsigned NOT NULL DEFAULT '0.0000',
  `email` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=19 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'caesar','$1$50$GHABNWBNE/o4VL7QjmQ6x0',10000.0000,NULL),(2,'cs50','$1$50$ceNa7BV5AoVQqilACNLuC1',10000.0000,NULL),(3,'jharvard','$1$50$RX3wnAMNrGIbgzbRYrxM1/',10000.0000,NULL),(4,'malan','$1$HA$azTGIMVlmPi9W9Y12cYSj/',10000.0000,NULL),(5,'nate','$1$50$sUyTaTbiSKVPZCpjJckan0',10000.0000,NULL),(6,'rbowden','$1$50$lJS9HiGK6sphej8c4bnbX.',10000.0000,NULL),(7,'skroob','$1$50$euBi4ugiJmbpIbvTTfmfI.',3132.9600,NULL),(8,'tmacwilliam','$1$50$91ya4AroFPepdLpiX.bdP1',10000.0000,NULL),(9,'zamyla','$1$50$Suq.MOtQj51maavfKvFsW1',10000.0000,NULL),(12,'brucewayne','$1$mKSJUmSh$M3DtkmbayxcSy17pSUFox1',12000000.0000,NULL),(13,'usr','$1$U95w1UTH$3mMqRhvBtGyvnCfeQZ.Uv.',12000.0000,NULL),(14,'eric2063','$1$SA24n4q5$H3S7hIHDbftS/J.GqeOXL1',12000.0000,'eric2063@mail.ru'),(15,'newb','$1$AUY5YKb0$tygOp8IZLRoAid3ssTT1K0',6635.0100,NULL),(16,'gawk','$1$TCIGWmBu$rVKNLlEj5XQdyOfk8dHYe1',12000.0000,'gawk-super@mail.ru'),(17,'trash','$1$Ye72Ipw0$1Et/49DGpcQIe1ogRBc4M1',12000.0000,NULL),(18,'tmp','$1$Q0Cn9Ayj$jHpcr5sv8iBEl2pvtW.vg/',12000.0000,NULL);
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2013-07-09  8:46:42
