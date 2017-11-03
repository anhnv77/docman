-- phpMyAdmin SQL Dump
-- version 4.5.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Oct 04, 2016 at 06:22 PM
-- Server version: 10.1.13-MariaDB
-- PHP Version: 5.6.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `pdm`
--

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `alias` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(7, 'Phòng Công tác sinh viên ', 'PCTSV', 'A03-307', '2016-09-26 23:27:41', '2016-09-26 23:27:41');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `is_public` tinyint(1) NOT NULL DEFAULT '0',
  `user_id` int(10) UNSIGNED NOT NULL,
  `typedoc_id` int(10) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`id`, `title`, `content`, `description`, `is_public`, `user_id`, `typedoc_id`, `created_at`, `updated_at`) VALUES
(5, 'Bài 2', 'laptrinhlaravel_bai2.pdf', 'Bài 2: Học laravel căn bản 1Phạm Thị Hà. \r\nBài 2: Học laravel căn bản 1Phạm Thị Hà. \r\nBài 2: Học laravel căn bản 1Phạm Thị Hà. \r\nBài 2: Học laravel căn bản 1Phạm Thị Hà. \r\nBài 2: Học laravel căn bản 1Phạm Thị Hà. ', 0, 2, 2, '2016-09-27 09:47:32', '2016-10-04 08:05:31'),
(6, 'Bài 3', '[BTT] laptrinhlaravel_bai3.pdf', 'Bài 3: Học laravel căn bản 2', 0, 2, 2, '2016-09-27 09:48:02', '2016-09-27 09:48:02'),
(7, 'Bài 4', '[BTT] laptrinhlaravel_bai4.pdf', 'Bài 4: Học laravel căn bản 3', 0, 2, 2, '2016-09-27 09:48:25', '2016-09-27 09:48:25'),
(8, 'Bài 1', '[BTT] laptrinhlaravel_bai1.pdf', 'Bài 1: Cài đặt composer và laravel', 0, 7, 2, '2016-09-27 21:36:35', '2016-09-27 21:36:35'),
(9, 'Bài 5', '[BTT] laptrinhlaravel_bai5.pdf', 'Bài 5: Lập trình laravel căn bản 5', 0, 7, 2, '2016-09-27 21:37:05', '2016-09-27 21:37:05'),
(10, 'Bài 6', '[BTT] laptrinhlaravel_bai6.pdf', 'Bài 6: Lập trình laravel căn bản 6', 0, 6, 2, '2016-09-27 21:37:51', '2016-09-27 21:37:51'),
(11, 'Bài 7', '[BTT] laptrinhlaravel_bai7.pdf', 'Bài 7: Lập trình laravel căn bản 7', 1, 6, 2, '2016-09-27 21:38:18', '2016-09-27 21:38:18'),
(12, 'AAAAAAAA', '[PTCCB] laptrinhlaravel_bai7.pdf', 'Bài 2haffionngkwnvknnwnbnlmfk', 0, 6, 2, '2016-10-04 09:06:07', '2016-10-04 09:06:07');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
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

CREATE TABLE `roles` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE `type_documents` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `avatar` varchar(255) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'images/avatar.png',
  `role_id` int(10) UNSIGNED NOT NULL,
  `department_id` int(10) UNSIGNED NOT NULL,
  `remember_token` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `role_id`, `department_id`, `remember_token`, `created_at`, `updated_at`) VALUES
(2, 'admin', 'admin@gmail.com', '$2y$10$wpSqfinfm.CAg292BeNmB.ArPoYnBTRi4w9KswMpo9N79BpK0WQ6W', 'images/avatar/11382549_450176491822923_1547002734_n.jpg', 1, 1, 'GwIvumLXegy08IvvLhByCp6M4iXBYsYp2apP7ncgDdHkyyxoUiEqXjMIYGYP', NULL, '2016-10-04 09:05:10'),
(6, 'Phạm Hà', 'phamha.uet@gmail.com', '$2y$10$XptYchptmoVgBsQYodXdB.8ER/m.KB0pjpk0XgjPtxXw/yy10Vx.2', 'images/avatar.png', 2, 2, 'ISuHRLdQjmmyBXNlhd6VikKv0ipWDwtTfaznrUnRaP2NcjOyxAw5Cs55mOgc', '2016-09-27 12:35:16', '2016-10-04 09:06:12'),
(7, 'Thế Văn', 'thevanxda@gmail.com', '$2y$10$uttdFTvLw.X8abtgVVZM/uwDMLXakRVRgH5UQfsJOAQgGHS.N3x1O', 'images/avatar.png', 3, 1, '5kUFWdfynErr2T2CRbT9CtLKqHXfmj4Xs7fKrEHsCP0NrSlN6UTTwHDOba7r', '2016-09-27 12:35:41', '2016-10-04 08:38:54');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`id`),
  ADD KEY `documents_user_id_foreign` (`user_id`),
  ADD KEY `documents_typedoc_id_foreign` (`typedoc_id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `type_documents`
--
ALTER TABLE `type_documents`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD KEY `users_role_id_foreign` (`role_id`),
  ADD KEY `users_department_id_foreign` (`department_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `type_documents`
--
ALTER TABLE `type_documents`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
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
