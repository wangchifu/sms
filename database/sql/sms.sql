-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2022 年 08 月 09 日 09:37
-- 伺服器版本： 8.0.27-0ubuntu0.21.04.1
-- PHP 版本： 7.4.16

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫: `sms`
--

-- --------------------------------------------------------

--
-- 資料表結構 `job_titles`
--

CREATE TABLE `job_titles` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `schools` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `kind` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title_kind` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `title` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `cloudschool_username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `role` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `lunch_class_dates`
--

CREATE TABLE `lunch_class_dates` (
  `id` int UNSIGNED NOT NULL,
  `student_class_id` int UNSIGNED NOT NULL,
  `order_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int UNSIGNED NOT NULL,
  `lunch_order_id` int UNSIGNED NOT NULL,
  `lunch_factory_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eat_style1` int UNSIGNED DEFAULT NULL,
  `eat_style2` int UNSIGNED DEFAULT NULL,
  `eat_style3` int UNSIGNED DEFAULT NULL,
  `eat_style4` int UNSIGNED DEFAULT NULL,
  `eat_style4_egg` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `lunch_factories`
--

CREATE TABLE `lunch_factories` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disable` tinyint DEFAULT NULL,
  `fid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `fpwd` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `lunch_orders`
--

CREATE TABLE `lunch_orders` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int UNSIGNED NOT NULL,
  `rece_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rece_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rece_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `rece_num` int UNSIGNED NOT NULL,
  `order_ps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `date_ps_ps` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `lunch_order_dates`
--

CREATE TABLE `lunch_order_dates` (
  `id` int UNSIGNED NOT NULL,
  `order_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enable` tinyint NOT NULL,
  `semester` int UNSIGNED NOT NULL,
  `lunch_order_id` int UNSIGNED NOT NULL,
  `date_ps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `lunch_places`
--

CREATE TABLE `lunch_places` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `disable` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `lunch_setups`
--

CREATE TABLE `lunch_setups` (
  `id` int UNSIGNED NOT NULL,
  `semester` int UNSIGNED NOT NULL,
  `eat_styles` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `die_line` tinyint NOT NULL,
  `teacher_open` tinyint DEFAULT NULL,
  `disable` tinyint DEFAULT NULL,
  `all_rece_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `all_rece_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `all_rece_no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `teacher_money` double(8,2) DEFAULT NULL,
  `all_rece_num` int UNSIGNED NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `lunch_stu_dates`
--

CREATE TABLE `lunch_stu_dates` (
  `id` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `order_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int UNSIGNED NOT NULL,
  `lunch_order_id` int UNSIGNED NOT NULL,
  `lunch_factory_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eat_style` int UNSIGNED NOT NULL,
  `eat_style_egg` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `lunch_tea_dates`
--

CREATE TABLE `lunch_tea_dates` (
  `id` int UNSIGNED NOT NULL,
  `order_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enable` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int UNSIGNED NOT NULL,
  `lunch_order_id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED NOT NULL,
  `lunch_place_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `lunch_factory_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `eat_style` int UNSIGNED NOT NULL,
  `eat_style_egg` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 傾印資料表的資料 `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(17, '2014_10_12_000000_create_users_table', 1),
(18, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(19, '2021_10_21_234821_create_school_apis_table', 1),
(20, '2021_10_21_235021_create_job_titles_table', 1),
(21, '2021_10_22_200032_create_school_powers_table', 1),
(22, '2021_11_29_011944_create_students_table', 1),
(23, '2021_11_29_112003_create_student_classes_table', 1),
(24, '2022_02_17_095705_create_sessions_table', 1),
(25, '2022_07_21_135149_create_lunch_setups_table', 1),
(26, '2022_07_21_135209_create_lunch_orders_table', 1),
(27, '2022_07_21_141135_create_lunch_factories_table', 1),
(28, '2022_07_21_141149_create_lunch_places_table', 1),
(29, '2022_07_21_152624_create_lunch_order_dates_table', 1),
(30, '2022_07_21_160710_create_lunch_tea_dates', 1),
(31, '2022_07_21_230003_create_lunch_stu_dates', 1),
(32, '2022_07_21_230004_create_lunch_class_dates', 1);

-- --------------------------------------------------------

--
-- 資料表結構 `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `school_apis`
--

CREATE TABLE `school_apis` (
  `id` bigint UNSIGNED NOT NULL,
  `client_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `school_powers`
--

CREATE TABLE `school_powers` (
  `id` bigint UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `module` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `power_type` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `students`
--

CREATE TABLE `students` (
  `id` bigint UNSIGNED NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `birthday` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pwd` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `parents_telephone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `student_sn` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num` tinyint NOT NULL,
  `disable` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `student_classes`
--

CREATE TABLE `student_classes` (
  `id` bigint UNSIGNED NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_year` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `student_class` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_ids` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_names` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `uid` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `edu_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `username` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `order_by` tinyint DEFAULT NULL,
  `login_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `local_module` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `system_admin` tinyint DEFAULT NULL,
  `disable` tinyint DEFAULT NULL,
  `disabled_by` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- 已傾印資料表的索引
--

--
-- 資料表索引 `job_titles`
--
ALTER TABLE `job_titles`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `lunch_class_dates`
--
ALTER TABLE `lunch_class_dates`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `lunch_factories`
--
ALTER TABLE `lunch_factories`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `lunch_orders`
--
ALTER TABLE `lunch_orders`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lunch_orders_name_unique` (`name`);

--
-- 資料表索引 `lunch_order_dates`
--
ALTER TABLE `lunch_order_dates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lunch_order_dates_order_date_unique` (`order_date`);

--
-- 資料表索引 `lunch_places`
--
ALTER TABLE `lunch_places`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `lunch_setups`
--
ALTER TABLE `lunch_setups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `lunch_setups_semester_unique` (`semester`);

--
-- 資料表索引 `lunch_stu_dates`
--
ALTER TABLE `lunch_stu_dates`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `lunch_tea_dates`
--
ALTER TABLE `lunch_tea_dates`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- 資料表索引 `school_apis`
--
ALTER TABLE `school_apis`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `school_powers`
--
ALTER TABLE `school_powers`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- 資料表索引 `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `student_classes`
--
ALTER TABLE `student_classes`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `job_titles`
--
ALTER TABLE `job_titles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lunch_class_dates`
--
ALTER TABLE `lunch_class_dates`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lunch_factories`
--
ALTER TABLE `lunch_factories`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lunch_orders`
--
ALTER TABLE `lunch_orders`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lunch_order_dates`
--
ALTER TABLE `lunch_order_dates`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lunch_places`
--
ALTER TABLE `lunch_places`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lunch_setups`
--
ALTER TABLE `lunch_setups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lunch_stu_dates`
--
ALTER TABLE `lunch_stu_dates`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lunch_tea_dates`
--
ALTER TABLE `lunch_tea_dates`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `school_apis`
--
ALTER TABLE `school_apis`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `school_powers`
--
ALTER TABLE `school_powers`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `students`
--
ALTER TABLE `students`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `student_classes`
--
ALTER TABLE `student_classes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
