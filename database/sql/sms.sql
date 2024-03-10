-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- 主機： localhost
-- 產生時間： 2024 年 03 月 09 日 09:09
-- 伺服器版本： 8.0.34-0ubuntu0.22.04.1
-- PHP 版本： 7.4.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- 資料庫： `sms`
--

-- --------------------------------------------------------

--
-- 資料表結構 `clubs`
--

CREATE TABLE `clubs` (
  `id` int UNSIGNED NOT NULL,
  `no` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `semester` int UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `contact_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `telephone_num` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `money` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `people` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `teacher_info` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `start_time` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `place` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `ps` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `taking` int UNSIGNED NOT NULL,
  `prepare` int UNSIGNED NOT NULL,
  `year_limit` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `class_id` tinyint NOT NULL,
  `no_check` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `club_blacks`
--

CREATE TABLE `club_blacks` (
  `id` int UNSIGNED NOT NULL,
  `semester` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `class_id` tinyint NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `club_not_registers`
--

CREATE TABLE `club_not_registers` (
  `id` int UNSIGNED NOT NULL,
  `semester` int UNSIGNED NOT NULL,
  `ip` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `event` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `club_registers`
--

CREATE TABLE `club_registers` (
  `id` int UNSIGNED NOT NULL,
  `semester` int UNSIGNED NOT NULL,
  `club_id` int UNSIGNED NOT NULL,
  `student_id` int UNSIGNED NOT NULL,
  `class_id` tinyint NOT NULL,
  `second` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `club_semesters`
--

CREATE TABLE `club_semesters` (
  `id` int UNSIGNED NOT NULL,
  `semester` int UNSIGNED NOT NULL,
  `start_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stop_date` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `club_limit` tinyint NOT NULL,
  `start_date2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `stop_date2` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `second` int UNSIGNED DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

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
  `office` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
-- 資料表結構 `lend_classes`
--

CREATE TABLE `lend_classes` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `lend_items`
--

CREATE TABLE `lend_items` (
  `id` bigint UNSIGNED NOT NULL,
  `lend_class_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `num` int UNSIGNED NOT NULL,
  `user_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `enable` tinyint DEFAULT NULL,
  `ps` text COLLATE utf8mb4_unicode_ci,
  `lend_sections` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(3, '2021_10_21_234821_create_school_apis_table', 1),
(4, '2021_10_21_235021_create_job_titles_table', 1),
(5, '2021_10_22_200032_create_school_powers_table', 1),
(6, '2021_11_29_011944_create_students_table', 1),
(7, '2021_11_29_112003_create_student_classes_table', 1),
(8, '2022_02_17_095705_create_sessions_table', 1),
(9, '2022_07_21_135149_create_lunch_setups_table', 1),
(10, '2022_07_21_135209_create_lunch_orders_table', 1),
(11, '2022_07_21_141135_create_lunch_factories_table', 1),
(12, '2022_07_21_141149_create_lunch_places_table', 1),
(13, '2022_07_21_152624_create_lunch_order_dates_table', 1),
(14, '2022_07_21_160710_create_lunch_tea_dates', 1),
(15, '2022_07_21_230003_create_lunch_stu_dates', 1),
(16, '2022_07_21_230004_create_lunch_class_dates', 1),
(17, '2023_08_10_112116_create_clubs_table', 1),
(18, '2023_08_10_114738_create_club_semesters_table', 1),
(19, '2023_08_10_115836_create_club_registers_table', 1),
(20, '2023_08_10_125836_create_club_blacks_table', 1),
(21, '2023_08_10_155836_create_club_not_registers_table', 1),
(22, '2023_08_26_015338_create_sport_actions_table', 1),
(23, '2023_09_04_015338_create_sport_items_table', 1),
(24, '2024_03_09_011111_create_lend_classes_table', 1),
(25, '2024_03_09_022222_create_lend_items_table', 1);

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
  `client_id` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `client_secret` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seal2` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seal3` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `seal4` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
-- 資料表結構 `sport_actions`
--

CREATE TABLE `sport_actions` (
  `id` bigint UNSIGNED NOT NULL,
  `semester` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `track` int UNSIGNED NOT NULL,
  `field` int UNSIGNED NOT NULL,
  `frequency` int UNSIGNED NOT NULL,
  `numbers` int UNSIGNED NOT NULL,
  `disable` tinyint DEFAULT NULL,
  `started_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `stopped_at` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- 資料表結構 `sport_items`
--

CREATE TABLE `sport_items` (
  `id` bigint UNSIGNED NOT NULL,
  `sport_action_id` int UNSIGNED NOT NULL,
  `order` int UNSIGNED DEFAULT NULL,
  `game_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `official` tinyint DEFAULT NULL,
  `reserve` tinyint DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `group` tinyint NOT NULL,
  `type` tinyint NOT NULL,
  `years` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `limit` tinyint DEFAULT NULL,
  `people` tinyint NOT NULL,
  `reward` tinyint NOT NULL,
  `disable` tinyint DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
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
  `edu_key` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
  `edu_key` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `sex` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
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
-- 資料表索引 `clubs`
--
ALTER TABLE `clubs`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `club_blacks`
--
ALTER TABLE `club_blacks`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `club_not_registers`
--
ALTER TABLE `club_not_registers`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `club_registers`
--
ALTER TABLE `club_registers`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `club_semesters`
--
ALTER TABLE `club_semesters`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `club_semesters_semester_unique` (`semester`);

--
-- 資料表索引 `job_titles`
--
ALTER TABLE `job_titles`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `lend_classes`
--
ALTER TABLE `lend_classes`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `lend_items`
--
ALTER TABLE `lend_items`
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
-- 資料表索引 `sport_actions`
--
ALTER TABLE `sport_actions`
  ADD PRIMARY KEY (`id`);

--
-- 資料表索引 `sport_items`
--
ALTER TABLE `sport_items`
  ADD PRIMARY KEY (`id`);

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
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_edu_key_unique` (`edu_key`);

--
-- 在傾印的資料表使用自動遞增(AUTO_INCREMENT)
--

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `clubs`
--
ALTER TABLE `clubs`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `club_blacks`
--
ALTER TABLE `club_blacks`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `club_not_registers`
--
ALTER TABLE `club_not_registers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `club_registers`
--
ALTER TABLE `club_registers`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `club_semesters`
--
ALTER TABLE `club_semesters`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `job_titles`
--
ALTER TABLE `job_titles`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lend_classes`
--
ALTER TABLE `lend_classes`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `lend_items`
--
ALTER TABLE `lend_items`
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
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
-- 使用資料表自動遞增(AUTO_INCREMENT) `sport_actions`
--
ALTER TABLE `sport_actions`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- 使用資料表自動遞增(AUTO_INCREMENT) `sport_items`
--
ALTER TABLE `sport_items`
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
