-- MariaDB dump 10.17  Distrib 10.4.13-MariaDB, for Linux (x86_64)
--
-- Host: localhost    Database: svuup
-- ------------------------------------------------------
-- Server version	10.4.13-MariaDB

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
-- Table structure for table `attachments`
--

DROP TABLE IF EXISTS `attachments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `attachments` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `url` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `attachments_message_id_foreign` (`message_id`),
  CONSTRAINT `attachments_message_id_foreign` FOREIGN KEY (`message_id`) REFERENCES `messages` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `attachments`
--

LOCK TABLES `attachments` WRITE;
/*!40000 ALTER TABLE `attachments` DISABLE KEYS */;
INSERT INTO `attachments` VALUES (1,'files/mBNsE9PStwoszSAap5ZigTseXEvbsW0T9EtVAqXb.png',2,'2020-06-15 10:41:15','2020-06-15 10:41:15'),(2,'files/cstU517jhnJCmgGeYUOKEx34q6uOG0jzjk13RlGx.png',3,'2020-06-15 11:23:26','2020-06-15 11:23:26'),(3,'files/lzW0YanrlbsyJVVg6hUFVa9TPxRGQsCpMRxrfBUa.png',4,'2020-06-15 11:30:51','2020-06-15 11:30:51'),(4,'files/qAb0JLtvikAXLEU9lF25REo69FXRcxiRJEJDQy0p.docx',7,'2020-06-15 12:26:11','2020-06-15 12:26:11'),(5,'files/0CdfltpkeChcs7656MG3yZ6RNycwkwGl7d0rT7MJ.png',9,'2020-06-15 12:51:31','2020-06-15 12:51:31'),(6,'files/tNpDxUlhZUaZFcnkxgViA2Ivv8WTz86zBuA8gyCP.png',9,'2020-06-15 12:51:31','2020-06-15 12:51:31'),(7,'files/Drm2ASxSHDH1RfdCIcPmmElyRr5XnKMwOAc3ghvd.png',9,'2020-06-15 12:51:31','2020-06-15 12:51:31'),(8,'files/ffvAzP9vyiCXgXghkNLdNpG9xtfHIqFqtoUWWqW6.png',9,'2020-06-15 12:51:31','2020-06-15 12:51:31');
/*!40000 ALTER TABLE `attachments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `disciplines`
--

DROP TABLE IF EXISTS `disciplines`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `disciplines` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `semester` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `disciplines_user_id_foreign` (`user_id`),
  CONSTRAINT `disciplines_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `disciplines`
--

LOCK TABLES `disciplines` WRITE;
/*!40000 ALTER TABLE `disciplines` DISABLE KEYS */;
INSERT INTO `disciplines` VALUES (1,'Иностранный язык',5,'2020-06-07 15:13:26','2020-06-07 15:13:26',1),(2,'Информатика',5,'2020-06-07 15:13:41','2020-06-07 15:13:41',1),(3,'История',5,'2020-06-07 15:13:45','2020-06-07 15:13:45',1),(4,'Математика',5,'2020-06-07 15:14:50','2020-06-07 15:14:50',1);
/*!40000 ALTER TABLE `disciplines` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `events`
--

DROP TABLE IF EXISTS `events`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `events` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `max` int(10) unsigned NOT NULL,
  `discipline_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `events_discipline_id_foreign` (`discipline_id`),
  CONSTRAINT `events_discipline_id_foreign` FOREIGN KEY (`discipline_id`) REFERENCES `disciplines` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `events`
--

LOCK TABLES `events` WRITE;
/*!40000 ALTER TABLE `events` DISABLE KEYS */;
INSERT INTO `events` VALUES (1,'Рубежный контроль 1',20,1,'2020-06-08 04:53:32','2020-06-08 04:53:32'),(2,'Контрольная работа',15,1,'2020-06-08 04:54:12','2020-06-08 04:54:12'),(3,'Рубежный контроль 2',15,1,'2020-06-08 05:26:42','2020-06-08 05:26:42'),(4,'Экзамен',50,1,'2020-06-08 06:32:29','2020-06-08 06:32:29');
/*!40000 ALTER TABLE `events` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `faculties`
--

DROP TABLE IF EXISTS `faculties`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `faculties` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `faculties`
--

LOCK TABLES `faculties` WRITE;
/*!40000 ALTER TABLE `faculties` DISABLE KEYS */;
INSERT INTO `faculties` VALUES (1,'Атомная энергетика и технологии','2020-06-07 10:39:48','2020-06-07 10:39:48'),(2,'Факультет повышения квалификации и профессиональной переподготовки кадров','2020-06-07 10:41:47','2020-06-07 10:41:47');
/*!40000 ALTER TABLE `faculties` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `failed_jobs`
--

DROP TABLE IF EXISTS `failed_jobs`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `failed_jobs` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
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
-- Table structure for table `groups`
--

DROP TABLE IF EXISTS `groups`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `groups` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `speciality_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `groups_speciality_id_foreign` (`speciality_id`),
  CONSTRAINT `groups_speciality_id_foreign` FOREIGN KEY (`speciality_id`) REFERENCES `specialities` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `groups`
--

LOCK TABLES `groups` WRITE;
/*!40000 ALTER TABLE `groups` DISABLE KEYS */;
INSERT INTO `groups` VALUES (1,'ИФСТ-41',3,'2020-06-08 03:27:16','2020-06-08 03:27:16');
/*!40000 ALTER TABLE `groups` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `marks`
--

DROP TABLE IF EXISTS `marks`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `marks` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `mark` int(10) unsigned NOT NULL,
  `user_id` bigint(20) unsigned NOT NULL,
  `event_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `marks_user_id_foreign` (`user_id`),
  KEY `marks_event_id_foreign` (`event_id`),
  CONSTRAINT `marks_event_id_foreign` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`),
  CONSTRAINT `marks_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=14 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `marks`
--

LOCK TABLES `marks` WRITE;
/*!40000 ALTER TABLE `marks` DISABLE KEYS */;
INSERT INTO `marks` VALUES (1,0,8,1,'2020-06-08 04:53:32','2020-06-08 04:53:32'),(2,15,9,1,'2020-06-08 04:53:32','2020-06-21 16:32:16'),(3,15,10,1,'2020-06-08 04:53:32','2020-06-08 04:53:32'),(4,0,8,2,'2020-06-08 04:54:12','2020-06-08 04:54:12'),(5,5,9,2,'2020-06-08 04:54:12','2020-06-21 16:32:42'),(6,0,10,2,'2020-06-08 04:54:12','2020-06-08 04:54:12'),(7,0,8,3,'2020-06-08 05:26:42','2020-06-08 05:26:42'),(8,3,9,3,'2020-06-08 05:26:42','2020-06-21 16:32:43'),(9,0,10,3,'2020-06-08 05:26:42','2020-06-08 05:26:42'),(10,0,8,4,'2020-06-08 06:32:29','2020-06-08 06:32:29'),(11,40,9,4,'2020-06-08 06:32:29','2020-06-21 17:09:08'),(12,0,10,4,'2020-06-08 06:32:29','2020-06-08 06:32:29');
/*!40000 ALTER TABLE `marks` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `messages`
--

DROP TABLE IF EXISTS `messages`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `messages` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `text` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `from` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `thread_id` bigint(20) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `messages_thread_id_foreign` (`thread_id`),
  CONSTRAINT `messages_thread_id_foreign` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `messages`
--

LOCK TABLES `messages` WRITE;
/*!40000 ALTER TABLE `messages` DISABLE KEYS */;
INSERT INTO `messages` VALUES (2,'ВКР на проверку',5,'2020-06-15 10:41:15','2020-06-15 10:41:15',3),(3,'тест',5,'2020-06-15 11:23:26','2020-06-15 11:23:26',5),(4,'Тестовое сообщение',5,'2020-06-15 11:30:51','2020-06-15 11:30:51',6),(5,'Тест сообщения без вложений',5,'2020-06-15 12:23:49','2020-06-15 12:23:49',6),(6,'Тест сообщений без вложений 2',5,'2020-06-15 12:24:16','2020-06-15 12:24:16',6),(7,'Тест сообщения с вложениями',5,'2020-06-15 12:26:11','2020-06-15 12:26:11',6),(8,'Тест сообщения без вложений',9,'2020-06-15 12:50:43','2020-06-15 12:50:43',6),(9,'Тест сообщения с вложениями',9,'2020-06-15 12:51:31','2020-06-15 12:51:31',6);
/*!40000 ALTER TABLE `messages` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2019_08_19_000000_create_failed_jobs_table',1),(3,'2020_06_07_113006_create_roles_table',2),(4,'2020_06_07_113018_add_role_column_to_users_table',3),(5,'2020_06_07_141846_create_faculties_table',4),(6,'2020_06_07_144707_create_specialities_table',5),(7,'2020_06_07_175243_create_disciplines_table',6),(8,'2020_06_07_191129_add_semester_column_to_disciplines_table',7),(9,'2020_06_08_065018_create_speciality_discipline_table',8),(10,'2020_06_08_065314_delete_speciality_id_column_from_disciplines_table',9),(11,'2020_06_08_071407_create_groups_table',10),(12,'2020_06_08_071506_add_group_id_to_users_table',10),(13,'2020_06_08_081508_create_events_table',11),(14,'2020_06_08_081608_create_marks_table',12),(15,'2020_06_15_130651_create_threads_table',13),(16,'2020_06_15_130700_create_messages_table',13),(17,'2020_06_15_130707_create_attachments_table',13),(18,'2020_06_15_131320_create_user_thread_table',13),(19,'2020_06_15_140349_add_thread_id_column_to_messages_table',14),(20,'2020_06_15_140409_remove_to_column_from_messages_table',15),(21,'2020_06_15_143511_drop_to_column_from_threads_table',16),(22,'2020_06_16_184433_add_speciality_foreign_key_to_groups_table',17);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `stub` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (3,'admin','Администратор',NULL,NULL),(4,'teacher','Преподаватель',NULL,NULL),(5,'student','Студент',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `specialities`
--

DROP TABLE IF EXISTS `specialities`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `specialities` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semesters` int(10) unsigned NOT NULL,
  `faculty_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `specialities_faculty_id_foreign` (`faculty_id`),
  CONSTRAINT `specialities_faculty_id_foreign` FOREIGN KEY (`faculty_id`) REFERENCES `faculties` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=11 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `specialities`
--

LOCK TABLES `specialities` WRITE;
/*!40000 ALTER TABLE `specialities` DISABLE KEYS */;
INSERT INTO `specialities` VALUES (2,'Строительство',8,1,'2020-06-07 11:39:16','2020-06-07 11:39:16'),(3,'Информационные системы и технологии',8,1,'2020-06-07 11:50:28','2020-06-07 11:50:28'),(4,'Теплоэнергетика и теплотехника',8,1,'2020-06-07 11:50:40','2020-06-07 11:50:40'),(5,'Атомные станции: проектирование, эксплуатация и инжиниринг',8,1,'2020-06-07 11:50:45','2020-06-07 11:50:45'),(6,'Машиностроение',8,1,'2020-06-07 11:50:49','2020-06-07 11:50:49'),(7,'Химическая технология',8,1,'2020-06-07 11:50:54','2020-06-07 11:50:54'),(8,'Управление в технических системах',8,1,'2020-06-07 11:50:59','2020-06-07 11:50:59'),(9,'Экономика',8,1,'2020-06-07 11:51:03','2020-06-07 11:51:03'),(10,'Электроэнергетика и электротехника',8,1,'2020-06-07 11:51:12','2020-06-07 11:51:12');
/*!40000 ALTER TABLE `specialities` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `speciality_discipline`
--

DROP TABLE IF EXISTS `speciality_discipline`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `speciality_discipline` (
  `speciality_id` bigint(20) unsigned NOT NULL,
  `discipline_id` bigint(20) unsigned NOT NULL,
  KEY `speciality_discipline_speciality_id_foreign` (`speciality_id`),
  KEY `speciality_discipline_discipline_id_foreign` (`discipline_id`),
  CONSTRAINT `speciality_discipline_discipline_id_foreign` FOREIGN KEY (`discipline_id`) REFERENCES `disciplines` (`id`),
  CONSTRAINT `speciality_discipline_speciality_id_foreign` FOREIGN KEY (`speciality_id`) REFERENCES `specialities` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `speciality_discipline`
--

LOCK TABLES `speciality_discipline` WRITE;
/*!40000 ALTER TABLE `speciality_discipline` DISABLE KEYS */;
INSERT INTO `speciality_discipline` VALUES (3,1),(3,2),(4,2),(4,1),(4,3),(4,4),(3,3),(3,4),(2,2),(2,1),(2,3),(2,4),(5,1),(5,2),(5,3),(5,4);
/*!40000 ALTER TABLE `speciality_discipline` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `threads`
--

DROP TABLE IF EXISTS `threads`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `threads` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_by` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `threads`
--

LOCK TABLES `threads` WRITE;
/*!40000 ALTER TABLE `threads` DISABLE KEYS */;
INSERT INTO `threads` VALUES (3,'ВКР',5,'2020-06-15 10:41:15','2020-06-15 10:41:15'),(4,'ВКР 2',5,'2020-06-15 11:22:38','2020-06-15 11:22:38'),(5,'ВКР 2',5,'2020-06-15 11:23:26','2020-06-15 11:23:26'),(6,'ВКР',5,'2020-06-15 11:30:50','2020-06-15 11:30:50');
/*!40000 ALTER TABLE `threads` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `user_thread`
--

DROP TABLE IF EXISTS `user_thread`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `user_thread` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) unsigned NOT NULL,
  `thread_id` bigint(20) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_thread_user_id_foreign` (`user_id`),
  KEY `user_thread_thread_id_foreign` (`thread_id`),
  CONSTRAINT `user_thread_thread_id_foreign` FOREIGN KEY (`thread_id`) REFERENCES `threads` (`id`),
  CONSTRAINT `user_thread_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `user_thread`
--

LOCK TABLES `user_thread` WRITE;
/*!40000 ALTER TABLE `user_thread` DISABLE KEYS */;
INSERT INTO `user_thread` VALUES (3,8,3,NULL,NULL),(4,9,5,NULL,NULL),(5,5,5,NULL,NULL),(6,9,6,NULL,NULL),(7,10,6,NULL,NULL),(8,5,6,NULL,NULL);
/*!40000 ALTER TABLE `user_thread` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `role_id` bigint(20) unsigned NOT NULL,
  `group_id` bigint(20) unsigned DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_group_id_foreign` (`group_id`),
  CONSTRAINT `users_group_id_foreign` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`),
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (4,'Администратор','bjadmund@mail.ru',NULL,'$2y$10$6s3.zHnVpGvTjpMjxjiMsOrHpEX.jNssoWYrcaIiDRIQ1evaPWd52',NULL,'2020-06-07 09:51:34','2020-06-07 09:51:34',3,NULL),(5,'Иванов Иван Иванович','ivanov@mail.ru',NULL,'$2y$10$UwlkqeLQ98yVpQmKpXvaBOo5OCFet5RamVZ9CBBL0UN1lnvpvjv6G',NULL,'2020-06-07 13:51:11','2020-06-07 13:51:11',4,NULL),(6,'Алексеев Евгений Артемович','1@mail.ru',NULL,'$2y$10$HrfjwbgkkOMGlRJUGX4Q/.p1P.tNv//9wf7834m3aGaPRHkp0YCSO',NULL,'2020-06-07 13:51:47','2020-06-07 13:51:47',4,NULL),(7,'Крюков Даниил Константинович','2@mail.ru',NULL,'$2y$10$1.k4mpN79SigIA8SvIKw4uOCelJ29msVX4pW0kQ3CKT5XwR6nwlqm',NULL,'2020-06-07 13:52:14','2020-06-07 13:52:14',4,NULL),(8,'Вальковский Филипп Анатолиевич','5@mail.ru',NULL,'$2y$10$2MBQmPc12/XR6lwiNrJRB.H03i6skvCqY5S3QSvu1CL2XEkkRRvWW',NULL,'2020-06-08 03:22:01','2020-06-08 03:55:11',5,1),(9,'Доронин Ярослав Петрович','6@mail.ru',NULL,'$2y$10$4RcFqjYGQN183wK4sVTMkO3tmAI9PHjbWfIXFgmHoWZu.owKhX/w6',NULL,'2020-06-08 03:22:16','2020-06-08 03:55:08',5,1),(10,'Селезнёв Юрий Богданович','7@mail.ru',NULL,'$2y$10$wYccqNgx8G5RwZVdL2r/d.2GRj79/VJAB04h1WHhQz2ohTQjtytom',NULL,'2020-06-08 03:22:34','2020-06-08 03:55:13',5,1);
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

-- Dump completed on 2020-06-22 13:45:17
