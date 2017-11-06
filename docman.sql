-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: docman
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.17.10.1

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
-- Table structure for table `departments`
--

DROP TABLE IF EXISTS `departments`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `departments`
--

LOCK TABLES `departments` WRITE;
/*!40000 ALTER TABLE `departments` DISABLE KEYS */;
INSERT INTO `departments` VALUES (1,'Ban Thanh Tra','BTT','A03-301','2016-09-26 23:24:07','2016-09-26 23:24:07'),(2,'Phòng Tổ chức Cán bộ','PTCCB','A03-302','2016-09-26 23:24:24','2016-09-26 23:24:24'),(3,'Phòng Hành chính - Quản trị','PHC-QT','A03-303','2016-09-26 23:26:18','2016-09-26 23:26:18'),(4,'Phòng Đào tạo','PĐT','A03-304','2016-09-26 23:26:34','2016-09-26 23:26:34'),(5,'Phòng KHCN & HTPT','PKHCN&HTPT','A03-305','2016-09-26 23:27:09','2016-09-26 23:27:09'),(6,'Phòng Kế hoạch Tài chính','PKHTC','A03-306','2016-09-26 23:27:24','2016-09-26 23:27:24'),(7,'Phòng Công tác sinh viên ','PCTSV','A03-307','2016-09-26 23:27:41','2016-09-26 23:27:41'),(8,'Trung tâm máy tính','TTMT','G2B, 144 Xuân Thủy, Cầu Giấy, Hà nội','2016-12-18 18:40:19','2016-12-18 18:40:19'),(9,'Trung tâm Đảm bảo chất lượng','TTĐBCL','P 208A-E3','2016-12-18 20:01:45','2016-12-18 20:01:45'),(10,'Ban giám hiệu','BGH','Nhà E3','2017-09-20 18:30:29','2017-09-20 18:30:51'),(11,'Khoa Công nghệ Thông tin','Khoa-CNTT','Nhà E3','2017-09-20 18:31:34','2017-09-20 18:31:34'),(12,'Khoa Điện tử Viễn thông','Khoa-ĐTVT','Nhà G2','2017-09-20 18:31:54','2017-09-20 18:31:54'),(13,'Khoa Vật Lý Kỹ thuật & Công nghệ Nano','Khoa-VLKT','Nhà E4','2017-09-20 18:32:30','2017-09-20 18:32:30'),(14,'Khoa Cơ học Kỹ thuật & Tự động hóa','Khoa-CKT','Nhà G2','2017-09-20 18:32:59','2017-09-20 18:32:59');
/*!40000 ALTER TABLE `departments` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` mediumtext CHARACTER SET utf8 NOT NULL,
  `path` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `typedoc_id` int(10) unsigned NOT NULL,
  `date` date DEFAULT NULL,
  `coquan` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `nguoiky` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sohieu` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_user_id_foreign` (`user_id`),
  KEY `documents_typedoc_id_foreign` (`typedoc_id`),
  CONSTRAINT `documents_typedoc_id_foreign` FOREIGN KEY (`typedoc_id`) REFERENCES `type_documents` (`id`) ON DELETE CASCADE,
  CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=23 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (22,'Tài liệu thử','','[BTT] HuongDanThi.pdf','Tài liệu thi',1,2,2,'2017-11-04','abc','ert','123e','2017-09-20 18:51:24','2017-09-20 18:51:24');
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_at` datetime NOT NULL,
  `IP` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_owner` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=55 DEFAULT CHARSET=latin1;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (49,'Admin Docman (admin) đã thêm người dùng mới: Hello (phòng Ban Thanh Tra)','2017-11-04 23:00:15','127.0.0.1',2),(50,'Admin Docman (admin) đã sửa thông tin người dùng: Nguyễn Văn Thư','2017-11-04 23:01:31','127.0.0.1',2),(51,'Hello (hello) đã tham gia hệ thống','2017-11-05 21:03:35','127.0.0.1',21),(52,'Admin Docman (admin) đã thêm người dùng mới: Aabc (phòng Phòng Hành chính - Quản trị)','2017-11-05 21:26:40','127.0.0.1',2),(53,'Aabc (abc123a) đã tham gia hệ thống','2017-11-05 21:33:44','127.0.0.1',23),(54,'Aabc (abc123a) đã cập nhật thông tin cá nhân','2017-11-05 21:34:34','127.0.0.1',23);
/*!40000 ALTER TABLE `log` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES ('2016_09_19_071659_create_departments_table',1),('2016_09_19_071751_create_roles_table',1),('2016_09_19_071851_create_users_table',1),('2016_09_19_072052_create_type_documents_table',1),('2016_09_19_072208_create_documents_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `roles`
--

DROP TABLE IF EXISTS `roles`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `roles`
--

LOCK TABLES `roles` WRITE;
/*!40000 ALTER TABLE `roles` DISABLE KEYS */;
INSERT INTO `roles` VALUES (1,'admin',NULL,NULL),(2,'manager',NULL,NULL),(3,'user',NULL,NULL);
/*!40000 ALTER TABLE `roles` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `type_documents`
--

DROP TABLE IF EXISTS `type_documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `type_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `parent` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `type_documents`
--

LOCK TABLES `type_documents` WRITE;
/*!40000 ALTER TABLE `type_documents` DISABLE KEYS */;
INSERT INTO `type_documents` VALUES (2,'Công Văn',4,'2016-09-26 23:40:57','2016-09-26 23:43:59'),(3,'Quyết định',4,'2016-09-26 23:45:11','2016-09-26 23:45:11'),(4,'Văn bản đi',NULL,NULL,NULL),(5,'Văn bản đến',NULL,NULL,NULL),(6,'Công Văn',5,NULL,NULL),(7,'Quyết định',5,NULL,NULL);
/*!40000 ALTER TABLE `type_documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'public/images/avatar.png',
  `role_id` int(10) unsigned NOT NULL DEFAULT '3',
  `department_id` int(10) unsigned DEFAULT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `type` tinyint(4) NOT NULL DEFAULT '0',
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `users_role_id_foreign` (`role_id`),
  KEY `users_department_id_foreign` (`department_id`),
  CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (2,'admin','Admin Docman','kevinkool9x@gmail.com','$2a$04$yTzFTnjuvWGkO6TUrFlblevTPXWG1HBDY15nhUHL6dlnakb33MxAO','public/images/avatar/041702181216544018_219953954807409_1109699905_n.jpg',1,1,'waD3h64OmpOuD3aTbueL9tZnMYVP4CpapSE6OqfDgCTfngQ01I4Irie91byA',0,1,NULL,'2017-11-05 08:13:07'),(10,'ccne','Trung tâm Máy tính','ccne@vnu.edu.vn','$2y$10$J6AuUKnUJfvtmwzNSFuS4e1tYoYCgvFDf2brlHn5DQIycI.PjQWYe','public/images/avatar.png',3,1,'573hpa0Cm2WLbRKIz0kQCgw1zKfm9oT4VLkgEemfk4x669SHYTOTgb2rXt3e',1,1,'2016-12-12 03:07:39','2016-12-18 20:12:41'),(12,'kiendh','Đỗ Hoàng Kiên','kiendh@vnu.edu.vn','$2y$10$mBIm6OX9oY/4GMVrtB7mr.PYP3wWIZfNftMWBPH4R/elfHMnMe8KC','public/images/avatar.png',1,8,'MyfMWoTBaki3jD88kZbWd4YeKmJ63tCkKdlZvp8Sm7IPjWh2c4kaYn2Dkwjn',1,1,'2016-12-18 18:35:10','2016-12-18 20:09:14'),(13,'trienpm','Phạm Minh Triển','trienpm@vnu.edu.vn','$2y$10$ODFSTUsoV2S/xOr9CnpgieTDrXlMFFDUewkd/WFdtNH07uEe43nIq','public/images/avatar.png',3,5,NULL,1,1,'2016-12-18 18:57:03','2016-12-18 18:57:27'),(14,'khoatd',NULL,NULL,'$2y$10$skjv1W3.TJIA5UT3vArU6.w.Xr27UTAYPoLBEU.WXAr3M7dtYbLXi','public/images/avatar.png',3,NULL,'PcAf0hGMFbEYfdLx9oZ4MUJSD3HjWyNzEH8L237lZ4oakH37p08vVdWJccqu',1,1,'2016-12-18 19:57:54','2016-12-18 19:59:27'),(15,'ninhbt','Nguyễn Thị Hồng','hongnt1991@vnu.edu.vn','$2y$10$xwK76EXljdUuoscyjxoxFecWmSDMsYxSIy7AlolNukTs2OrASwDYi','public/images/avatar.png',2,7,'tOmXCeSonjh26nheBDPnrsbKH6vYNazGr8OYGAEzjYff04NTe0s0xVWb5Ypx',1,1,'2016-12-18 19:58:07','2016-12-21 00:43:17'),(16,'hungpd','Pham Duy Hung','hungpd@vnu.edu.vn','$2y$10$/2tNjcHFRFMQHMMZTdpvaevmGAFr6KRPn5nkRd1oGHrC9q9vemzvi','public/images/avatar.png',1,3,NULL,1,1,'2016-12-18 19:58:41','2017-09-28 19:09:11'),(17,'hattt','Trần Thị Thu Hà','hattt@vnu.edu.vn','$2y$10$krRzcLMdoyHKwqApR0SPGehsiA7z92AHhqIIDMFiU94obhELSjBeO','public/images/avatar.png',2,6,'X79UYWbMq34srP6ZvjOny8Eokp62lRLfZtFxIibjiVlNChxKMIFRhjiTkkjf',1,1,'2016-12-19 20:46:55','2016-12-21 00:42:41'),(18,'vietanh','Nguyễn Việt Anh','vietanh@vnu.edu.vn','$2y$10$IykjF3IFWpefKGmjgfc0T.4V9iJM3LI/Stku1tPUnpkhjg3/6ocei','public/images/avatar.png',1,8,'sGUZTeGdqFTC0xIiULktf7EcGeuKb0Y5fjr46SIUJCqDl7aliGDVf9l5UeIj',1,1,'2017-03-01 00:51:41','2017-11-02 21:01:19'),(19,'hanv','Nguyễn Việt Hà','hanv@vnu.edu.vn','$2y$10$TlFU5rZf1sQoUDMGf97UauOXZIbvF6BUM7UqjpPN3CVEIBrHfpOfS','public/images/avatar.png',1,10,NULL,1,1,'2017-09-20 19:38:27','2017-09-25 21:36:05'),(20,'vanthu','Nguyễn Văn Thư','nguyenvanthu@vnu.edu.vn','$2y$10$JgWArc2ZCOe5SqYUUYcTQe6hS8tkbrRCJ0vAoosCGkCmj2SGzbdnK','public/images/avatar.png',2,11,'L6enOiS5WOZWjgSG7FYPitt6yQsUP0zCfxhmVUPuqfaWEO36KtGhRcBPT5su',0,1,'2017-11-02 21:01:10','2017-11-04 09:01:31'),(21,'hello','Hello','bach123@adsfa.adf','$2y$10$JgWArc2ZCOe5SqYUUYcTQe6hS8tkbrRCJ0vAoosCGkCmj2SGzbdnK','public/images/avatar.png',3,1,'xTPKit5idE5PWc1sG9J2ErRT1afb8Isg1KfQtyjxyAX5LhSIIgNVCMWPt8JO',0,1,'2017-11-04 09:00:15','2017-11-05 07:26:55'),(23,'abc123a','Aabc','as@ad.sg','$2y$10$JgWArc2ZCOe5SqYUUYcTQe6hS8tkbrRCJ0vAoosCGkCmj2SGzbdnK','public/images/avatar/0934330511170000092_mach-thu-tia-hong-ngoai-ir-38khz_550.png',3,1,NULL,0,1,'2017-11-05 07:26:40','2017-11-05 14:34:33');
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

-- Dump completed on 2017-11-06 16:26:01
