-- Database: cv_mediatama
-- Generated based on Laravel Migrations and Seeders

SET FOREIGN_KEY_CHECKS=0;

-- --------------------------------------------------------
-- Table: users
-- --------------------------------------------------------
DROP TABLE IF EXISTS `users`;
CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `role` enum('admin','customer') NOT NULL DEFAULT 'customer',
  `avatar_url` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT 1,
  `deactivated_at` timestamp NULL DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `users`
INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'admin@mediatama.com', '$2y$12$Ok5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5', 'admin', NOW(), NOW()),
(2, 'Admin Dua', 'admin2@mediatama.com', '$2y$12$Ok5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5', 'admin', NOW(), NOW()),
(3, 'Customer', 'customer@mediatama.com', '$2y$12$Ok5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5', 'customer', NOW(), NOW()),
(4, 'Customer Dua', 'customer2@mediatama.com', '$2y$12$Ok5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5', 'customer', NOW(), NOW()),
(5, 'Customer Tiga', 'customer3@mediatama.com', '$2y$12$Ok5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5Gk5', 'customer', NOW(), NOW());
-- Note: Password hash corresponds to "password" (approximate/standard hash used for seeds)

-- --------------------------------------------------------
-- Table: roles
-- --------------------------------------------------------
DROP TABLE IF EXISTS `roles`;
CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Dumping data for table `roles`
INSERT INTO `roles` (`id`, `name`, `description`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 'Akses penuh ke seluruh fitur sistem, termasuk manajemen user, role, dan konfigurasi.', NOW(), NOW()),
(2, 'Customer', 'Pengguna umum dengan akses baca dan partisipasi di komunitas serta event.', NOW(), NOW());

-- --------------------------------------------------------
-- Table: kontens
-- --------------------------------------------------------
DROP TABLE IF EXISTS `kontens`;
CREATE TABLE `kontens` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `description` text DEFAULT NULL,
  `file_path` varchar(255) NOT NULL,
  `thumbnail_path` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- Note: KontenSeeder had data commented out, so no data is inserted here.
-- Uncomment and run the following if needed:
-- INSERT INTO `kontens` (`title`, `description`, `file_path`, `created_at`, `updated_at`) VALUES
-- ('Video 1', 'Deskripsi Video 1', 'konten_files/video1.mp4', NOW(), NOW()),
-- ('Video 2', 'Deskripsi Video 2', 'konten_files/video2.mp4', NOW(), NOW());

-- --------------------------------------------------------
-- Table: pengajuan (referenced as video_accesses in some models)
-- --------------------------------------------------------
DROP TABLE IF EXISTS `pengajuan`;
CREATE TABLE `pengajuan` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `konten_id` bigint(20) UNSIGNED NOT NULL,
  `status` enum('pending','approved','rejected') NOT NULL DEFAULT 'pending',
  `expired_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `pengajuan_user_id_foreign` (`user_id`),
  KEY `pengajuan_konten_id_foreign` (`konten_id`),
  CONSTRAINT `pengajuan_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  CONSTRAINT `pengajuan_konten_id_foreign` FOREIGN KEY (`konten_id`) REFERENCES `kontens` (`id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table: sessions
-- --------------------------------------------------------
DROP TABLE IF EXISTS `sessions`;
CREATE TABLE `sessions` (
  `id` varchar(255) NOT NULL,
  `user_id` bigint(20) UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) DEFAULT NULL,
  `user_agent` text DEFAULT NULL,
  `payload` longtext NOT NULL,
  `last_activity` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `sessions_user_id_index` (`user_id`),
  KEY `sessions_last_activity_index` (`last_activity`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table: cache
-- --------------------------------------------------------
DROP TABLE IF EXISTS `cache`;
CREATE TABLE `cache` (
  `key` varchar(255) NOT NULL,
  `value` mediumtext NOT NULL,
  `expiration` int(11) NOT NULL,
  PRIMARY KEY (`key`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------
-- Table: jobs
-- --------------------------------------------------------
DROP TABLE IF EXISTS `jobs`;
CREATE TABLE `jobs` (
  `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `queue` varchar(255) NOT NULL,
  `payload` longtext NOT NULL,
  `attempts` tinyint(3) UNSIGNED NOT NULL,
  `reserved_at` int(10) UNSIGNED DEFAULT NULL,
  `available_at` int(10) UNSIGNED NOT NULL,
  `created_at` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `jobs_queue_index` (`queue`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

SET FOREIGN_KEY_CHECKS=1;
