-- MySQL dump 10.13  Distrib 8.0.25, for Win64 (x86_64)
--
-- Host: localhost    Database: meetings
-- ------------------------------------------------------
-- Server version	8.0.25

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8mb4 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `badges`
--

DROP TABLE IF EXISTS `badges`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `badges` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint unsigned NOT NULL,
  `score_id` bigint unsigned NOT NULL,
  `issued_at` datetime NOT NULL,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `badges`
--

LOCK TABLES `badges` WRITE;
/*!40000 ALTER TABLE `badges` DISABLE KEYS */;
/*!40000 ALTER TABLE `badges` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `clubs`
--

DROP TABLE IF EXISTS `clubs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `clubs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `area` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `clubs_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clubs`
--

LOCK TABLES `clubs` WRITE;
/*!40000 ALTER TABLE `clubs` DISABLE KEYS */;
INSERT INTO `clubs` VALUES (1,'Rotary Club Langata (RCL)','Rotary Club Langata (RCL)','Nairobi, Langata',NULL,NULL);
/*!40000 ALTER TABLE `clubs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `contacts`
--

DROP TABLE IF EXISTS `contacts`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `contacts` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `contact_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contactable_id` bigint unsigned NOT NULL,
  `default` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `contacts_contact_unique` (`contact`),
  KEY `contacts_contactable_type_contactable_id_index` (`contactable_type`,`contactable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=311 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `contacts`
--

LOCK TABLES `contacts` WRITE;
/*!40000 ALTER TABLE `contacts` DISABLE KEYS */;
INSERT INTO `contacts` VALUES (7,'email','kevin@email.com','App\\Models\\Guest',2,1,'2022-08-02 10:48:54','2022-08-02 10:48:54'),(8,'phone','1291','App\\Models\\Guest',2,1,'2022-08-02 10:48:54','2022-08-02 10:48:54'),(13,'email','winne.gor@gmail.com','App\\Models\\Member',3,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(14,'phone','726811010','App\\Models\\Member',3,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(15,'email','aabsaloms@gmail.com','App\\Models\\Member',4,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(16,'phone','721602570','App\\Models\\Member',4,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(17,'email','mcalosa@gmail.com','App\\Models\\Member',5,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(18,'phone','721393042','App\\Models\\Member',5,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(19,'email','rozzyanyim@gmail.com','App\\Models\\Member',6,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(20,'phone','713235981','App\\Models\\Member',6,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(21,'email','nickbore@bidii.com','App\\Models\\Member',7,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(22,'phone','733630920','App\\Models\\Member',7,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(23,'email','Wedgettboyi@yahoo.co.uk','App\\Models\\Member',8,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(24,'phone','763407258','App\\Models\\Member',8,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(25,'email','bchacha@gmail.com','App\\Models\\Member',9,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(26,'phone','723339178','App\\Models\\Member',9,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(27,'email','susan.w.chege@gmail.com','App\\Models\\Member',10,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(28,'phone','722267562','App\\Models\\Member',10,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(29,'email','simbachikarango@gmail.com','App\\Models\\Member',11,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(30,'phone','718454161','App\\Models\\Member',11,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(31,'email','yvonnedellag@gmail.com','App\\Models\\Member',12,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(32,'phone','724576982','App\\Models\\Member',12,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(33,'email','aesikhaty@gmail.com','App\\Models\\Member',13,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(34,'phone','722973391','App\\Models\\Member',13,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(35,'email','abdi.dubat@hotmail.co.uk','App\\Models\\Member',14,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(36,'phone','718944466','App\\Models\\Member',14,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(37,'email','jannet.w.gachoya@gmail.com','App\\Models\\Member',15,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(38,'phone','704462826','App\\Models\\Member',15,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(39,'email','mauricegachuhi@gmail.com','App\\Models\\Member',16,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(40,'phone','722587187','App\\Models\\Member',16,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(41,'email','june@jgipconsultants.co.ke','App\\Models\\Member',17,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(42,'phone','722956555','App\\Models\\Member',17,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(43,'email','faith@youngengineers.co.ke','App\\Models\\Member',18,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(44,'phone','722338954','App\\Models\\Member',18,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(45,'email','maina.gichohi@gmail.com','App\\Models\\Member',19,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(46,'phone','722974142','App\\Models\\Member',19,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(47,'email','fuigichuhi@yahoo.com','App\\Models\\Member',20,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(48,'phone','722716256','App\\Models\\Member',20,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(49,'email','gikonyog@yahoo.com','App\\Models\\Member',21,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(50,'phone','728886353','App\\Models\\Member',21,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(51,'email','jeffgitau2000@yahoo.com','App\\Models\\Member',22,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(52,'phone','722550625','App\\Models\\Member',22,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(53,'email','mgithiaka@izonsystems.co.ke','App\\Models\\Member',23,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(54,'phone','722519972','App\\Models\\Member',23,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(55,'email','tony0991@gmail.com','App\\Models\\Member',24,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(56,'phone','723547584','App\\Models\\Member',24,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(57,'email','agithui@gmail.com','App\\Models\\Member',25,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(58,'phone','722732649','App\\Models\\Member',25,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(59,'email','kabichongina@gmail.com','App\\Models\\Member',26,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(60,'phone','723655133','App\\Models\\Member',26,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(61,'email','migwecharlene@gmail.com','App\\Models\\Member',27,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(62,'phone','729533560','App\\Models\\Member',27,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(63,'email','kanaga.fg@gmail.com','App\\Models\\Member',28,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(64,'phone','734776413','App\\Models\\Member',28,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(65,'email','dixon@tiramid.com','App\\Models\\Member',29,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(66,'phone','724234331','App\\Models\\Member',29,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(67,'email','marion_karanja@yahoo.com','App\\Models\\Member',30,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(68,'phone','722780522','App\\Models\\Member',30,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(69,'email','Mururu46@gmail.com','App\\Models\\Member',31,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(70,'phone','719701346','App\\Models\\Member',31,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(71,'email',' Kariuki.kui@gmail.com','App\\Models\\Member',32,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(72,'phone','722154742','App\\Models\\Member',32,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(73,'email','dnkaris@gmail.com','App\\Models\\Member',33,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(74,'phone','722517979','App\\Models\\Member',33,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(75,'email','pskariuki@gmail.com','App\\Models\\Member',34,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(76,'phone','722521659','App\\Models\\Member',34,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(77,'email','jkibati@gmail.com','App\\Models\\Member',35,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(78,'phone','722200737','App\\Models\\Member',35,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(79,'email','mutulakilonzojr@icloud.com','App\\Models\\Member',36,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(80,'phone','722474695','App\\Models\\Member',36,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(81,'email','solikiluta@gmail.com','App\\Models\\Member',37,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(82,'phone','722517845','App\\Models\\Member',37,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(83,'email','mkimani@mgkconsult.co.ke','App\\Models\\Member',38,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(84,'phone','722710450','App\\Models\\Member',38,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(85,'email','wangarikimani.n@gmail.com','App\\Models\\Member',39,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(86,'phone','726712699','App\\Models\\Member',39,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(87,'email','mking52@yahoo.com','App\\Models\\Member',40,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(88,'phone','727029475','App\\Models\\Member',40,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(89,'email','kiptanui.ken@gmail.com','App\\Models\\Member',41,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(90,'phone','726724333','App\\Models\\Member',41,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(91,'email','sheilakoks@gmail.com','App\\Models\\Member',42,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(92,'phone','722245335','App\\Models\\Member',42,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(93,'email','jlabi1@yahoo.com','App\\Models\\Member',43,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(94,'phone','722791984','App\\Models\\Member',43,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(95,'email','talk2moka@gmail.com','App\\Models\\Member',44,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(96,'phone','715459584','App\\Models\\Member',44,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(97,'email','jaylavuna@yahoo.com','App\\Models\\Member',45,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(98,'phone','725448469','App\\Models\\Member',45,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(99,'email','lugads@gmail.com','App\\Models\\Member',46,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(100,'phone','722843135','App\\Models\\Member',46,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(101,'email','xmadara@yahoo.com','App\\Models\\Member',47,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(102,'phone','2348130000000','App\\Models\\Member',47,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(103,'email','akmaina46@gmail.com','App\\Models\\Member',48,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(104,'phone','722202020','App\\Models\\Member',48,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(105,'email','wachiramaina08@gmail.com','App\\Models\\Member',49,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(106,'phone','722230348','App\\Models\\Member',49,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(107,'email','sheilamaingi@gmail.com','App\\Models\\Member',50,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(108,'phone','724570969','App\\Models\\Member',50,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(109,'email','Kizito@turnkeyafrica.com','App\\Models\\Member',51,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(110,'phone','722516807','App\\Models\\Member',51,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(111,'email','karenmakau@gmail.com','App\\Models\\Member',52,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(112,'phone','725544401','App\\Models\\Member',52,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(113,'email','emilymanjeru@gmail.com','App\\Models\\Member',53,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(114,'phone','724926269','App\\Models\\Member',53,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(115,'email','jacquemapesa@gmail.com','App\\Models\\Member',54,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(116,'phone','780604000','App\\Models\\Member',54,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(117,'email','muchai.mathare@gmail.com','App\\Models\\Member',55,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(118,'phone','722788413','App\\Models\\Member',55,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(119,'email','joymbatia@rocketmail.com','App\\Models\\Member',56,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(120,'phone','739279342','App\\Models\\Member',56,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(121,'email','paveenmbeda@yahoo.com','App\\Models\\Member',57,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(122,'phone','701678275','App\\Models\\Member',57,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(123,'email','bashirmburu@gmail.com','App\\Models\\Member',58,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(124,'phone','720722722','App\\Models\\Member',58,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(125,'email','loracmburu@gmail.com','App\\Models\\Member',59,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(126,'phone','722891098','App\\Models\\Member',59,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(127,'email','sarah@protelstudios.com','App\\Models\\Member',60,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(128,'phone','722892559','App\\Models\\Member',60,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(129,'email','amitaru@yahoo.com','App\\Models\\Member',61,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(130,'phone','720927664','App\\Models\\Member',61,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(131,'email','sailepu@gmail.com','App\\Models\\Member',62,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(132,'phone','721951401','App\\Models\\Member',62,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(133,'email','anniemuchai@gmail.com','App\\Models\\Member',63,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(134,'phone','725333391','App\\Models\\Member',63,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(135,'email','mona.nya@octoberconsult.com','App\\Models\\Member',64,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(136,'phone','789356912','App\\Models\\Member',64,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(137,'email','emugo2001@gmail.com','App\\Models\\Member',65,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(138,'phone','722522651','App\\Models\\Member',65,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(139,'email','nzilani90@gmail.com','App\\Models\\Member',66,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(140,'phone','725624460','App\\Models\\Member',66,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(141,'email','cinjumuiruri@gmail.com','App\\Models\\Member',67,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(142,'phone','713639325','App\\Models\\Member',67,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(143,'email','mumbimot@gmail.com','App\\Models\\Member',68,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(144,'phone','722370054','App\\Models\\Member',68,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(145,'email','timothy.mungoma@gmail.com','App\\Models\\Member',69,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(146,'phone','723729842','App\\Models\\Member',69,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(147,'email','wanjajoyce@gmail.com','App\\Models\\Member',70,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(148,'phone','721466267','App\\Models\\Member',70,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(149,'email','tpatiencewairimu@gmail.com','App\\Models\\Member',71,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(150,'phone','703106546','App\\Models\\Member',71,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(151,'email','gnmurichu@gmail.com','App\\Models\\Member',72,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(152,'phone','722729419','App\\Models\\Member',72,1,'2022-08-03 12:35:54','2022-08-03 12:35:54'),(153,'email','murugiimmaculate@gmail.com','App\\Models\\Member',73,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(154,'phone','711349771','App\\Models\\Member',73,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(155,'email','joe.musangi@hotmail.com','App\\Models\\Member',74,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(156,'phone','722719395','App\\Models\\Member',74,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(157,'email','mashmutero@yahoo.com','App\\Models\\Member',75,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(158,'phone','722636119','App\\Models\\Member',75,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(159,'email','joshmuthii@gmail.com','App\\Models\\Member',76,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(160,'phone','722981614','App\\Models\\Member',76,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(161,'email','kateeimuts@yahoo.com','App\\Models\\Member',77,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(162,'phone','722850808','App\\Models\\Member',77,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(163,'email','mercy_mutua@yahoo.com ','App\\Models\\Member',78,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(164,'phone','721486351','App\\Models\\Member',78,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(165,'email','qalibmanagement@gmail.com','App\\Models\\Member',79,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(166,'phone','722634633','App\\Models\\Member',79,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(167,'email','mwongeli1@gmail.com','App\\Models\\Member',80,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(168,'phone','720331109','App\\Models\\Member',80,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(169,'email','immacq@gmail.com','App\\Models\\Member',81,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(170,'phone','724351995','App\\Models\\Member',81,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(171,'email','fmgambi@gmail.com','App\\Models\\Member',82,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(172,'phone','720966396','App\\Models\\Member',82,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(173,'email','alexandra.ndirango@gmail.com','App\\Models\\Member',83,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(174,'phone','727843853','App\\Models\\Member',83,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(175,'email','ndirangudennis2@gmail.com','App\\Models\\Member',84,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(176,'phone','715679583','App\\Models\\Member',84,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(177,'email','ndiritugs@gmail.com','App\\Models\\Member',85,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(178,'phone','722341208','App\\Models\\Member',85,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(179,'email','marieroseod@yahoo.com','App\\Models\\Member',86,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(180,'phone','727797678','App\\Models\\Member',86,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(181,'email','munyiva.ngile@gmail.com','App\\Models\\Member',87,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(182,'phone','720279158','App\\Models\\Member',87,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(183,'email','mnjenga_w@yahoo.com','App\\Models\\Member',88,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(184,'phone','722996767','App\\Models\\Member',88,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(185,'email','mainanjonjo@yahoo.co.uk','App\\Models\\Member',89,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(186,'phone','722843346','App\\Models\\Member',89,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(187,'email','dmnjoroge@gmail.com','App\\Models\\Member',90,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(188,'phone','763958823','App\\Models\\Member',90,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(189,'email','gnjokinjoroge@gmail.com','App\\Models\\Member',91,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(190,'phone','719756838','App\\Models\\Member',91,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(191,'email','rosalidn@gmail.com','App\\Models\\Member',92,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(192,'phone','722705077','App\\Models\\Member',92,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(193,'email','Snjoroge2001@yahoo.com','App\\Models\\Member',93,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(194,'phone','722247701','App\\Models\\Member',93,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(195,'email','ennjoroge@icloud.com','App\\Models\\Member',94,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(196,'phone','737431046','App\\Models\\Member',94,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(197,'email','oscar.njuguna@gmail.com','App\\Models\\Member',95,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(198,'phone','721901111','App\\Models\\Member',95,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(199,'email','anyaga@parapetcleaning.com','App\\Models\\Member',96,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(200,'phone','722521824','App\\Models\\Member',96,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(201,'email','jimjustusnyamu@gmail.com','App\\Models\\Member',97,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(202,'phone','723398190','App\\Models\\Member',97,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(203,'email','nyeretseannesimone@gmail.com','App\\Models\\Member',98,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(204,'phone','790254496','App\\Models\\Member',98,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(205,'email','obino.christie@gmail.com','App\\Models\\Member',99,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(206,'phone','721601859','App\\Models\\Member',99,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(207,'email','berryliman@gmail.com','App\\Models\\Member',100,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(208,'phone','721898039','App\\Models\\Member',100,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(209,'email','davinciodida@yahoo.co.uk','App\\Models\\Member',101,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(210,'phone','728231745','App\\Models\\Member',101,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(211,'email','khamuruogana@gmail.com','App\\Models\\Member',102,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(212,'phone','711464354','App\\Models\\Member',102,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(213,'email','Ogollachristian@yahoo.co.uk','App\\Models\\Member',103,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(214,'phone','722222756','App\\Models\\Member',103,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(215,'email','annemkan@gmail.com','App\\Models\\Member',104,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(216,'phone','723600139','App\\Models\\Member',104,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(217,'email','okujaallan@gmail.com','App\\Models\\Member',105,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(218,'phone','700366548','App\\Models\\Member',105,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(219,'email','carol.olby@gmail.com','App\\Models\\Member',106,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(220,'phone','717968342','App\\Models\\Member',106,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(221,'email','nashon.omondi@hsc.co.ke','App\\Models\\Member',107,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(222,'phone','722410798','App\\Models\\Member',107,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(223,'email','janetonyango@gmail.com','App\\Models\\Member',108,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(224,'phone','722606731','App\\Models\\Member',108,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(225,'email','winnie.opuch@gmail.com','App\\Models\\Member',109,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(226,'phone','729275042','App\\Models\\Member',109,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(227,'email','otiendejulie@yahoo.com','App\\Models\\Member',110,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(228,'phone','722263073','App\\Models\\Member',110,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(229,'email','nyangiouma12@yahoo.com','App\\Models\\Member',111,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(230,'phone','721818879','App\\Models\\Member',111,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(231,'email','esangoro@gmail.com','App\\Models\\Member',112,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(232,'phone','722678070','App\\Models\\Member',112,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(233,'email','banda.doreen@outlook.com','App\\Models\\Member',113,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(234,'phone','726764704','App\\Models\\Member',113,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(235,'email','quinterakinyi4@gmail.com','App\\Models\\Member',114,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(236,'phone','733935100','App\\Models\\Member',114,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(237,'email','oorachier@gmail.com','App\\Models\\Member',115,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(238,'phone','722679083','App\\Models\\Member',115,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(239,'email','junjoroge@gmail.com','App\\Models\\Member',116,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(240,'phone','721807942','App\\Models\\Member',116,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(241,'email','gachinuj@gmail.com','App\\Models\\Member',117,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(242,'phone','715496742','App\\Models\\Member',117,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(243,'email','vivianperose@yahoo.com','App\\Models\\Member',118,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(244,'phone','722799202','App\\Models\\Member',118,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(245,'email','tonytukai@gmail.com','App\\Models\\Member',119,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(246,'phone','700120156','App\\Models\\Member',119,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(247,'email','tony.wachira@gmail.com','App\\Models\\Member',120,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(248,'phone','721491095','App\\Models\\Member',120,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(249,'email','Samuel.Kamau@kenindus.com','App\\Models\\Member',121,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(250,'phone','708194377','App\\Models\\Member',121,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(251,'email','josphat.wagura@yahoo.com','App\\Models\\Member',122,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(252,'phone','722272543','App\\Models\\Member',122,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(253,'email','andrew.wainaina@gmail.com','App\\Models\\Member',123,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(254,'phone','726632554','App\\Models\\Member',123,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(255,'email','wambui.wainaina@gmail.com','App\\Models\\Member',124,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(256,'phone','729809289','App\\Models\\Member',124,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(257,'email','wanjiku@wanjiku.pro','App\\Models\\Member',125,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(258,'phone','722514310','App\\Models\\Member',125,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(259,'email','swaithaka@gmail.com','App\\Models\\Member',126,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(260,'phone','722622158','App\\Models\\Member',126,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(261,'email','rwakaba@gmail.com','App\\Models\\Member',127,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(262,'phone','721215251','App\\Models\\Member',127,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(263,'email','wnjeri81@gmail.com','App\\Models\\Member',128,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(264,'phone','721449617','App\\Models\\Member',128,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(265,'email','isaacwanjero@yahoo.com','App\\Models\\Member',129,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(266,'phone','710822111','App\\Models\\Member',129,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(267,'email','josephatwaweru@rocketmail.com','App\\Models\\Member',130,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(268,'phone','721902450','App\\Models\\Member',130,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(269,'email','Katamajw@gmail.com','App\\Models\\Member',131,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(270,'phone','725829699','App\\Models\\Member',131,1,'2022-08-03 12:35:55','2022-08-03 12:35:55'),(271,'email','j@email.com','App\\Models\\Guest',3,1,'2022-08-03 13:10:29','2022-08-03 13:10:29'),(272,'phone','09034','App\\Models\\Guest',3,1,'2022-08-03 13:10:29','2022-08-03 13:10:29'),(273,'email','Kks@e.com','App\\Models\\Guest',4,1,'2022-08-03 13:12:23','2022-08-03 13:12:23'),(274,'phone','12013','App\\Models\\Guest',4,1,'2022-08-03 13:12:23','2022-08-03 13:12:23'),(275,'email','e@email.com','App\\Models\\Guest',5,1,'2022-08-03 13:14:26','2022-08-03 13:14:26'),(276,'phone','9123','App\\Models\\Guest',5,1,'2022-08-03 13:14:26','2022-08-03 13:14:26'),(279,'email','h@gmail.com','App\\Models\\Guest',7,1,'2022-08-03 19:04:18','2022-08-03 19:04:18'),(280,'phone','232123','App\\Models\\Guest',7,1,'2022-08-03 19:04:18','2022-08-03 19:04:18'),(283,'email','sd@gs.com','App\\Models\\Guest',9,1,'2022-08-03 19:12:24','2022-08-03 19:12:24'),(284,'phone','sld','App\\Models\\Guest',9,1,'2022-08-03 19:12:24','2022-08-03 19:12:24'),(285,'email','asd@g.com','App\\Models\\Guest',10,1,'2022-08-03 19:14:49','2022-08-03 19:14:49'),(286,'phone','sfsfd12','App\\Models\\Guest',10,1,'2022-08-03 19:14:49','2022-08-03 19:14:49'),(287,'email','trial@email.com','App\\Models\\Guest',11,1,'2022-08-04 07:27:30','2022-08-04 07:27:30'),(288,'phone','089','App\\Models\\Guest',11,1,'2022-08-04 07:27:30','2022-08-04 07:27:30'),(289,'email','email@email.com','App\\Models\\Guest',12,1,'2022-08-04 08:38:55','2022-08-04 08:38:55'),(290,'phone','0123','App\\Models\\Guest',12,1,'2022-08-04 08:38:55','2022-08-04 08:38:55'),(307,'email','2@g.com','App\\Models\\Guest',8,1,'2022-08-11 11:19:49','2022-08-11 11:19:49'),(308,'phone','012','App\\Models\\Guest',8,1,'2022-08-11 11:19:49','2022-08-11 11:19:49'),(309,'email','gngina@gmail.com','App\\Models\\Guest',6,1,'2022-08-12 08:58:32','2022-08-12 08:58:32'),(310,'phone','0236','App\\Models\\Guest',6,1,'2022-08-12 08:58:32','2022-08-12 08:58:32');
/*!40000 ALTER TABLE `contacts` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `failed_jobs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`),
  UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `failed_jobs`
--

LOCK TABLES `failed_jobs` WRITE;
/*!40000 ALTER TABLE `failed_jobs` DISABLE KEYS */;
/*!40000 ALTER TABLE `failed_jobs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `grading_rules`
--

DROP TABLE IF EXISTS `grading_rules`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `grading_rules` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `min_minutes` double(8,2) NOT NULL,
  `min_members` int NOT NULL,
  `start_time` time NOT NULL,
  `meeting_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `grading_rules_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `grading_rules`
--

LOCK TABLES `grading_rules` WRITE;
/*!40000 ALTER TABLE `grading_rules` DISABLE KEYS */;
INSERT INTO `grading_rules` VALUES (1,'zoom',30.00,30,'19:00:00','zoom',NULL,NULL),(2,'physical',0.00,0,'19:00:00','physical',NULL,NULL);
/*!40000 ALTER TABLE `grading_rules` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `guests`
--

DROP TABLE IF EXISTS `guests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `guests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'm',
  `field` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT 'none',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `member_id` int unsigned DEFAULT NULL,
  `club_id` int unsigned DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `guests`
--

LOCK TABLES `guests` WRITE;
/*!40000 ALTER TABLE `guests` DISABLE KEYS */;
INSERT INTO `guests` VALUES (2,'Kevin','Kenyan','m','Finance','Rotarian','2022-08-02 10:48:54','2022-08-02 10:48:54',NULL,NULL),(3,'Joe','kE','m','01021','None','2022-08-03 13:10:29','2022-08-03 13:10:29',NULL,NULL),(4,'Jane','sdf','f','FER','Rotarian','2022-08-03 13:12:23','2022-08-03 13:12:23',NULL,NULL),(5,'JSRE','asda','f','saskd','Rotarian','2022-08-03 13:14:26','2022-08-03 13:14:26',NULL,NULL),(6,'Grace','KE','f','Accounts','Rotarian','2022-08-03 19:03:08','2022-08-12 08:58:32',3,1),(7,'Hailey','sfds','f','asda','None','2022-08-03 19:04:18','2022-08-03 19:04:18',NULL,NULL),(8,'Gio','sd','m','Fas','None','2022-08-03 19:09:15','2022-08-03 19:09:15',NULL,NULL),(9,'Jjsas','sdfl','m','12kd','Rotarian','2022-08-03 19:12:24','2022-08-03 19:12:24',NULL,NULL),(10,'ksd','lnsd','f','123 ,d','Rotarian','2022-08-03 19:14:49','2022-08-03 19:14:49',NULL,NULL),(11,'Trial','Trial','f','Trial','Rotarian','2022-08-04 07:27:30','2022-08-04 07:27:30',53,NULL),(12,'Guest','Nation','f','Field','Rotarian','2022-08-04 08:38:55','2022-08-04 08:38:55',16,NULL);
/*!40000 ALTER TABLE `guests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log_setups`
--

DROP TABLE IF EXISTS `log_setups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `log_setups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `model` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event` enum('insertion','deletion','modification') COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `log_setups_model_index` (`model`),
  KEY `log_setups_event_index` (`event`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log_setups`
--

LOCK TABLES `log_setups` WRITE;
/*!40000 ALTER TABLE `log_setups` DISABLE KEYS */;
/*!40000 ALTER TABLE `log_setups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `logs`
--

DROP TABLE IF EXISTS `logs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `logs` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `from` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `to` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `change` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `changeable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `changeable_id` bigint unsigned NOT NULL,
  `user_id` bigint unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `logs_changeable_type_changeable_id_index` (`changeable_type`,`changeable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `logs`
--

LOCK TABLES `logs` WRITE;
/*!40000 ALTER TABLE `logs` DISABLE KEYS */;
/*!40000 ALTER TABLE `logs` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `makeup_requests`
--

DROP TABLE IF EXISTS `makeup_requests`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `makeup_requests` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `makeup_date` date NOT NULL,
  `member_id` bigint unsigned NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `details` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `category` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `approver` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `approval_date` date DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `makeup_requests`
--

LOCK TABLES `makeup_requests` WRITE;
/*!40000 ALTER TABLE `makeup_requests` DISABLE KEYS */;
INSERT INTO `makeup_requests` VALUES (1,'2022-07-25',1,'Desc','Desciption','other',NULL,NULL,'2022-07-28 12:57:09','2022-07-28 12:57:09'),(2,'2022-08-02',1,'P/L','we','other',NULL,NULL,'2022-08-02 08:49:34','2022-08-02 08:49:34'),(3,'2022-08-04',26,'P/L','sad','Committee Meeting',NULL,NULL,'2022-08-04 12:46:04','2022-08-04 12:46:04');
/*!40000 ALTER TABLE `makeup_requests` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `meetings`
--

DROP TABLE IF EXISTS `meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `meetings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `date` datetime NOT NULL,
  `venue` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `topic` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `host` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` text COLLATE utf8mb4_unicode_ci,
  `meeting_no` bigint unsigned DEFAULT NULL,
  `grading_rule_id` bigint unsigned NOT NULL,
  `club_id` bigint unsigned NOT NULL,
  `official_start_time` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `official_end_time` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `gradable` tinyint(1) NOT NULL DEFAULT '0',
  `detail` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `meetings_type_index` (`type`),
  KEY `meetings_topic_index` (`topic`),
  KEY `meetings_meeting_no_index` (`meeting_no`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `meetings`
--

LOCK TABLES `meetings` WRITE;
/*!40000 ALTER TABLE `meetings` DISABLE KEYS */;
INSERT INTO `meetings` VALUES (2,'physical','2022-08-30 00:00:00','Test','Test','Host',NULL,NULL,2,1,'19:00','20:59',1,NULL,'2022-08-02 07:33:46','2022-08-02 07:33:46'),(3,'physical','2022-07-07 00:00:00','test','test','test',NULL,NULL,2,1,'19:00','08:30',1,NULL,'2022-08-04 01:39:52','2022-08-04 01:39:52');
/*!40000 ALTER TABLE `meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `members`
--

DROP TABLE IF EXISTS `members`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `members` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `member_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `nationality` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `field` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `members_member_no_unique` (`member_no`)
) ENGINE=InnoDB AUTO_INCREMENT=132 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `members`
--

LOCK TABLES `members` WRITE;
/*!40000 ALTER TABLE `members` DISABLE KEYS */;
INSERT INTO `members` VALUES (3,'A. Winnie Gor ','11167662','KE','F','Communications and Event Management','2022-08-03 12:35:54','2022-08-03 12:35:54'),(4,'Absaloms Antoinette ','5743361','KE','F','Corporate Legal Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(5,'Alosa Sam ','11065891','KE','M','Law','2022-08-03 12:35:54','2022-08-03 12:35:54'),(6,'Anyim Roselyne ','10589399','KE','F','ICT Banking','2022-08-03 12:35:54','2022-08-03 12:35:54'),(7,'Bore Nicholas ','5985578','KE','M','Petroleum Trading','2022-08-03 12:35:54','2022-08-03 12:35:54'),(8,'Boyi Wedgett ','6679199','KE','F','Financial Services/Banking','2022-08-03 12:35:54','2022-08-03 12:35:54'),(9,'Chacha Bhoke  ','11065896','KE','F','Education','2022-08-03 12:35:54','2022-08-03 12:35:54'),(10,'Chege Susan  ','11065899','KE','F','Human Resource Management','2022-08-03 12:35:54','2022-08-03 12:35:54'),(11,'Chikarango Simbarashe ','8184792','KE','M','Investment Banking','2022-08-03 12:35:54','2022-08-03 12:35:54'),(12,'Della Yvonne  ','11237413','KE','F','Marketing','2022-08-03 12:35:54','2022-08-03 12:35:54'),(13,'Esikhaty Alex ','10282015','KE','M','Aviation','2022-08-03 12:35:54','2022-08-03 12:35:54'),(14,'Fidhow Abdi ','10434457','KE','M','Accounting','2022-08-03 12:35:54','2022-08-03 12:35:54'),(15,'Gachoya Jannet ','10722803','KE','F','Consultant (Strategic Projects/Legal)','2022-08-03 12:35:54','2022-08-03 12:35:54'),(16,'Gachuhi Maurice ','6972341','KE','M','Audit Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(17,'Gachui June ','6153616','KE','F','Intellectual Property Legal Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(18,'Gathungu Faith ','10722790','KE','F','STEM Education','2022-08-03 12:35:54','2022-08-03 12:35:54'),(19,'Gichohi Maina ','6438115','KE','M','Logistics Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(20,'Gichuhi Maureen ','6885574','KE','F','Commodity Trading','2022-08-03 12:35:54','2022-08-03 12:35:54'),(21,'Gikonyo Gitau ','8186229','KE','M','Commercial Law Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(22,'Gitau Geoffrey ','8577005','KE','M','Audit Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(23,'Githiaka Muchau ','5820813','KE','M','IT Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(24,'Githua Antony ','8074000','KE','M','Advertising','2022-08-03 12:35:54','2022-08-03 12:35:54'),(25,'Githui Anita ','8400960','KE','F','Technology Advisory Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(26,'Kabicho Ngina ','10859891','KE','F','Financial Services/Banking','2022-08-03 12:35:54','2022-08-03 12:35:54'),(27,'Kagume Charlene ','11167652','KE','F','Research and Data Consultant','2022-08-03 12:35:54','2022-08-03 12:35:54'),(28,'Kanaga Faith ','10191723','KE','F','Legal Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(29,'Karani Dickson ','9939573','KE','M','IT Cosultancy','2022-08-03 12:35:54','2022-08-03 12:35:54'),(30,'Karanja Marion ','6679195','KE','F','Commercial Litigation','2022-08-03 12:35:54','2022-08-03 12:35:54'),(31,'Karanja Mururu ','10191719','KE','M','Client Relations','2022-08-03 12:35:54','2022-08-03 12:35:54'),(32,'Kariuki Carolyn ','6438112','KE','F','Project Management','2022-08-03 12:35:54','2022-08-03 12:35:54'),(33,'Kariuki David ','8872752','KE','M','Marketing','2022-08-03 12:35:54','2022-08-03 12:35:54'),(34,'Kariuki Peter ','5743213','KE','M','Quantity Survey','2022-08-03 12:35:54','2022-08-03 12:35:54'),(35,'Kibati James ','11222336','KE','M','Aviation','2022-08-03 12:35:54','2022-08-03 12:35:54'),(36,'Kilonzo Mutula ','5820804','KE','M','General Litigation','2022-08-03 12:35:54','2022-08-03 12:35:54'),(37,'Kiluta Soli ','10191714','KE','M','Security Management','2022-08-03 12:35:54','2022-08-03 12:35:54'),(38,'Kimani Michael ','5743253','KE','M','Audit Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(39,'Kimani Wangari ','10434477','KE','F','Sales & Marketing','2022-08-03 12:35:54','2022-08-03 12:35:54'),(40,'Kingori Michael ','9288950','KE','M','Motor Vehicle Engineering','2022-08-03 12:35:54','2022-08-03 12:35:54'),(41,'Kiptoo Kenneth  ','10978246','KE','M','Communication','2022-08-03 12:35:54','2022-08-03 12:35:54'),(42,'Koks Sheila ','10404841','KE','F','Financial Services/Banking','2022-08-03 12:35:54','2022-08-03 12:35:54'),(43,'Labi Jimmy ','9939569','KE','M','ICT & Security Systems','2022-08-03 12:35:54','2022-08-03 12:35:54'),(44,'Lantum Moka ','10457759','KE','M','Medical Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(45,'Lavuna Janet ','8398607','KE','F','Commercial Law Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(46,'Lugadiru Marlon ','9097329','KE','M','IT Hardware','2022-08-03 12:35:54','2022-08-03 12:35:54'),(47,'Madara Rossianna ','10722795','KE','F','Project Management','2022-08-03 12:35:54','2022-08-03 12:35:54'),(48,'Maina Atanas ','5820792','KE','M','Removals/Moving Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(49,'Maina Francis ','8776459','KE','M','Insurance Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(50,'Maingi  Sheila ','11063028','KE','F','Supplies and logistics','2022-08-03 12:35:54','2022-08-03 12:35:54'),(51,'Makatiani Kizito ','6679194','KE','M','Software Solutions','2022-08-03 12:35:54','2022-08-03 12:35:54'),(52,'Makau Karen ','10404840','KE','F','Import Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(53,'Manjeru Emily ','10722793','KE','F','Public Relations','2022-08-03 12:35:54','2022-08-03 12:35:54'),(54,'Mapesa Jacqueline ','10282027','KE','F','Financial Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(55,'Mathare Josphat ','8398601','KE','M','Mobile Telephony','2022-08-03 12:35:54','2022-08-03 12:35:54'),(56,'Mbatia Joy ','11237364','KE','F','Financial Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(57,'Mbeda Paveen ','9825490','KE','F','Programme Management','2022-08-03 12:35:54','2022-08-03 12:35:54'),(58,'Mburu Bashir ','5743205','KE','M','Training Services','2022-08-03 12:35:54','2022-08-03 12:35:54'),(59,'Mburu Caroline ','10097861','KE','F','Financial Services/Banking','2022-08-03 12:35:54','2022-08-03 12:35:54'),(60,'Migwi Sarah ','6184321','KE','F','TV and Radio Production','2022-08-03 12:35:54','2022-08-03 12:35:54'),(61,'Mitaru Anne ','8577003','KE','F','Humanitarian Law','2022-08-03 12:35:54','2022-08-03 12:35:54'),(62,'Montet Sailepu ','6885575','KE','M','Financial Services/Banking','2022-08-03 12:35:54','2022-08-03 12:35:54'),(63,'Muchai Annie ','6972347','KE','F','Environmental Management','2022-08-03 12:35:54','2022-08-03 12:35:54'),(64,'Muchemi Mona ','10282016','KE','F','Project Management Strategy and Operations','2022-08-03 12:35:54','2022-08-03 12:35:54'),(65,'Mugo Edward ','5743227','KE','M','Architecture','2022-08-03 12:35:54','2022-08-03 12:35:54'),(66,'Muia Nzilani ','10859884','KE','F','Marketing','2022-08-03 12:35:54','2022-08-03 12:35:54'),(67,'Muiruri Wambui ','10434480','KE','F','Project Management ','2022-08-03 12:35:54','2022-08-03 12:35:54'),(68,'Mumbi Mary Anne ','10978212','KE','F','Photography','2022-08-03 12:35:54','2022-08-03 12:35:54'),(69,'Mung\'oma Timothy ','11237918','KE','M','ICT','2022-08-03 12:35:54','2022-08-03 12:35:54'),(70,'Muraya Joy ','10282022','KE','F','Health Journalism/Communication','2022-08-03 12:35:54','2022-08-03 12:35:54'),(71,'Mureithi Patience ','9950312','KE','F','Real Estate Valuation and Asset Management','2022-08-03 12:35:54','2022-08-03 12:35:54'),(72,'Murichu Grace ','5743221','KE','F','Supply Chain Management','2022-08-03 12:35:54','2022-08-03 12:35:54'),(73,'Murugi Immaculate ','10097865','KE','F','PR & Communications','2022-08-03 12:35:54','2022-08-03 12:35:54'),(74,'Musangi Joseph ','6091303','KE','M','Research and Administration','2022-08-03 12:35:55','2022-08-03 12:35:55'),(75,'Mutero Jeremy ','6184325','KE','M','Commercial Law Services','2022-08-03 12:35:55','2022-08-03 12:35:55'),(76,'Muthii Joshua ','10282024','KE','M','Sales Management and Training','2022-08-03 12:35:55','2022-08-03 12:35:55'),(77,'Muthusi Ivy ','9288928','KE','F','Marketing','2022-08-03 12:35:55','2022-08-03 12:35:55'),(78,'Mutua Mercy ','6859524','KE','F','Financial Services','2022-08-03 12:35:55','2022-08-03 12:35:55'),(79,'Muturi Elizabeth  ','11237407','KE','F','Sales and Marketing','2022-08-03 12:35:55','2022-08-03 12:35:55'),(80,'Mwaka Edna ','9939577','KE','F','Financial Services/Banking','2022-08-03 12:35:55','2022-08-03 12:35:55'),(81,'Mwake Immaculate ','9939570','KE','F','Financial Services/Banking','2022-08-03 12:35:55','2022-08-03 12:35:55'),(82,'Mwirigi Fred ','8567403','KE','M','Management Lectures','2022-08-03 12:35:55','2022-08-03 12:35:55'),(83,'Ndirango Alexandra ','8544234','KE','F','Financial Services/Banking','2022-08-03 12:35:55','2022-08-03 12:35:55'),(84,'Ndirangu Dennis ','9825486','KE','M','Legal Services ','2022-08-03 12:35:55','2022-08-03 12:35:55'),(85,'Ndiritu Samuel ','6024654','KE','M','Civil Engineering','2022-08-03 12:35:55','2022-08-03 12:35:55'),(86,'Ngesa Rosemary ','10978235','KE','F','Counsellor ','2022-08-03 12:35:55','2022-08-03 12:35:55'),(87,'Ngile Rosana ','10434479','KE','F','Project Management','2022-08-03 12:35:55','2022-08-03 12:35:55'),(88,'Njenga Monica ','6972346','KE','F','Human Resource Management','2022-08-03 12:35:55','2022-08-03 12:35:55'),(89,'Njonjo Maina ','6021771','KE','M','Legal Services ','2022-08-03 12:35:55','2022-08-03 12:35:55'),(90,'Njoroge David  ','11166893','KE','M','Financial Services','2022-08-03 12:35:55','2022-08-03 12:35:55'),(91,'Njoroge Gladys Njoki ','10978226','KE','F','Communication','2022-08-03 12:35:55','2022-08-03 12:35:55'),(92,'Njoroge Rosalid ','10722798','KE','F','Financial Services','2022-08-03 12:35:55','2022-08-03 12:35:55'),(93,'Njoroge Serah ','6679198','KE','F','Private Sector Development','2022-08-03 12:35:55','2022-08-03 12:35:55'),(94,'Njoroge-Muriithi Esther ','10404835','KE','F','Medical Services','2022-08-03 12:35:55','2022-08-03 12:35:55'),(95,'Njuguna Oscar ','6686298','KE','M','Business Development','2022-08-03 12:35:55','2022-08-03 12:35:55'),(96,'Nyaga Alex ','5737359','KE','M','Commercial Cleaning Services','2022-08-03 12:35:55','2022-08-03 12:35:55'),(97,'Nyamu Jim ','10859874','KE','M','WildLife Conservation And Research','2022-08-03 12:35:55','2022-08-03 12:35:55'),(98,'Nyeretse Anne-Simone ','10434442','KE','F','Sales Management','2022-08-03 12:35:55','2022-08-03 12:35:55'),(99,'Obino Christine ','11237399','KE','F','Customer Experience','2022-08-03 12:35:55','2022-08-03 12:35:55'),(100,'Ochieng Berry ','10589403','KE','M','Safety and Quality Assurance','2022-08-03 12:35:55','2022-08-03 12:35:55'),(101,'Odida David ','10282013','KE','M','Aviation','2022-08-03 12:35:55','2022-08-03 12:35:55'),(102,'Ogana Loretta  ','11237453','KE','F','Law','2022-08-03 12:35:55','2022-08-03 12:35:55'),(103,'Ogolla Christian ','8995165','KE','M','Insurance Services','2022-08-03 12:35:55','2022-08-03 12:35:55'),(104,'Okello Anne ','10282026','KE','F','Legal and Business Development','2022-08-03 12:35:55','2022-08-03 12:35:55'),(105,'Okuja Allan ','9499114','KE','M','Financial Services(Audit)','2022-08-03 12:35:55','2022-08-03 12:35:55'),(106,'Olbara Caroline ','8147098','KE','F','Training Services','2022-08-03 12:35:55','2022-08-03 12:35:55'),(107,'Omondi Nashon ','6342337','KE','M','IT Marketing','2022-08-03 12:35:55','2022-08-03 12:35:55'),(108,'Onyango Janet ','6438104','KE','F','Communication Services','2022-08-03 12:35:55','2022-08-03 12:35:55'),(109,'Opuch Winnie ','10282020','KE','F','Civil Engineering','2022-08-03 12:35:55','2022-08-03 12:35:55'),(110,'Otiende Julie ','10585669','KE','F','Financial Services/Banking','2022-08-03 12:35:55','2022-08-03 12:35:55'),(111,'Ouma Beryl ','5743203','KE','F','Commercial Law Services','2022-08-03 12:35:55','2022-08-03 12:35:55'),(112,'Ouma Erick ','9212480','KE','M','Energy Generating Services ','2022-08-03 12:35:55','2022-08-03 12:35:55'),(113,'Outa Doreen ','10434471','KE','F','Legal Services','2022-08-03 12:35:55','2022-08-03 12:35:55'),(114,'Peres Quinter ','8931795','KE','F','Project management','2022-08-03 12:35:55','2022-08-03 12:35:55'),(115,'Rachier Olivia ','11237410','KE','F','Law','2022-08-03 12:35:55','2022-08-03 12:35:55'),(116,'Rienye June ','6050341','KE','F','Legal Services','2022-08-03 12:35:55','2022-08-03 12:35:55'),(117,'Thirima John ','11237916','KE','M','Civil Engineering','2022-08-03 12:35:55','2022-08-03 12:35:55'),(118,'Tsisika Vivian ','8522589','KE','F','Human Resource Management','2022-08-03 12:35:55','2022-08-03 12:35:55'),(119,'Tukai Anthony ','9144820','KE','M','Public Health','2022-08-03 12:35:55','2022-08-03 12:35:55'),(120,'Wachira Anthony ','6859520','KE','M','Insurance Services','2022-08-03 12:35:55','2022-08-03 12:35:55'),(121,'Wachira Sam ','10859870','KE','M','ICT Consultant','2022-08-03 12:35:55','2022-08-03 12:35:55'),(122,'Wagura Josphat ','9825487','KE','M','Accounting','2022-08-03 12:35:55','2022-08-03 12:35:55'),(123,'Wainaina Andrew ','8776465','KE','M','Cyber Security ','2022-08-03 12:35:55','2022-08-03 12:35:55'),(124,'Wainaina Wambui ','9208152','KE','F','Human Resource Management','2022-08-03 12:35:55','2022-08-03 12:35:55'),(125,'Wairia WanjikÃº ','8314237','KE','F','Leadership Strategy','2022-08-03 12:35:55','2022-08-03 12:35:55'),(126,'Waithaka Samson ','10434465','KE','M','Hospitality','2022-08-03 12:35:55','2022-08-03 12:35:55'),(127,'Wakaba Robert ','8398604','KE','M','E-Commerce','2022-08-03 12:35:55','2022-08-03 12:35:55'),(128,'Wambui Elizabeth ','10978243','KE','F','Law','2022-08-03 12:35:55','2022-08-03 12:35:55'),(129,'Wanjero Isaac ','6736090','KE','M','IP Services','2022-08-03 12:35:55','2022-08-03 12:35:55'),(130,'Waweru Josephat ','10859880','KE','M','ICT Consultant','2022-08-03 12:35:55','2022-08-03 12:35:55'),(131,'Waweru Kagema ','10191712','KE','M','HR Security','2022-08-03 12:35:55','2022-08-03 12:35:55');
/*!40000 ALTER TABLE `members` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `migrations` (
  `id` int unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=27 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1),(3,'2019_08_19_000000_create_failed_jobs_table',1),(4,'2019_12_14_000001_create_personal_access_tokens_table',1),(5,'2022_06_08_104750_create_user_types_table',1),(6,'2022_06_08_111442_create_members_table',1),(7,'2022_06_08_112245_create_clubs_table',1),(8,'2022_06_08_114030_create_guests_table',1),(9,'2022_06_08_115900_create_roles_table',1),(10,'2022_06_08_120300_create_role_user_type_pivot_table',1),(11,'2022_06_08_121756_create_permissions_table',1),(12,'2022_06_08_121834_create_permission_role_pivot_table',1),(13,'2022_06_08_122056_create_contacts_table',1),(14,'2022_06_09_112816_create_log_setups_table',1),(15,'2022_06_09_113055_create_logs_table',1),(16,'2022_06_09_113819_create_meetings_table',1),(17,'2022_06_09_155917_create_scores_table',1),(18,'2022_06_10_071651_create_badges_table',1),(19,'2022_06_10_071954_create_grading_rules_table',1),(20,'2022_06_10_072913_create_zoom_users_table',1),(21,'2022_06_10_073046_create_zoom_meetings_table',1),(22,'2022_06_10_074154_create_zoom_setups_table',1),(23,'2022_06_10_075131_create_participants_table',1),(24,'2022_07_21_201845_create_makeup_requests_table',1),(25,'2022_08_04_095956_add_inviter_to_guests_table',2),(26,'2022_08_04_122124_add_club_to_guests_table',3);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `participants`
--

DROP TABLE IF EXISTS `participants`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `participants` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `instance_uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `join_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `leave_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `meeting_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `participants`
--

LOCK TABLES `participants` WRITE;
/*!40000 ALTER TABLE `participants` DISABLE KEYS */;
/*!40000 ALTER TABLE `participants` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
INSERT INTO `password_resets` VALUES ('eric.muga@gmail.com','$2y$10$1ayODpVHaRwy0kuNIY4Eu.NgJuGGfAVb2tPssMHyNG8O1r7skcqQW','2022-08-05 07:11:10');
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permission_role`
--

DROP TABLE IF EXISTS `permission_role`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permission_role` (
  `permission_id` bigint unsigned NOT NULL,
  `role_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`permission_id`,`role_id`),
  KEY `permission_role_permission_id_index` (`permission_id`),
  KEY `permission_role_role_id_index` (`role_id`),
  CONSTRAINT `permission_role_permission_id_foreign` FOREIGN KEY (`permission_id`) REFERENCES `permissions` (`id`) ON DELETE CASCADE,
  CONSTRAINT `permission_role_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permission_role`
--

LOCK TABLES `permission_role` WRITE;
/*!40000 ALTER TABLE `permission_role` DISABLE KEYS */;
/*!40000 ALTER TABLE `permission_role` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissions`
--

DROP TABLE IF EXISTS `permissions`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `permissions` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissions`
--

LOCK TABLES `permissions` WRITE;
/*!40000 ALTER TABLE `permissions` DISABLE KEYS */;
/*!40000 ALTER TABLE `permissions` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `personal_access_tokens`
--

DROP TABLE IF EXISTS `personal_access_tokens`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `personal_access_tokens` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint unsigned NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `personal_access_tokens`
--

LOCK TABLES `personal_access_tokens` WRITE;
/*!40000 ALTER TABLE `personal_access_tokens` DISABLE KEYS */;
/*!40000 ALTER TABLE `personal_access_tokens` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `role_user_type`
--

DROP TABLE IF EXISTS `role_user_type`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `role_user_type` (
  `role_id` bigint unsigned NOT NULL,
  `user_type_id` bigint unsigned NOT NULL,
  PRIMARY KEY (`role_id`,`user_type_id`),
  KEY `role_user_type_role_id_index` (`role_id`),
  KEY `role_user_type_user_type_id_index` (`user_type_id`),
  CONSTRAINT `role_user_type_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE,
  CONSTRAINT `role_user_type_user_type_id_foreign` FOREIGN KEY (`user_type_id`) REFERENCES `user_types` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `role_user_type`
--

LOCK TABLES `role_user_type` WRITE;
/*!40000 ALTER TABLE `role_user_type` DISABLE KEYS */;
/*!40000 ALTER TABLE `role_user_type` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `roles` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `roles_name_unique` (`name`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `scores`
--

DROP TABLE IF EXISTS `scores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `scores` (
  `meeting_id` bigint unsigned NOT NULL,
  `attendable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `attendable_id` bigint unsigned NOT NULL,
  `present` tinyint(1) NOT NULL,
  `time_score` double(8,2) NOT NULL,
  UNIQUE KEY `1` (`attendable_type`,`attendable_id`,`meeting_id`),
  KEY `scores_attendable_type_attendable_id_index` (`attendable_type`,`attendable_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `scores`
--

LOCK TABLES `scores` WRITE;
/*!40000 ALTER TABLE `scores` DISABLE KEYS */;
INSERT INTO `scores` VALUES (2,'App\\Models\\Guest',2,1,0.00),(2,'App\\Models\\Guest',3,1,0.00),(2,'App\\Models\\Guest',5,1,0.00),(2,'App\\Models\\Guest',6,1,0.00),(2,'App\\Models\\Guest',7,1,0.00),(2,'App\\Models\\Guest',8,1,0.00),(3,'App\\Models\\Guest',8,1,0.00),(2,'App\\Models\\Member',3,1,0.00),(2,'App\\Models\\Member',4,1,0.00),(2,'App\\Models\\Member',5,1,0.00),(2,'App\\Models\\Member',6,1,0.00),(2,'App\\Models\\Member',7,1,0.00),(2,'App\\Models\\Member',8,1,0.00),(2,'App\\Models\\Member',9,1,0.00),(2,'App\\Models\\Member',10,1,0.00),(2,'App\\Models\\Member',12,1,0.00),(2,'App\\Models\\Member',24,1,0.00),(2,'App\\Models\\Member',25,1,0.00),(2,'App\\Models\\Member',26,1,0.00);
/*!40000 ALTER TABLE `scores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_types`
--

DROP TABLE IF EXISTS `user_types`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `user_types` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `user_types_name_unique` (`name`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_types`
--

LOCK TABLES `user_types` WRITE;
/*!40000 ALTER TABLE `user_types` DISABLE KEYS */;
INSERT INTO `user_types` VALUES (1,'Admin','Administrator',NULL,NULL),(2,'Guest','Guest',NULL,NULL),(3,'Member','Member',NULL,NULL);
/*!40000 ALTER TABLE `user_types` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_type_id` bigint unsigned NOT NULL DEFAULT '1',
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `authenticatable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `authenticatable_id` bigint unsigned NOT NULL,
  `image_url` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  UNIQUE KEY `users_uuid_unique` (`uuid`),
  UNIQUE KEY `users_phone_unique` (`phone`),
  KEY `users_authenticatable_type_authenticatable_id_index` (`authenticatable_type`,`authenticatable_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Eric Muga','eric.muga@gmail.com',NULL,'$2y$10$mL6/wsTxmws8nxPH.VGE3.8mvHM6rYcoXATEFWmfDC3scbK1uDvze',NULL,'0720816931',1,NULL,'App\\Models\\Member',1,NULL,'2022-07-28 12:56:09','2024-03-09 04:06:41'),(2,'Ngina Kabicho','kabichongina@gmail.com',NULL,'$2y$10$T.GoaTzuU3MbHNan861p/.l/khDre2DUP1yskWF18WAcVWc.gl2Ge',NULL,'0723655133',1,NULL,'App\\Models\\Member',2,NULL,'2022-07-28 12:56:09','2022-07-28 12:56:09');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zoom_meetings`
--

DROP TABLE IF EXISTS `zoom_meetings`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zoom_meetings` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `meeting_no` bigint unsigned NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gradable` tinyint(1) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zoom_meetings`
--

LOCK TABLES `zoom_meetings` WRITE;
/*!40000 ALTER TABLE `zoom_meetings` DISABLE KEYS */;
/*!40000 ALTER TABLE `zoom_meetings` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zoom_setups`
--

DROP TABLE IF EXISTS `zoom_setups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zoom_setups` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `api_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `callback_url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_refresh_time` datetime NOT NULL,
  `last_refresh_message` datetime NOT NULL,
  `environment` datetime NOT NULL,
  `refresh_time` datetime NOT NULL,
  `retry_after` datetime NOT NULL,
  `retry_times` datetime NOT NULL,
  `last_meeting` datetime NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zoom_setups`
--

LOCK TABLES `zoom_setups` WRITE;
/*!40000 ALTER TABLE `zoom_setups` DISABLE KEYS */;
/*!40000 ALTER TABLE `zoom_setups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `zoom_users`
--

DROP TABLE IF EXISTS `zoom_users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `zoom_users` (
  `id` bigint unsigned NOT NULL AUTO_INCREMENT,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `zoom_users`
--

LOCK TABLES `zoom_users` WRITE;
/*!40000 ALTER TABLE `zoom_users` DISABLE KEYS */;
/*!40000 ALTER TABLE `zoom_users` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2024-03-09  7:16:37
