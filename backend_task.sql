-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 19, 2024 at 03:08 PM
-- Server version: 10.4.27-MariaDB
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `backend_task`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_name` varchar(191) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `user_id`, `category_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Full Stack Development', 'Active', '2024-04-16 00:48:06', '2024-04-16 00:53:17'),
(2, 1, 'Web Development', 'Active', '2024-04-16 00:48:27', '2024-04-16 00:48:27'),
(3, 1, 'App Development with admin panel', 'Active', '2024-04-16 00:48:38', '2024-04-16 00:48:38'),
(5, 1, 'App Development without admin panel', 'Active', '2024-04-16 00:54:33', '2024-04-16 00:54:33');

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_name` varchar(191) NOT NULL,
  `client_email` varchar(191) DEFAULT NULL,
  `client_phone` varchar(191) DEFAULT NULL,
  `company_name` varchar(191) NOT NULL,
  `client_address` text DEFAULT NULL,
  `image` varchar(191) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`id`, `user_id`, `client_name`, `client_email`, `client_phone`, `company_name`, `client_address`, `image`, `created_at`, `updated_at`) VALUES
(2, 1, 'AL Ekram', 'ekramhossainekram28@gmail.com', '01799327845', 'ABC Company', 'Dhaka, Bangladesh', 'uploads/clients/1713255123.png', '2024-04-16 02:12:03', '2024-04-16 02:12:03');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `department_name` varchar(191) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `user_id`, `department_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Finance & Accountings', 'Active', '2024-04-16 02:48:12', '2024-04-16 02:53:56'),
(2, 1, 'IT & Development', 'Active', '2024-04-16 02:48:47', '2024-04-16 02:48:47'),
(3, 1, 'Human Resource Management', 'Active', '2024-04-16 02:48:59', '2024-04-16 02:48:59');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `designation_name` varchar(191) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `user_id`, `designation_name`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, 'Web Developer', 'Active', '2024-04-17 22:37:45', '2024-04-17 22:37:45'),
(2, 1, 'Mobile App Developer', 'Active', '2024-04-17 22:38:40', '2024-04-17 22:38:40');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(191) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `invoices`
--

CREATE TABLE `invoices` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `invoice_no` varchar(191) NOT NULL,
  `invoice_date` date NOT NULL,
  `subtotal` double(10,2) NOT NULL,
  `discount` double(10,2) NOT NULL DEFAULT 0.00,
  `total` double(10,2) NOT NULL DEFAULT 0.00,
  `pay` double(10,2) NOT NULL,
  `due` double(10,2) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `invoices`
--

INSERT INTO `invoices` (`id`, `user_id`, `client_id`, `invoice_no`, `invoice_date`, `subtotal`, `discount`, `total`, `pay`, `due`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 'INV-24001', '2024-04-16', 900.00, 0.00, 900.00, 500.00, 400.00, '2024-04-16 05:30:45', '2024-04-16 05:30:45');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2024_04_16_052730_create_categories_table', 1),
(6, '2024_04_16_053058_create_clients_table', 1),
(7, '2024_04_16_053629_create_projects_table', 1),
(8, '2024_04_16_082153_create_departments_table', 2),
(9, '2024_04_16_095213_create_invoices_table', 3),
(10, '2024_04_17_083030_create_designations_table', 4),
(11, '2024_04_18_045822_create_roles_table', 5),
(12, '2024_04_18_064217_create_userinfos_table', 6),
(13, '2024_04_18_095314_create_teamleaders_table', 7),
(14, '2024_04_18_111919_create_tasks_table', 8),
(15, '2024_04_18_113147_create_task_user_table', 9);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) NOT NULL,
  `token` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(191) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `personal_access_tokens`
--

INSERT INTO `personal_access_tokens` (`id`, `tokenable_type`, `tokenable_id`, `name`, `token`, `abilities`, `last_used_at`, `created_at`, `updated_at`) VALUES
(2, 'App\\Models\\User', 1, 'MyApp', 'a3980d9ddde42e52b48f8180ea277c4435e367d85d320ef92ac8c9e4069ae73a', '[\"*\"]', '2024-04-16 05:54:38', '2024-04-16 00:34:18', '2024-04-16 05:54:38'),
(3, 'App\\Models\\User', 1, 'MyApp', '32a7e6d269695d3afef8ea5433fcceb6f416451e004907382cb44096ce53fe8c', '[\"*\"]', '2024-04-18 03:48:50', '2024-04-17 01:03:49', '2024-04-18 03:48:50'),
(4, 'App\\Models\\User', 1, 'MyApp', '682a670bdd279d67a521bf60a77b6be028f1c0da9c6b33deeb65181831f67b11', '[\"*\"]', '2024-04-18 12:18:12', '2024-04-18 10:41:55', '2024-04-18 12:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `projects`
--

CREATE TABLE `projects` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `project_name` varchar(191) NOT NULL,
  `project_priority` enum('Low','Medium','High') NOT NULL,
  `start_date` datetime NOT NULL,
  `duration` double(10,2) NOT NULL,
  `duration_unit` enum('Day','Month','Week','Year') NOT NULL,
  `end_date` datetime NOT NULL,
  `project_cost` double(10,2) NOT NULL DEFAULT 0.00,
  `status` enum('Pending','Confirm','On going','Completed','Finished','Cancel') NOT NULL DEFAULT 'Pending',
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `projects`
--

INSERT INTO `projects` (`id`, `user_id`, `category_id`, `client_id`, `project_name`, `project_priority`, `start_date`, `duration`, `duration_unit`, `end_date`, `project_cost`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 'Complete Newspaper Website', 'Medium', '2024-04-16 15:30:00', 10.00, 'Day', '2024-04-26 15:30:00', 400.00, 'Confirm', 'Project Details', '2024-04-16 03:23:37', '2024-04-16 03:23:37'),
(2, 1, 1, 2, 'Complete Ecommerce Website with Mobile APP', 'High', '2024-04-16 15:30:00', 1.00, 'Month', '2024-05-16 15:30:00', 500.00, 'Confirm', 'Project Details', '2024-04-16 03:26:50', '2024-04-16 03:26:50');

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_name` varchar(191) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `user_id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 1, 'admin', NULL, NULL),
(2, 2, 'employee', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `task_title` varchar(191) NOT NULL,
  `project_priority` enum('Low','Medium','High') NOT NULL,
  `start_date` datetime NOT NULL,
  `duration` double(10,2) NOT NULL,
  `duration_unit` enum('Day','Month','Week','Year') NOT NULL,
  `end_date` datetime NOT NULL,
  `status` enum('Pending','Start','On going','Testing','Completed') NOT NULL DEFAULT 'Pending',
  `description` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `user_id`, `category_id`, `department_id`, `project_id`, `task_title`, `project_priority`, `start_date`, `duration`, `duration_unit`, `end_date`, `status`, `description`, `created_at`, `updated_at`) VALUES
(1, 1, 2, 2, 1, 'Newspaper Website Design', 'Medium', '2024-04-20 00:00:00', 7.00, 'Day', '2024-04-27 00:00:00', 'Pending', 'Newspaper Websitr Design with Responsive', '2024-04-18 12:16:24', '2024-04-18 12:16:24'),
(2, 1, 2, 2, 1, 'Dynamic News Website & Develop Rest API', 'High', '2024-04-20 00:00:00', 7.00, 'Day', '2024-04-27 00:00:00', 'Pending', 'Dynamic News Website & Develop Rest API', '2024-04-18 12:18:12', '2024-04-18 12:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `task_user`
--

CREATE TABLE `task_user` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `task_id` bigint(20) UNSIGNED NOT NULL,
  `user_id` bigint(20) UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `task_user`
--

INSERT INTO `task_user` (`id`, `task_id`, `user_id`, `created_at`, `updated_at`) VALUES
(1, 1, 2, NULL, NULL),
(2, 2, 3, NULL, NULL),
(3, 2, 4, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `teamleaders`
--

CREATE TABLE `teamleaders` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `added_by` int(11) NOT NULL,
  `project_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userinfos`
--

CREATE TABLE `userinfos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) NOT NULL,
  `employee_id` varchar(191) DEFAULT NULL,
  `nid_passport` varchar(191) DEFAULT NULL,
  `department_id` int(11) NOT NULL,
  `designation_id` int(11) NOT NULL,
  `joining_date` date NOT NULL,
  `address` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `userinfos`
--

INSERT INTO `userinfos` (`id`, `user_id`, `employee_id`, `nid_passport`, `department_id`, `designation_id`, `joining_date`, `address`, `created_at`, `updated_at`) VALUES
(1, 2, 'ID-24001', '5525583786', 2, 1, '2024-01-01', 'Dhaka, Bangladesh', '2024-04-18 03:22:11', '2024-04-18 03:22:11'),
(2, 3, 'ID-24002', '5525583785', 2, 1, '2024-01-02', 'Dhaka, Bangladesh', '2024-04-18 03:25:23', '2024-04-18 03:25:23'),
(3, 4, 'ID-24003', '5525583784', 2, 2, '2024-01-03', 'Dhaka, Bangladesh', '2024-04-18 03:27:28', '2024-04-18 03:27:28');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(191) NOT NULL,
  `role_id` int(11) NOT NULL,
  `email` varchar(191) NOT NULL,
  `phone` varchar(191) DEFAULT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `image` varchar(191) DEFAULT 'defaults/profile.png',
  `password` varchar(191) NOT NULL,
  `status` enum('Active','Inactive') NOT NULL DEFAULT 'Active',
  `added_by` int(11) DEFAULT NULL,
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `role_id`, `email`, `phone`, `email_verified_at`, `image`, `password`, `status`, `added_by`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Admin', 1, 'admin@gmail.com', NULL, NULL, 'defaults/profile.png', '$2y$10$XNg.XgeHy1fIDQg4cT3U4unsRcEQ.M9bR6xAd324aldQz6.EwlLbG', 'Active', NULL, NULL, NULL, NULL),
(2, 'AL Ekram', 2, 'ekramhossainekram28@gmail.com', '01799327845', NULL, 'uploads/users/1713432131.png', '$2y$10$IJVxx35Gr1ZwNnGsRRoA8OaCTDaoezN4ZtaKzu0aS5rRw1ju6X2oC', 'Active', 1, NULL, '2024-04-18 03:22:11', '2024-04-18 03:22:11'),
(3, 'Md. Ekram Hossain', 2, 'freelancerekram28@gmail.com', '01799327846', NULL, 'uploads/users/1713432323.png', '$2y$10$ELJIyQTNzB3BOck6zG65Ou5d0yM13Wfc3AgYfRxSw5Ty57RzypiIu', 'Active', 1, NULL, '2024-04-18 03:25:23', '2024-04-18 03:25:23'),
(4, 'Md. Ovi', 2, 'ovi@gmail.com', '01799327840', NULL, 'uploads/users/1713432448.png', '$2y$10$4vpJpUY3zkjdxMV0GUhqs.zGh3vdz.gCsGoJZOGBcbB9c/ksC2ANO', 'Active', 1, NULL, '2024-04-18 03:27:28', '2024-04-18 03:27:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `categories_category_name_unique` (`category_name`);

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `clients_client_email_unique` (`client_email`),
  ADD UNIQUE KEY `clients_client_phone_unique` (`client_phone`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `departments_department_name_unique` (`department_name`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `designations_designation_name_unique` (`designation_name`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `invoices`
--
ALTER TABLE `invoices`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `invoices_invoice_no_unique` (`invoice_no`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `projects`
--
ALTER TABLE `projects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `roles_role_name_unique` (`role_name`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `task_user`
--
ALTER TABLE `task_user`
  ADD PRIMARY KEY (`id`),
  ADD KEY `task_user_task_id_foreign` (`task_id`),
  ADD KEY `task_user_user_id_foreign` (`user_id`);

--
-- Indexes for table `teamleaders`
--
ALTER TABLE `teamleaders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `userinfos`
--
ALTER TABLE `userinfos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `userinfos_employee_id_unique` (`employee_id`),
  ADD UNIQUE KEY `userinfos_nid_passport_unique` (`nid_passport`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `users_phone_unique` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `invoices`
--
ALTER TABLE `invoices`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `projects`
--
ALTER TABLE `projects`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `task_user`
--
ALTER TABLE `task_user`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `teamleaders`
--
ALTER TABLE `teamleaders`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userinfos`
--
ALTER TABLE `userinfos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `task_user`
--
ALTER TABLE `task_user`
  ADD CONSTRAINT `task_user_task_id_foreign` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `task_user_user_id_foreign` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
