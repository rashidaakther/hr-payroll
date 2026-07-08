-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 08, 2026 at 09:29 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hr_payroll_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `branches`
--

CREATE TABLE `branches` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `branches`
--

INSERT INTO `branches` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Westmark Apparel Limited - Dhaka', 1, '2026-06-30 13:07:33', '2026-06-30 13:07:33'),
(2, 'Westmark Apparel Limited - Chittagong', 1, '2026-06-30 19:16:26', '2026-06-30 19:16:26');

-- --------------------------------------------------------

--
-- Table structure for table `dailyattendances`
--

CREATE TABLE `dailyattendances` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `year_id` int(11) DEFAULT NULL,
  `month_id` varchar(255) DEFAULT NULL,
  `date` varchar(255) DEFAULT NULL,
  `in_time` varchar(255) DEFAULT NULL,
  `out_time` varchar(255) DEFAULT NULL,
  `general_working_hour` varchar(255) DEFAULT NULL,
  `overtime_hour` varchar(255) DEFAULT NULL,
  `extra_overtime_hour` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `dailyattendances`
--

INSERT INTO `dailyattendances` (`id`, `employee_id`, `year_id`, `month_id`, `date`, `in_time`, `out_time`, `general_working_hour`, `overtime_hour`, `extra_overtime_hour`, `status`, `created_at`, `updated_at`) VALUES
(2, '1', 2025, '7', '07/01/2025', '07/01/2025 07:59:05', '07/01/2025 16:56:24', '08:57', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(3, '1', 2025, '7', '07/02/2025', '07/02/2025 08:00:20', '07/02/2025 16:55:59', '08:55', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(4, '1', 2025, '7', '07/03/2025', '07/03/2025 08:04:37', '07/03/2025 17:01:36', '08:56', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(5, '1', 2025, '7', '07/04/2025', NULL, NULL, '00:00', NULL, NULL, 'Weekly Holiday', NULL, '2026-07-08 19:18:35'),
(6, '1', 2025, '7', '07/05/2025', '07/05/2025 07:57:10', '07/05/2025 17:03:10', '09:06', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(7, '1', 2025, '7', '07/06/2025', '07/06/2025 08:04:42', '07/06/2025 16:57:36', '08:52', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(8, '1', 2025, '7', '07/07/2025', '07/07/2025 08:04:40', '07/07/2025 17:03:33', '08:58', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(9, '1', 2025, '7', '07/08/2025', '07/08/2025 08:01:38', '07/08/2025 17:03:29', '09:01', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(10, '1', 2025, '7', '07/09/2025', '07/09/2025 08:00:51', '07/09/2025 17:01:36', '09:00', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(11, '1', 2025, '7', '07/10/2025', '07/10/2025 07:59:40', '07/10/2025 16:59:54', '09:00', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(12, '1', 2025, '7', '07/11/2025', NULL, NULL, '00:00', NULL, NULL, 'Weekly Holiday', NULL, '2026-07-08 19:18:35'),
(13, '1', 2025, '7', '07/12/2025', '07/12/2025 08:03:25', '07/12/2025 16:58:40', '08:55', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(14, '1', 2025, '7', '07/13/2025', '07/13/2025 07:59:30', '07/13/2025 17:05:21', '09:05', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(15, '1', 2025, '7', '07/14/2025', '07/14/2025 08:01:53', '07/14/2025 16:57:45', '08:55', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(16, '1', 2025, '7', '07/15/2025', '07/15/2025 08:02:01', '07/15/2025 17:02:01', '09:00', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(17, '1', 2025, '7', '07/16/2025', '07/16/2025 07:55:05', '07/16/2025 16:58:41', '09:03', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(18, '1', 2025, '7', '07/17/2025', '07/17/2025 08:03:02', '07/17/2025 16:55:59', '08:52', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(19, '1', 2025, '7', '07/18/2025', NULL, NULL, '00:00', NULL, NULL, 'Weekly Holiday', NULL, '2026-07-08 19:18:35'),
(20, '1', 2025, '7', '07/19/2025', '07/19/2025 08:05:51', '07/19/2025 16:57:14', '08:51', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(21, '1', 2025, '7', '07/20/2025', '07/20/2025 07:55:18', '07/20/2025 16:55:14', '08:59', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(22, '1', 2025, '7', '07/21/2025', '07/21/2025 07:55:17', '07/21/2025 17:01:04', '09:05', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(23, '1', 2025, '7', '07/22/2025', '07/22/2025 07:57:16', '07/22/2025 16:57:49', '09:00', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(24, '1', 2025, '7', '07/23/2025', '07/23/2025 08:01:50', '07/23/2025 16:57:42', '08:55', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(25, '1', 2025, '7', '07/24/2025', '07/24/2025 08:01:05', '07/24/2025 17:00:08', '08:59', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(26, '1', 2025, '7', '07/25/2025', NULL, NULL, '00:00', NULL, NULL, 'Weekly Holiday', NULL, '2026-07-08 19:18:35'),
(27, '1', 2025, '7', '07/26/2025', '07/26/2025 07:57:33', '07/26/2025 17:04:30', '09:06', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(28, '1', 2025, '7', '07/27/2025', '07/27/2025 08:05:17', '07/27/2025 17:02:33', '08:57', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(29, '1', 2025, '7', '07/28/2025', '07/28/2025 07:59:45', '07/28/2025 16:59:29', '08:59', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(30, '1', 2025, '7', '07/29/2025', '07/29/2025 08:02:45', '07/29/2025 17:02:04', '08:59', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(31, '1', 2025, '7', '07/30/2025', '07/30/2025 08:00:55', '07/30/2025 16:56:19', '08:55', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35'),
(32, '1', 2025, '7', '07/31/2025', '07/31/2025 08:05:21', '07/31/2025 16:55:25', '08:50', NULL, NULL, 'Present', NULL, '2026-07-08 19:18:35');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `branch_id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 2, 'Sewing oparator', NULL, '2026-07-01 19:12:56', '2026-07-01 19:12:56'),
(2, 2, 'Finishing', 1, '2026-07-01 19:17:05', '2026-07-01 19:17:05'),
(3, 2, 'HR - Admin', 1, '2026-07-07 16:00:43', '2026-07-07 16:00:43');

-- --------------------------------------------------------

--
-- Table structure for table `designations`
--

CREATE TABLE `designations` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `designations`
--

INSERT INTO `designations` (`id`, `branch_id`, `department_id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 2, 1, 'SSMO', NULL, '2026-07-01 19:52:40', '2026-07-01 19:52:40'),
(2, 2, 3, 'HR Manager', 1, '2026-07-07 16:01:09', '2026-07-07 16:01:09');

-- --------------------------------------------------------

--
-- Table structure for table `empofficeinfos`
--

CREATE TABLE `empofficeinfos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `employee_name_other` varchar(255) DEFAULT NULL,
  `official_mail` varchar(255) DEFAULT NULL,
  `designation` varchar(255) DEFAULT NULL,
  `office` varchar(255) DEFAULT NULL,
  `shift` varchar(255) DEFAULT NULL,
  `unit` varchar(255) DEFAULT NULL,
  `department` varchar(255) DEFAULT NULL,
  `section_line` varchar(255) DEFAULT NULL,
  `work_group` varchar(255) DEFAULT NULL,
  `salary_type` varchar(255) DEFAULT NULL,
  `card_no` varchar(255) DEFAULT NULL,
  `joining_date` varchar(255) DEFAULT NULL,
  `grade` varchar(255) DEFAULT NULL,
  `gross` varchar(255) DEFAULT NULL,
  `second_gross` varchar(255) DEFAULT NULL,
  `manager` varchar(255) DEFAULT NULL,
  `job_location` varchar(255) DEFAULT NULL,
  `probation_period` varchar(255) DEFAULT NULL,
  `confirmation_date` varchar(255) DEFAULT NULL,
  `is_ot_payable` varchar(255) DEFAULT NULL,
  `is_masked` varchar(255) DEFAULT NULL,
  `employee_status` varchar(255) DEFAULT NULL,
  `discontinuation_date` varchar(255) DEFAULT NULL,
  `discontinuation_reason` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `empofficeinfos`
--

INSERT INTO `empofficeinfos` (`id`, `employee_id`, `employee_name`, `employee_name_other`, `official_mail`, `designation`, `office`, `shift`, `unit`, `department`, `section_line`, `work_group`, `salary_type`, `card_no`, `joining_date`, `grade`, `gross`, `second_gross`, `manager`, `job_location`, `probation_period`, `confirmation_date`, `is_ot_payable`, `is_masked`, `employee_status`, `discontinuation_date`, `discontinuation_reason`, `created_at`, `updated_at`) VALUES
(1, '#GMT000000001', 'Dipjoy Sarker', 'দ্বীপজয় সরকার', NULL, '2', '2', '1', '1', '3', '2', 'Staff', 'Regular', '1', '2026-07-07', '1', '40000.00', '40000.00', NULL, NULL, NULL, NULL, 'No', 'No', 'Active', NULL, NULL, '2026-07-07 16:50:50', '2026-07-07 18:57:27');

-- --------------------------------------------------------

--
-- Table structure for table `emppersonalinfos`
--

CREATE TABLE `emppersonalinfos` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `father_name` varchar(255) DEFAULT ' ',
  `mother_name` varchar(255) DEFAULT ' ',
  `height` varchar(255) DEFAULT ' ',
  `contact_number` varchar(255) DEFAULT ' ',
  `birth_date` varchar(255) DEFAULT ' ',
  `gender` varchar(255) DEFAULT ' ',
  `religion` varchar(255) DEFAULT ' ',
  `nationality` varchar(255) DEFAULT ' ',
  `national_id` varchar(255) DEFAULT ' ',
  `birth_certificate` varchar(255) DEFAULT ' ',
  `blood_group` varchar(255) DEFAULT ' ',
  `marital_status` varchar(255) DEFAULT ' ',
  `emergency_contact_name` varchar(255) DEFAULT ' ',
  `emergency_contact_address` varchar(255) DEFAULT ' ',
  `emergency_contact_number` varchar(255) DEFAULT ' ',
  `emergency_contact_relationship` varchar(255) DEFAULT ' ',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `emppersonalinfos`
--

INSERT INTO `emppersonalinfos` (`id`, `employee_id`, `father_name`, `mother_name`, `height`, `contact_number`, `birth_date`, `gender`, `religion`, `nationality`, `national_id`, `birth_certificate`, `blood_group`, `marital_status`, `emergency_contact_name`, `emergency_contact_address`, `emergency_contact_number`, `emergency_contact_relationship`, `created_at`, `updated_at`) VALUES
(1, '1', NULL, NULL, NULL, NULL, '1995-04-04', 'Male', NULL, 'Bangladeshi', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '2026-07-07 16:50:50', '2026-07-07 19:32:20');

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(255) NOT NULL,
  `connection` text NOT NULL,
  `queue` text NOT NULL,
  `payload` longtext NOT NULL,
  `exception` longtext NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `grades`
--

CREATE TABLE `grades` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `basic_sly` varchar(255) DEFAULT NULL,
  `house_rent` varchar(255) DEFAULT NULL,
  `medical_allowance` varchar(255) DEFAULT NULL,
  `transportation_allowance` varchar(255) DEFAULT NULL,
  `food_allowance` varchar(255) DEFAULT NULL,
  `total_approx_sly` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `grades`
--

INSERT INTO `grades` (`id`, `branch_id`, `name`, `basic_sly`, `house_rent`, `medical_allowance`, `transportation_allowance`, `food_allowance`, `total_approx_sly`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2', 'Grade - 1', '10000', '5000', '750', '450', '1250', '17450.00', '1', '2026-07-03 19:16:12', '2026-07-03 19:16:12');

-- --------------------------------------------------------

--
-- Table structure for table `holidays`
--

CREATE TABLE `holidays` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` varchar(255) NOT NULL,
  `shift_id` varchar(255) NOT NULL,
  `holidayType` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `year` varchar(255) DEFAULT NULL,
  `month` varchar(255) DEFAULT NULL,
  `from` varchar(255) DEFAULT NULL,
  `to` varchar(255) DEFAULT NULL,
  `total_day` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `holidays`
--

INSERT INTO `holidays` (`id`, `branch_id`, `shift_id`, `holidayType`, `name`, `year`, `month`, `from`, `to`, `total_day`, `status`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2', '1', 'Festival', 'Durga Puja', '2026', '10', '2026-07-16', '2026-07-18', '3', '1', '1', '2026-07-03 20:04:37', '2026-07-03 20:04:37');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_reset_tokens_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(5, '2026_06_26_165648_create_departments_table', 2),
(6, '2026_06_26_165833_create_designations_table', 2),
(7, '2026_06_26_170046_create_branches_table', 2),
(8, '2026_06_26_170127_create_shifts_table', 2),
(9, '2026_06_26_170204_create_units_table', 2),
(10, '2026_06_26_170300_create_section_lines_table', 2),
(11, '2026_06_26_170331_create_grades_table', 2),
(12, '2026_06_26_170356_create_religions_table', 2),
(13, '2026_06_26_170659_create_holidays_table', 2),
(14, '2026_07_05_230848_create_empofficeinfos_table', 3),
(15, '2026_07_05_230956_create_emppersonalinfos_table', 3),
(16, '2026_07_05_232215_create_dailyattendances_table', 4),
(17, '2026_07_06_224007_create_settings_table', 5),
(18, '2026_07_08_191022_create_years_table', 6);

-- --------------------------------------------------------

--
-- Table structure for table `password_reset_tokens`
--

CREATE TABLE `password_reset_tokens` (
  `email` varchar(255) NOT NULL,
  `token` varchar(255) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) NOT NULL,
  `tokenable_id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `token` varchar(64) NOT NULL,
  `abilities` text DEFAULT NULL,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `expires_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `religions`
--

CREATE TABLE `religions` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `religions`
--

INSERT INTO `religions` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'Hinduism', '1', '2026-07-03 19:37:18', '2026-07-03 19:37:18'),
(2, 'Islam', '1', '2026-07-03 19:48:53', '2026-07-03 19:48:53');

-- --------------------------------------------------------

--
-- Table structure for table `section_lines`
--

CREATE TABLE `section_lines` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` varchar(255) NOT NULL,
  `unit_id` varchar(255) NOT NULL,
  `name` varchar(255) NOT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `section_lines`
--

INSERT INTO `section_lines` (`id`, `branch_id`, `unit_id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2', '1', 'Sewing - op - A', '1', '2026-07-02 20:26:58', '2026-07-02 20:26:58'),
(2, '2', '1', 'Office', '1', '2026-07-07 16:01:38', '2026-07-07 16:01:38');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT '',
  `value` longtext DEFAULT '',
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`id`, `name`, `value`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'employee_prefix', '#GMT00000', 1, '2026-07-06 18:59:00', '2026-07-06 18:59:00');

-- --------------------------------------------------------

--
-- Table structure for table `shifts`
--

CREATE TABLE `shifts` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` varchar(255) DEFAULT NULL,
  `name` varchar(255) NOT NULL,
  `start_at` varchar(255) DEFAULT NULL,
  `break_start_at` varchar(255) DEFAULT NULL,
  `break_end_at` varchar(255) DEFAULT NULL,
  `total_break_hours` varchar(255) DEFAULT NULL,
  `end_at` varchar(255) DEFAULT NULL,
  `total_hours` varchar(255) DEFAULT NULL,
  `general_ot_start_at` varchar(255) DEFAULT NULL,
  `general_ot_end_at` varchar(255) DEFAULT NULL,
  `extra_ot_start_at` varchar(255) DEFAULT NULL,
  `extra_ot_end_at` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `status` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `shifts`
--

INSERT INTO `shifts` (`id`, `branch_id`, `name`, `start_at`, `break_start_at`, `break_end_at`, `total_break_hours`, `end_at`, `total_hours`, `general_ot_start_at`, `general_ot_end_at`, `extra_ot_start_at`, `extra_ot_end_at`, `created_by`, `status`, `created_at`, `updated_at`) VALUES
(1, '2', 'General Shift', '08:00', '13:00', '14:00', NULL, '17:00', '8', '17:01', '19:00', '19:01', '07:59', NULL, NULL, '2026-07-02 19:32:13', '2026-07-02 19:32:13');

-- --------------------------------------------------------

--
-- Table structure for table `units`
--

CREATE TABLE `units` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `branch_id` varchar(255) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_by` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `units`
--

INSERT INTO `units` (`id`, `branch_id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2', 'Unit - 1', NULL, '2026-07-02 19:59:25', '2026-07-02 19:59:25');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `confirm_password` varchar(255) NOT NULL,
  `role` varchar(255) NOT NULL DEFAULT 'admin',
  `remember_token` varchar(100) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `email_verified_at`, `password`, `confirm_password`, `role`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'System Admin', 'admin@company.com', NULL, '$2y$10$ANrzePDogH3C/L/KEVyKfu.qctEHkt47CUjHm4hJS/h4ewrusydY.', '$2y$10$8Z11IGgh.8vtCKCdDpNwMOWGCAcUIUvGIr5i0SWh3NgnmucXcPC8C', 'admin', NULL, '2026-06-25 09:32:53', '2026-06-25 09:32:53'),
(2, 'General Employee', 'user@company.com', NULL, '$2y$10$0pv./GUVbCoha1P3zUW/Qee63sAPuCIa3HCA6SMoRuV56A9bBlihq', '$2y$10$qPfy0geZD28tw/REN6trnukbj4MsCry0bhmwsjPBEwkSHbVj8IvfC', 'user', NULL, '2026-06-25 09:32:53', '2026-06-25 09:32:53');

-- --------------------------------------------------------

--
-- Table structure for table `years`
--

CREATE TABLE `years` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `created_by` int(11) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `years`
--

INSERT INTO `years` (`id`, `name`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '2025', 1, '2026-07-08 13:37:00', '2026-07-08 13:37:00'),
(2, '2026', 1, '2026-07-08 13:37:15', '2026-07-08 13:37:15');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `branches`
--
ALTER TABLE `branches`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `dailyattendances`
--
ALTER TABLE `dailyattendances`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `designations`
--
ALTER TABLE `designations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `empofficeinfos`
--
ALTER TABLE `empofficeinfos`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `emppersonalinfos`
--
ALTER TABLE `emppersonalinfos`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `emppersonalinfos_employee_id_unique` (`employee_id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `grades`
--
ALTER TABLE `grades`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `holidays`
--
ALTER TABLE `holidays`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_reset_tokens`
--
ALTER TABLE `password_reset_tokens`
  ADD PRIMARY KEY (`email`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `religions`
--
ALTER TABLE `religions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `section_lines`
--
ALTER TABLE `section_lines`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `settings_name_unique` (`name`);

--
-- Indexes for table `shifts`
--
ALTER TABLE `shifts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `units`
--
ALTER TABLE `units`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `years`
--
ALTER TABLE `years`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `branches`
--
ALTER TABLE `branches`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `dailyattendances`
--
ALTER TABLE `dailyattendances`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `designations`
--
ALTER TABLE `designations`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `empofficeinfos`
--
ALTER TABLE `empofficeinfos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `emppersonalinfos`
--
ALTER TABLE `emppersonalinfos`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `grades`
--
ALTER TABLE `grades`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `holidays`
--
ALTER TABLE `holidays`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `religions`
--
ALTER TABLE `religions`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `section_lines`
--
ALTER TABLE `section_lines`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `shifts`
--
ALTER TABLE `shifts`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `units`
--
ALTER TABLE `units`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `years`
--
ALTER TABLE `years`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
