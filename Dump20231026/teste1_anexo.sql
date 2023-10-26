-- MySQL dump 10.13  Distrib 8.0.34, for Win64 (x86_64)
--
-- Host: localhost    Database: teste1
-- ------------------------------------------------------
-- Server version	8.0.34

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `anexo`
--

DROP TABLE IF EXISTS `anexo`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `anexo` (
  `id` int NOT NULL AUTO_INCREMENT,
  `tarefa_id` int DEFAULT NULL,
  `nome` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `arquivo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_CD7EAF2C78217710` (`tarefa_id`),
  CONSTRAINT `FK_CD7EAF2C78217710` FOREIGN KEY (`tarefa_id`) REFERENCES `tarefas` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=26 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `anexo`
--

LOCK TABLES `anexo` WRITE;
/*!40000 ALTER TABLE `anexo` DISABLE KEYS */;
INSERT INTO `anexo` VALUES (1,NULL,'tes','C:\\Users\\Guilherme\\AppData\\Local\\Temp\\php1B3C.tmp'),(9,1,NULL,'C:\\Users\\Guilherme\\AppData\\Local\\Temp\\php71A6.tmp'),(10,2,'pdf','C:\\Users\\Guilherme\\AppData\\Local\\Temp\\phpB068.tmp'),(11,2,'pdf','C:\\Users\\Guilherme\\AppData\\Local\\Temp\\php6ED.tmp'),(12,2,'pdf','C:\\Users\\Guilherme\\AppData\\Local\\Temp\\phpE7AD.tmp'),(13,2,'tes','C:\\Users\\Guilherme\\AppData\\Local\\Temp\\phpCB31.tmp'),(16,7,'Anexo psor','C:\\Users\\Guilherme\\AppData\\Local\\Temp\\phpEF78.tmp'),(17,7,'Anexo psor','C:\\Users\\Guilherme\\AppData\\Local\\Temp\\php7080.tmp'),(18,7,'Anexo psor','C:\\Users\\Guilherme\\AppData\\Local\\Temp\\php1869.tmp'),(19,7,'Anexo psor','C:\\Users\\Guilherme\\AppData\\Local\\Temp\\phpB850.tmp'),(20,7,'Anexo psor','C:\\Users\\Guilherme\\AppData\\Local\\Temp\\phpE884.tmp'),(21,7,'Anexo teste','C:\\Users\\Guilherme\\AppData\\Local\\Temp\\phpA686.tmp'),(23,1,'pdf','e3e5e81768246e1195b77254e7877235.pdf'),(24,1,'pdf´gui','567df030215483dc9ad8a658d28061c8.pdf');
/*!40000 ALTER TABLE `anexo` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2023-10-26 19:22:10
