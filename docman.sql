-- MySQL dump 10.13  Distrib 5.1.73, for redhat-linux-gnu (x86_64)
--
-- Host: localhost    Database: docman
-- ------------------------------------------------------
-- Server version	5.1.73

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
-- Table structure for table `category`
--

DROP TABLE IF EXISTS `category`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `category` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `category`
--

LOCK TABLES `category` WRITE;
/*!40000 ALTER TABLE `category` DISABLE KEYS */;
INSERT INTO `category` VALUES (2,'Đề thi mẫu'),(3,'Lịch học, lịch thi'),(4,'Học bổng');
/*!40000 ALTER TABLE `category` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `document_group`
--

DROP TABLE IF EXISTS `document_group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `document_group` (
  `id_valid_group` int(11) NOT NULL,
  `id_document` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `document_group`
--

LOCK TABLES `document_group` WRITE;
/*!40000 ALTER TABLE `document_group` DISABLE KEYS */;
INSERT INTO `document_group` VALUES (5,42),(1,42),(4,42),(1,43),(5,43),(1,45),(5,45),(1,46),(1,47),(5,47),(4,47);
/*!40000 ALTER TABLE `document_group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `documents`
--

DROP TABLE IF EXISTS `documents`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `detail` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_author` int(11) NOT NULL,
  `id_group` int(11) NOT NULL,
  `id_category` int(11) NOT NULL,
  `date_time` datetime NOT NULL,
  `number_download` int(11) NOT NULL DEFAULT '0',
  `file_location` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=48 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `documents`
--

LOCK TABLES `documents` WRITE;
/*!40000 ALTER TABLE `documents` DISABLE KEYS */;
INSERT INTO `documents` VALUES (42,'Phiếu nộp tiền','PNT',20,5,2,'2016-07-28 10:15:17',2,'public/document/HDDGNL_Phieu_nop_tien_122289872.pdf',1),(43,'Đề thi 2015','Đề thi mẫu',10,1,2,'2016-07-28 10:17:17',0,'public/document/PDT_de_thi_2015.pdf',1),(45,'Kế hoạch thực tập hè','HHH',22,1,3,'2016-07-28 10:21:53',0,'public/document/PDT_Ke-hoach-trien-khai-thuc-tap-chuyen-nganh-he-2016.doc',1),(46,'bai tap','bai tap',22,1,4,'2016-07-29 08:49:57',0,'public/document/PDT_bai-tap-chuong-3.doc',-1),(47,'Thời khóa biểu','TKB',22,1,2,'2016-08-03 17:41:37',0,'public/document/PDT_Thoi khoa bieu (2).doc',1);
/*!40000 ALTER TABLE `documents` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group`
--

DROP TABLE IF EXISTS `group`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `can_upload` int(11) NOT NULL DEFAULT '1',
  `need_check` int(11) NOT NULL DEFAULT '0',
  `nickname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group`
--

LOCK TABLES `group` WRITE;
/*!40000 ALTER TABLE `group` DISABLE KEYS */;
INSERT INTO `group` VALUES (1,'Phòng đào tạo',1,0,'PDT'),(4,'Phòng nội vụ',0,0,'PNV'),(5,'Hội đồng ĐGNL',1,0,'HĐĐGNL');
/*!40000 ALTER TABLE `group` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `group_admin`
--

DROP TABLE IF EXISTS `group_admin`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `group_admin` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `id_group` int(11) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `group_admin`
--

LOCK TABLES `group_admin` WRITE;
/*!40000 ALTER TABLE `group_admin` DISABLE KEYS */;
INSERT INTO `group_admin` VALUES (2,1,22,NULL,NULL);
/*!40000 ALTER TABLE `group_admin` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `log`
--

DROP TABLE IF EXISTS `log`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `log` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `content` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `datetime` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=97 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `log`
--

LOCK TABLES `log` WRITE;
/*!40000 ALTER TABLE `log` DISABLE KEYS */;
INSERT INTO `log` VALUES (10,'Duy (admin) đã sửa nhóm NSD \"Phòng nguy hiểm\" thành \"Phòng đào tạo\"','2016-07-21 10:09:38'),(11,'Duy (admin) đã sửa nhóm NSD \"Phòng đào tạo\" chỉ có quyền xem bài','2016-07-21 10:09:38'),(12,'Duy (admin) đã thêm thể loại tài liệu tên: \"Học bổng\"','2016-07-21 10:11:39'),(13,'Duy (admin) đã sửa thể loại tên: \"Quyết định chung\" thành \"Lịch học, lịch thi\"','2016-07-21 10:13:24'),(14,'Duy (admin) đã chấp nhận tài liệu tên: \"Thời khóa biểu\" upload bởi Nguyễn Mạnh Duy','2016-07-21 10:18:44'),(15,'Duy (admin) đã từ chối đăng tài liệu tên: \"Bài tập lớn\" upload bởi Nguyễn Mạnh Duy','2016-07-21 10:19:30'),(16,'Duy (admin) đã xóa người dùng tên: \"Hihi Hi\"','2016-07-21 10:28:18'),(17,'Duy (admin) đã xóa người dùng tên: \"Kiakia\" (Kiakia) thuộc nhóm Sinh viên','2016-07-21 10:31:11'),(18,'Duy (admin) đã thay đổi người dùng tên: \"Nguyễn Mạnh Duy\" (duynm_58) thành quản trị viên','2016-07-21 10:39:35'),(19,'Duy (admin) đã tạm khóa người dùng tên: Nguyễn Mạnh Duy\" (duynm_58) ','2016-07-21 10:41:00'),(20,'Duy (admin) đã thay đổi người dùng tên: \"Nguyễn Mạnh Duy\" (duynm_58) thành người dùng thường','2016-07-21 10:41:22'),(21,'Duy (admin) đã mở khóa người dùng tên: Nguyễn Mạnh Duy\" (duynm_58) ','2016-07-21 10:41:22'),(22,'Duy (admin) đã thay đổi người dùng tên: \"Nguyễn Mạnh Duy\" (duynm_58) thành quản trị viên','2016-07-21 10:42:37'),(23,'Duy (admin) đã tạm khóa người dùng tên: Nguyễn Mạnh Duy\" (duynm_58) ','2016-07-21 10:42:46'),(24,'Duy (admin) đã thêm người dùng tên: \"Kiki\" (yoohoo) thuộc nhóm Sinh viên','2016-07-21 10:44:41'),(25,'Duy (admin) đã thêm 1 người dùng vào nhóm Sinh viên','2016-07-21 10:47:04'),(26,'Duy (admin) đã ẩn tài liệu \"Bài tập lớn\" đăng bởi Nguyễn Mạnh Duy','2016-07-21 10:54:26'),(29,'Duy (admin) đã ẩn tài liệu cá nhân: \"Text 2\"','2016-07-21 10:58:35'),(30,'Duy (admin) đã thêm tài liệu \"Điểm thành phần\"','2016-07-21 17:09:42'),(31,'Duy (admin) đã xóa người dùng tên: \"Nguyễn Mạnh Duy\" (Nguyễn Mạnh Duy) thuộc nhóm Sinh viên','2016-07-21 17:10:47'),(32,'Duy (admin) đã xóa người dùng tên: \"Nguyễn Ngọc Duy\" (Nguyễn Ngọc Duy) thuộc nhóm Sinh viên','2016-07-21 17:10:51'),(33,'Duy (admin) đã thêm 2 người dùng vào nhóm Sinh viên','2016-07-21 17:11:01'),(34,'Duy (admin) đã xóa người dùng tên: \"kokoko\" (kokoko) thuộc nhóm Sinh viên','2016-07-21 17:11:30'),(35,'Duy (admin) đã xóa người dùng tên: \"Nguyễn Ngọc Duy\" (Nguyễn Ngọc Duy) thuộc nhóm Sinh viên','2016-07-21 17:11:34'),(36,'Duy (admin) đã thêm 2 người dùng vào nhóm Sinh viên','2016-07-21 17:11:43'),(37,'Duy (admin) đã xóa người dùng tên: \"kokoko\" (kokoko) thuộc nhóm Sinh viên','2016-07-21 17:12:31'),(38,'Duy (admin) đã xóa người dùng tên: \"Nguyễn Ngọc Duy\" (Nguyễn Ngọc Duy) thuộc nhóm Sinh viên','2016-07-21 17:12:35'),(39,'Duy (admin) đã thêm 2 người dùng vào nhóm Sinh viên','2016-07-21 17:12:40'),(40,'Duy (admin) đã xóa người dùng tên: \"kokoko\" (kokoko) thuộc nhóm Sinh viên','2016-07-21 17:12:56'),(41,'Duy (admin) đã xóa người dùng tên: \"Nguyễn Ngọc Duy\" (Nguyễn Ngọc Duy) thuộc nhóm Sinh viên','2016-07-21 17:13:00'),(42,'Duy (admin) đã thêm 2 người dùng vào nhóm Sinh viên','2016-07-21 17:13:06'),(43,'Duy (admin) đã xóa người dùng tên: \"kokoko\" (duynm_58) thuộc nhóm Phòng đào tạo','2016-07-21 21:05:00'),(44,'Duy (admin) đã thêm 1 người dùng vào nhóm Phòng đào tạo','2016-07-21 21:05:17'),(45,'kokoko (duynm_58) đã thêm tài liệu \"Phiếu nộp tiền \"','2016-07-21 21:05:50'),(46,'Duy (admin) đã thêm tài liệu \"Demo\"','2016-07-22 07:25:37'),(47,'kokoko (duynm_58) đã thêm tài liệu \"aaaa\"','2016-07-22 08:26:35'),(48,'Duy (admin) đã thêm tài liệu \"Thông tin\"','2016-07-22 13:04:49'),(49,'Duy (admin) đã thêm nhóm NSD tên: \"Phòng công tác sinh viên\"','2016-07-26 10:01:12'),(50,'Duy (admin) đã thêm nhóm NSD tên: \"Phòng công tác SV\"','2016-07-26 10:02:37'),(51,'Duy (admin) đã sửa nhóm NSD \"Phòng công tác SV\" thành \"Phòng công tác\"','2016-07-26 10:13:16'),(52,'Duy (admin) đã sửa tên đơn vị \"Hội đồng xét tuyển\" thành \"Hội đồng đánh giá năng lực\"','2016-07-26 10:16:18'),(53,'Duy (admin) đã sửa mã của đơn vị \"Hội đồng xét tuyển\" thành \"HĐĐGNL\"','2016-07-26 10:16:18'),(54,'Duy (admin) đã sửa tên đơn vị \"Hội đồng đánh giá năng lực\" thành \"Hội đồng ĐGNL\"','2016-07-26 10:19:06'),(55,'Duy (admin) đã thêm tài liệu \"hay ho\"','2016-07-26 10:26:41'),(56,'Duy (admin) đã thêm người dùng tên: \"Anh Admin\" (admin_PDT) thuộc nhóm Phòng đào tạo','2016-07-26 16:46:45'),(57,'Duy (admin) đã xóa quyền \"Trưởng đơn vị\" của người dùng tên: Anh Admin\" (admin_PDT) ','2016-07-26 17:15:29'),(58,'Duy (admin) đã chuyển người dùng tên: \"Anh Admin\" (admin_PDT)  thành trưởng đơn vị Phòng đào tạo','2016-07-26 17:24:34'),(59,'Duy (admin) đã chuyển người dùng tên: \"Nguyễn Ngọc Duy\" (duynm_59)  thành trưởng đơn vị Phòng đào tạo','2016-07-26 17:28:48'),(60,'Duy (admin) đã thay đổi người dùng tên: \"Nguyễn Ngọc Duy\" (duynm_59) thành quản trị viên','2016-07-26 17:29:02'),(61,'Duy (admin) đã xóa quyền \"Trưởng đơn vị\" của người dùng tên: \"Nguyễn Ngọc Duy\" (duynm_59) ','2016-07-26 17:29:02'),(62,'Duy (admin) đã thay đổi người dùng tên: \"Nguyễn Ngọc Duy\" (duynm_59) thành thành viên thường','2016-07-26 17:29:25'),(63,'Duy (admin) đã chuyển người dùng tên: \"Nguyễn Ngọc Duy\" (duynm_59)  thành trưởng đơn vị Phòng đào tạo','2016-07-26 17:29:25'),(64,'Duy (admin) đã xóa người dùng tên: \"Nguyễn Ngọc Duy\" (duynm_59) thuộc nhóm Phòng đào tạo','2016-07-26 17:30:06'),(65,'Duy (admin) đã chuyển người dùng tên: \"Kiki\" (yoohoo)  thành trưởng đơn vị Phòng đào tạo','2016-07-26 17:30:20'),(66,'Duy (admin) đã chuyển người dùng tên: \"kokoko\" (duynm_58)  thành trưởng đơn vị Hội đồng ĐGNL','2016-07-26 18:37:56'),(67,'Anh Admin (admin_PDT) đã ẩn tài liệu \"hay ho\" đăng bởi Kiki','2016-07-26 20:32:15'),(68,'Anh Admin (admin_PDT) đã ẩn tài liệu \"hay ho\" đăng bởi Kiki','2016-07-26 20:35:34'),(69,'Anh Admin (admin_PDT) đã xóa tài liệu \"hay ho\" đăng bởi Kiki','2016-07-26 20:36:41'),(70,'kokoko (duynm_58) đã thêm tài liệu \"hehe\"','2016-07-26 20:37:42'),(71,'Duy (admin) đã xóa quyền \"Trưởng đơn vị\" của người dùng tên: \"Kiki\" (yoohoo) ','2016-07-26 20:38:35'),(72,'Anh Admin (admin_PDT) đã ẩn tài liệu cá nhân: \"hehe\"','2016-07-27 14:42:42'),(73,'Anh Admin (admin_PDT) đã ẩn tài liệu nội bộ: \"hehe\" (đăng bởi Kiki)','2016-07-27 14:46:50'),(74,'Kiki (yoohoo) đã ẩn tài liệu cá nhân: \"hehe\"','2016-07-27 14:47:24'),(75,'Anh Admin (admin_PDT) đã ẩn tài liệu nội bộ: \"hehe\" (đăng bởi Kiki)','2016-07-27 14:52:15'),(76,'Anh Admin (admin_PDT) đã xóa tài liệu nội bộ: \"Điểm thành phần\" (đăng bởi Duy)','2016-07-27 14:57:46'),(77,'kokoko (duynm_58) đã ẩn tài liệu cá nhân: \"aaaa\"','2016-07-27 14:59:45'),(78,'kokoko (duynm_58) đã ẩn tài liệu cá nhân: \"aaaa\"','2016-07-27 15:00:09'),(79,'Duy (admin) đã ẩn tài liệu nội bộ: \"hehe\" (đăng bởi Kiki)','2016-07-27 15:11:57'),(80,'Duy (admin) đã xóa tài liệu nội bộ: \"hehe\" (đăng bởi Kiki)','2016-07-27 15:12:17'),(81,'Duy (admin) đã thêm tài liệu \"Danh sách người dùng\"','2016-07-27 17:16:39'),(82,'Duy (admin) đã thêm tài liệu \"Danh sách\"','2016-07-27 17:25:37'),(83,'Duy (admin) đã thêm tài liệu \"btl\"','2016-07-27 17:28:10'),(84,'Duy (admin) đã xóa tài liệu \"btl\" đăng bởi Duy','2016-07-28 10:13:55'),(85,'Duy (admin) đã xóa tài liệu \"Danh sách\" đăng bởi Duy','2016-07-28 10:13:59'),(86,'kokoko (duynm_58) đã thêm tài liệu \"Phiếu nộp tiền\"','2016-07-28 10:15:18'),(87,'Kiki (member_PDT) đã thêm tài liệu \"Đề thi 2015\"','2016-07-28 10:17:18'),(88,'Anh Admin (admin_PDT) đã thêm tài liệu \"Kế hoạch thực tập \"','2016-07-28 10:20:48'),(89,'Anh Admin (admin_PDT) đã xóa tài liệu \"Kế hoạch thực tập \" đăng bởi Anh Admin','2016-07-28 10:21:08'),(90,'Anh Admin (admin_PDT) đã thêm tài liệu \"Kế hoạch thực tập hè\"','2016-07-28 10:21:54'),(91,'Duy (admin) đã thêm người dùng tên: \"Mem\" (member_PNV) thuộc nhóm Phòng nội vụ','2016-07-28 10:43:34'),(92,'Duy (admin) đã thay đổi người dùng tên: \"Mem\" (member_PNV) thành quản trị viên','2016-07-28 10:50:14'),(93,'Duy (admin) đã thay đổi người dùng tên: \"Mem\" (member_PNV) thành thành viên thường','2016-07-28 10:50:44'),(94,'Anh Admin (admin_PDT) đã thêm tài liệu \"bai tap\"','2016-07-29 08:49:58'),(95,'Anh Admin (admin_PDT) đã ẩn tài liệu cá nhân: \"bai tap\"','2016-07-29 08:51:02'),(96,'Anh Admin (admin_PDT) đã thêm tài liệu \"Thời khóa biểu\"','2016-08-03 17:41:37');
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
INSERT INTO `migrations` VALUES ('2014_10_12_000000_create_users_table',1),('2016_07_14_084309_create_documents_table',2),('2016_07_14_085342_create_group_table',2),('2016_07_14_085529_create_category_table',2),('2016_07_14_091342_create_document_group_table',2),('2016_07_21_021822_create_log_table',3),('2016_07_25_032325_create_group_admin_table',4);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `users` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `id_group` int(11) NOT NULL,
  `is_admin` int(11) NOT NULL DEFAULT '0',
  `status` int(11) NOT NULL DEFAULT '1',
  `main_admin` int(11) NOT NULL DEFAULT '0',
  `remember_token` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'admin','$2y$10$.pViz/0wcK7Zb.stP5wX/uO4ZX4AmWZrywWAOb4zlCya7uQYkcHEC','Duy',5,1,1,1,'SQ1DfHABZ3E55PcoYJfRJlF0o02KQrEEUFywT8TxRDMMnPE6Jds2Q540ZmyK','hihi@gmail.com'),(10,'member_PDT','$2y$10$WPfoC4IaP3y92L9R4huyge7UKTfZ7c47Ko.QkNxWLj5ydZtfMx0Hi','Kiki',1,0,1,0,'4UU8rnIBvmzADlw66O54dGAkEebij8ET5DKOLfKwA17Zw5Y6asPXD4ZrmJJc','ki@g.co'),(20,'member_DGNL','$2y$10$Tyo9/t3YmCyfqY1qp0hmguZltik7vbR2MzOmz3lzKlc6lkrGG6QeG','kokoko',5,0,1,0,'aFONMSMGF7AQUt5yILtRLk17WRSFPtPaIwXv48AvlixOZUosyHmODkeB8eQt','k@gmail.com'),(22,'admin_PDT','$2y$10$u/zOIERKs1vcglzwkZ2hFeissmK3QmlLoKXk9YtCpRAKFl0isazDW','Anh Admin',1,0,1,0,'PFJs6omY7ZdE0725mtLnlz5UovyCwTeb5Bfxv2XtQ8iwepoGehD7Bj6ix84B','kev@gmail.com'),(23,'member_PNV','$2y$10$saAzLoufmkPnbJGKFyRHHeI6zAim.YzhTYucPVqhUeYR11La1GXMS','Mem',4,0,1,0,'XZtkAUBiaIFGFM1jPIN0aYJh9x4Dp1hoTZDeEueUPw6ecmslqxaDSGjMiKnT','mem@mg.gm');
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

-- Dump completed on 2017-11-03 14:00:43
