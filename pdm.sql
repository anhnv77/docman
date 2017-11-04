-- phpMyAdmin SQL Dump
-- version 4.1.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Nov 03, 2017 at 09:48 AM
-- Server version: 5.1.73
-- PHP Version: 5.6.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `pdm`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE IF NOT EXISTS `departments` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=15 ;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `alias`, `address`, `created_at`, `updated_at`) VALUES
(1, 'Ban Thanh Tra', 'BTT', 'A03-301', '2016-09-26 23:24:07', '2016-09-26 23:24:07'),
(2, 'Phòng Tổ chức Cán bộ', 'PTCCB', 'A03-302', '2016-09-26 23:24:24', '2016-09-26 23:24:24'),
(3, 'Phòng Hành chính - Quản trị', 'PHC-QT', 'A03-303', '2016-09-26 23:26:18', '2016-09-26 23:26:18'),
(4, 'Phòng Đào tạo', 'PĐT', 'A03-304', '2016-09-26 23:26:34', '2016-09-26 23:26:34'),
(5, 'Phòng KHCN & HTPT', 'PKHCN&HTPT', 'A03-305', '2016-09-26 23:27:09', '2016-09-26 23:27:09'),
(6, 'Phòng Kế hoạch Tài chính', 'PKHTC', 'A03-306', '2016-09-26 23:27:24', '2016-09-26 23:27:24'),
(7, 'Phòng Công tác sinh viên ', 'PCTSV', 'A03-307', '2016-09-26 23:27:41', '2016-09-26 23:27:41'),
(8, 'Trung tâm máy tính', 'TTMT', 'G2B, 144 Xuân Thủy, Cầu Giấy, Hà nội', '2016-12-18 18:40:19', '2016-12-18 18:40:19'),
(9, 'Trung tâm Đảm bảo chất lượng', 'TTĐBCL', 'P 208A-E3', '2016-12-18 20:01:45', '2016-12-18 20:01:45'),
(10, 'Ban giám hiệu', 'BGH', 'Nhà E3', '2017-09-20 18:30:29', '2017-09-20 18:30:51'),
(11, 'Khoa Công nghệ Thông tin', 'Khoa-CNTT', 'Nhà E3', '2017-09-20 18:31:34', '2017-09-20 18:31:34'),
(12, 'Khoa Điện tử Viễn thông', 'Khoa-ĐTVT', 'Nhà G2', '2017-09-20 18:31:54', '2017-09-20 18:31:54'),
(13, 'Khoa Vật Lý Kỹ thuật & Công nghệ Nano', 'Khoa-VLKT', 'Nhà E4', '2017-09-20 18:32:30', '2017-09-20 18:32:30'),
(14, 'Khoa Cơ học Kỹ thuật & Tự động hóa', 'Khoa-CKT', 'Nhà G2', '2017-09-20 18:32:59', '2017-09-20 18:32:59');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE IF NOT EXISTS `documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) unsigned NOT NULL,
  `typedoc_id` int(10) unsigned NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `documents_user_id_foreign` (`user_id`),
  KEY `documents_typedoc_id_foreign` (`typedoc_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=24 ;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `content`, `description`, `is_public`, `user_id`, `typedoc_id`, `created_at`, `updated_at`) VALUES
(21, 'Thời khóa biểu', '[BTT] tkb.xlsx', 'Thời khóa biểu', 1, 2, 4, '2016-12-18 14:08:46', '2016-12-18 14:08:46'),
(22, 'Tài liệu thử', '[BTT] HuongDanThi.pdf', 'Tài liệu thi', 1, 2, 2, '2017-09-21 01:51:24', '2017-09-21 01:51:24'),
(23, 'Tuần 6', '[Khoa-CNTT] Tuan6.pdf', 'Tuần 6', 1, 20, 2, '2017-11-03 08:30:20', '2017-11-03 08:30:20');

-- --------------------------------------------------------

--
-- Table structure for table `log`
--

CREATE TABLE IF NOT EXISTS `log` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `content` varchar(300) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `create_at` datetime NOT NULL,
  `IP` varchar(30) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `id_owner` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=49 ;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2016_09_19_071659_create_departments_table', 1),
('2016_09_19_071751_create_roles_table', 1),
('2016_09_19_071851_create_users_table', 1),
('2016_09_19_072052_create_type_documents_table', 1),
('2016_09_19_072208_create_documents_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE IF NOT EXISTS `roles` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=4 ;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, NULL),
(2, 'manager', NULL, NULL),
(3, 'user', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `type_documents`
--

CREATE TABLE IF NOT EXISTS `type_documents` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=6 ;

--
-- Dumping data for table `type_documents`
--

INSERT INTO `type_documents` (`id`, `name`, `created_at`, `updated_at`) VALUES
(2, 'Tài liệu học tập', '2016-09-26 23:40:57', '2016-09-26 23:43:59'),
(3, 'Học Bổng', '2016-09-26 23:45:11', '2016-09-26 23:45:11'),
(4, 'Chính sách đào tạo', '2016-09-26 23:45:23', '2016-09-26 23:45:23'),
(5, 'Thông Tin Tuyển Dụng', '2016-09-26 23:45:54', '2016-09-26 23:45:54');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
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
  KEY `users_department_id_foreign` (`department_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=21 ;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `name`, `email`, `password`, `avatar`, `role_id`, `department_id`, `remember_token`, `type`, `status`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'Admin Docman', 'kevinkool9x@gmail.com', '$2y$10$KXrCyQe4tSlJ0zaPN6VD8efh31iJQ1pvAho4ZyqYMNowKobhru.T6', 'public/images/avatar/041702181216544018_219953954807409_1109699905_n.jpg', 1, 1, 'J3kojlHDuPZ3WgSMvHowqkpxyG9qw1e5ezAOnFs7DTgG7s3Gc5ROHw4mlKxI', 0, 1, NULL, '2016-12-18 20:15:50'),
(10, 'ccne', 'Trung tâm Máy tính', 'ccne@vnu.edu.vn', '$2y$10$J6AuUKnUJfvtmwzNSFuS4e1tYoYCgvFDf2brlHn5DQIycI.PjQWYe', 'public/images/avatar.png', 3, 1, '573hpa0Cm2WLbRKIz0kQCgw1zKfm9oT4VLkgEemfk4x669SHYTOTgb2rXt3e', 1, 1, '2016-12-12 03:07:39', '2016-12-18 20:12:41'),
(12, 'kiendh', 'Đỗ Hoàng Kiên', 'kiendh@vnu.edu.vn', '$2y$10$mBIm6OX9oY/4GMVrtB7mr.PYP3wWIZfNftMWBPH4R/elfHMnMe8KC', 'public/images/avatar.png', 1, 8, 'MyfMWoTBaki3jD88kZbWd4YeKmJ63tCkKdlZvp8Sm7IPjWh2c4kaYn2Dkwjn', 1, 1, '2016-12-18 18:35:10', '2016-12-18 20:09:14'),
(13, 'trienpm', 'Phạm Minh Triển', 'trienpm@vnu.edu.vn', '$2y$10$ODFSTUsoV2S/xOr9CnpgieTDrXlMFFDUewkd/WFdtNH07uEe43nIq', 'public/images/avatar.png', 3, 5, NULL, 1, 1, '2016-12-18 18:57:03', '2016-12-18 18:57:27'),
(14, 'khoatd', NULL, NULL, '$2y$10$skjv1W3.TJIA5UT3vArU6.w.Xr27UTAYPoLBEU.WXAr3M7dtYbLXi', 'public/images/avatar.png', 3, NULL, 'PcAf0hGMFbEYfdLx9oZ4MUJSD3HjWyNzEH8L237lZ4oakH37p08vVdWJccqu', 1, 1, '2016-12-18 19:57:54', '2016-12-18 19:59:27'),
(15, 'ninhbt', 'Nguyễn Thị Hồng', 'hongnt1991@vnu.edu.vn', '$2y$10$xwK76EXljdUuoscyjxoxFecWmSDMsYxSIy7AlolNukTs2OrASwDYi', 'public/images/avatar.png', 2, 7, 'tOmXCeSonjh26nheBDPnrsbKH6vYNazGr8OYGAEzjYff04NTe0s0xVWb5Ypx', 1, 1, '2016-12-18 19:58:07', '2016-12-21 00:43:17'),
(16, 'hungpd', 'Pham Duy Hung', 'hungpd@vnu.edu.vn', '$2y$10$/2tNjcHFRFMQHMMZTdpvaevmGAFr6KRPn5nkRd1oGHrC9q9vemzvi', 'public/images/avatar.png', 1, 3, NULL, 1, 1, '2016-12-18 19:58:41', '2017-09-28 19:09:11'),
(17, 'hattt', 'Trần Thị Thu Hà', 'hattt@vnu.edu.vn', '$2y$10$krRzcLMdoyHKwqApR0SPGehsiA7z92AHhqIIDMFiU94obhELSjBeO', 'public/images/avatar.png', 2, 6, 'X79UYWbMq34srP6ZvjOny8Eokp62lRLfZtFxIibjiVlNChxKMIFRhjiTkkjf', 1, 1, '2016-12-19 20:46:55', '2016-12-21 00:42:41'),
(18, 'vietanh', 'Nguyễn Việt Anh', 'vietanh@vnu.edu.vn', '$2y$10$IykjF3IFWpefKGmjgfc0T.4V9iJM3LI/Stku1tPUnpkhjg3/6ocei', 'public/images/avatar.png', 1, 8, 'sGUZTeGdqFTC0xIiULktf7EcGeuKb0Y5fjr46SIUJCqDl7aliGDVf9l5UeIj', 1, 1, '2017-03-01 00:51:41', '2017-11-02 21:01:19'),
(19, 'hanv', 'Nguyễn Việt Hà', 'hanv@vnu.edu.vn', '$2y$10$TlFU5rZf1sQoUDMGf97UauOXZIbvF6BUM7UqjpPN3CVEIBrHfpOfS', 'public/images/avatar.png', 1, 10, NULL, 1, 1, '2017-09-20 19:38:27', '2017-09-25 21:36:05'),
(20, 'vanthu', 'Nguyễn Văn Thư', 'nguyenvanthu@vnu.edu.vn', '$2y$10$JgWArc2ZCOe5SqYUUYcTQe6hS8tkbrRCJ0vAoosCGkCmj2SGzbdnK', 'public/images/avatar.png', 3, 11, 'L6enOiS5WOZWjgSG7FYPitt6yQsUP0zCfxhmVUPuqfaWEO36KtGhRcBPT5su', 0, 1, '2017-11-02 21:01:10', '2017-11-03 01:33:14');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `documents`
--
ALTER TABLE `documents`
  ADD CONSTRAINT `documents_typedoc_id_foreign` FOREIGN KEY (`typedoc_id`) REFERENCES `type_documents` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `documents_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_department_id_foreign` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `users_role_id_foreign` FOREIGN KEY (`role_id`) REFERENCES `roles` (`id`) ON DELETE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
